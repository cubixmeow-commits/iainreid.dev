<?php

declare(strict_types=1);

/**
 * SQLite database access for the shared SaaS Lab account system.
 *
 * Uses PDO with the pdo_sqlite extension. The database file and its table are
 * created automatically on first use. All queries elsewhere use prepared
 * statements. This file also owns the two controlled failure modes an operator
 * might hit on a fresh cPanel deployment: a missing SQLite extension, and a
 * data directory PHP cannot write to.
 */

/**
 * Return the shared PDO connection, creating and initialising the database on
 * first call. Cached for the lifetime of the request.
 */
function db(): PDO
{
    static $pdo = null;
    if ($pdo instanceof PDO) {
        return $pdo;
    }

    if (!extension_loaded('pdo_sqlite')) {
        saas_lab_fatal(
            'The SaaS Lab account system requires the PDO SQLite PHP extension '
            . '(pdo_sqlite), which is not enabled. Enable it in cPanel under '
            . '"Select PHP Version" (Extensions) or "MultiPHP INI Editor", then reload.'
        );
    }

    $dataDir = (string) config('data_dir');
    $dbFile = (string) config('db_path');

    ensure_data_dir_writable($dataDir);

    try {
        $pdo = new PDO('sqlite:' . $dbFile, null, null, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);

        // Conservative configuration for low-concurrency shared hosting: keep
        // the default (rollback journal) mode rather than WAL, so no -wal/-shm
        // files are created that could complicate backups or deployment.
        // foreign_keys is a no-op for the single-table schema today and is
        // enabled ahead of future related tables.
        $pdo->exec('PRAGMA foreign_keys = ON;');

        init_schema($pdo);
    } catch (PDOException $e) {
        // Never surface the raw PDO message. The most common real-world cause
        // on a fresh deployment is a directory PHP cannot write to.
        saas_lab_fatal(
            'The SaaS Lab account system could not open its database. '
            . 'If this is a new deployment, verify PHP write permissions for: '
            . $dataDir
        );
    }

    return $pdo;
}

/**
 * Ensure the data directory exists and is writable by the PHP process, failing
 * with a controlled, operator-facing message otherwise. The absolute path is
 * intentionally included because this is an installation error for the site
 * operator; no other filesystem detail is exposed.
 */
function ensure_data_dir_writable(string $dataDir): void
{
    if (!is_dir($dataDir)) {
        // Least-permissive mode that still lets the owning PHP user read/write.
        @mkdir($dataDir, 0750, true);
    }

    if (!is_dir($dataDir) || !is_writable($dataDir)) {
        saas_lab_fatal(
            'The SaaS Lab data directory is not writable. '
            . 'Verify PHP write permissions for: ' . $dataDir
        );
    }
}

/**
 * Create the users table and its indexes if they do not already exist.
 * Idempotent and safe to run on every request; existing data is never touched.
 * This small function is the seam that can later grow into versioned
 * migrations without introducing a framework now.
 */
function init_schema(PDO $pdo): void
{
    $pdo->exec(
        "CREATE TABLE IF NOT EXISTS users (
            id            INTEGER PRIMARY KEY AUTOINCREMENT,
            name          TEXT NOT NULL,
            email         TEXT NOT NULL UNIQUE,
            password_hash TEXT NOT NULL,
            role          TEXT NOT NULL DEFAULT 'user',
            created_at    TEXT NOT NULL,
            updated_at    TEXT NOT NULL
        )"
    );

    // Unique index on the (already normalised) email as the final authority for
    // duplicate prevention, independent of the inline column constraint.
    $pdo->exec('CREATE UNIQUE INDEX IF NOT EXISTS idx_users_email ON users (email)');

    // --- Private-first experiment visibility -----------------------------
    //
    // visibility answers "who can access this?" (authorization). status answers
    // "where is this in the loop?" (informational). They are separate columns;
    // authorization is derived only from visibility, never from status.
    //
    // route_path is a DISPLAY-ONLY admin annotation. It is never used to route,
    // redirect, include, or authorize anything.
    $pdo->exec(
        "CREATE TABLE IF NOT EXISTS experiments (
            id              INTEGER PRIMARY KEY AUTOINCREMENT,
            experiment_code TEXT NOT NULL UNIQUE,
            slug            TEXT NOT NULL UNIQUE,
            name            TEXT NOT NULL,
            description     TEXT NOT NULL DEFAULT '',
            visibility      TEXT NOT NULL DEFAULT 'private'
                                CHECK (visibility IN ('private','invite','public')),
            route_path      TEXT NULL,
            status          TEXT NOT NULL DEFAULT 'framing',
            created_by      INTEGER NOT NULL REFERENCES users(id),
            created_at      TEXT NOT NULL,
            updated_at      TEXT NOT NULL,
            published_at    TEXT NULL
        )"
    );
    $pdo->exec('CREATE INDEX IF NOT EXISTS idx_experiments_visibility ON experiments (visibility)');

    // Invitations apply only to existing registered users. The composite primary
    // key prevents duplicate invites. Foreign keys are enforced because db()
    // sets PRAGMA foreign_keys = ON.
    $pdo->exec(
        "CREATE TABLE IF NOT EXISTS experiment_invites (
            experiment_id INTEGER NOT NULL REFERENCES experiments(id),
            user_id       INTEGER NOT NULL REFERENCES users(id),
            created_by    INTEGER NOT NULL REFERENCES users(id),
            created_at    TEXT NOT NULL,
            PRIMARY KEY (experiment_id, user_id)
        )"
    );
    $pdo->exec('CREATE INDEX IF NOT EXISTS idx_experiment_invites_user ON experiment_invites (user_id)');
}

/**
 * Determine whether a caught PDOException represents the users.email unique
 * constraint being violated, so callers can map only that case to the
 * "email already registered" message and never misclassify other errors.
 */
function is_duplicate_email_error(PDOException $e): bool
{
    if ($e->getCode() !== '23000') {
        return false;
    }
    $message = strtolower($e->getMessage());
    return str_contains($message, 'unique') && str_contains($message, 'email');
}

/**
 * A production-safe fatal error. Renders a minimal styled page (or writes to
 * stderr under the CLI) and stops. Never emits SQL, stack traces, passwords, or
 * unrelated server configuration.
 */
function saas_lab_fatal(string $message, int $status = 500): never
{
    if (PHP_SAPI === 'cli') {
        fwrite(STDERR, $message . "\n");
        exit(1);
    }

    if (!headers_sent()) {
        http_response_code($status);
        header('Content-Type: text/html; charset=utf-8');
    }

    $safe = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    echo '<!doctype html><html lang="en"><head><meta charset="utf-8">'
        . '<meta name="viewport" content="width=device-width, initial-scale=1">'
        . '<title>SaaS Lab</title></head>'
        . '<body style="margin:0;min-height:100vh;display:flex;align-items:center;'
        . 'justify-content:center;background:#0d0c0a;color:#efe7d2;'
        . "font-family:system-ui,-apple-system,'Segoe UI',sans-serif;padding:2rem;\">"
        . '<div style="max-width:34rem;">'
        . '<h1 style="font-size:1.15rem;letter-spacing:.02em;margin:0 0 .75rem;">SaaS Lab</h1>'
        . '<p style="line-height:1.6;margin:0;color:#d8c79e;">' . $safe . '</p>'
        . '</div></body></html>';
    exit;
}
