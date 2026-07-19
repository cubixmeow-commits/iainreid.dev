<?php

declare(strict_types=1);

/**
 * Private-first experiment visibility for SaaS Lab.
 *
 * An experiment can be deployed to production before it is publicly
 * discoverable: used privately, then by a few invited testers, then published
 * only after it earns public access. This file holds the shared, server-side
 * gate and its supporting read/invite helpers.
 *
 * Two independent concepts:
 *   - visibility ('private' | 'invite' | 'public') answers "who may access this?"
 *     Authorization is derived ONLY from visibility (+ admin + invite).
 *   - status is informational ("where is this in the loop?"). It is NEVER used
 *     for access control.
 *
 * The single most important rule for a gated page: call
 * require_experiment_access('<slug>') as the FIRST thing after including the
 * bootstrap, before any HTML, whitespace, BOM, title, metadata, or query. The
 * 404 gate can only work before any byte of output is sent.
 */

/** Allowed visibility values (also enforced by a CHECK constraint). */
const EXPERIMENT_VISIBILITIES = ['private', 'invite', 'public'];

/** Allowed status values (informational only; enforced in application code). */
const EXPERIMENT_STATUSES = ['framing', 'building', 'self-testing', 'invite-testing', 'public', 'archived'];

function is_valid_experiment_visibility(string $visibility): bool
{
    return in_array($visibility, EXPERIMENT_VISIBILITIES, true);
}

function is_valid_experiment_status(string $status): bool
{
    return in_array($status, EXPERIMENT_STATUSES, true);
}

/**
 * Fetch an experiment by its slug, or null if none exists.
 */
function find_experiment_by_slug(string $slug): ?array
{
    $stmt = db()->prepare('SELECT * FROM experiments WHERE slug = :slug');
    $stmt->execute([':slug' => $slug]);
    $row = $stmt->fetch();
    return $row === false ? null : $row;
}

/**
 * Fetch an experiment by its id, or null if none exists.
 */
function find_experiment_by_id(int $id): ?array
{
    $stmt = db()->prepare('SELECT * FROM experiments WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch();
    return $row === false ? null : $row;
}

/**
 * Whether the given user id holds an invite to the given experiment.
 */
function is_user_invited_to_experiment(int $experimentId, int $userId): bool
{
    $stmt = db()->prepare(
        'SELECT 1 FROM experiment_invites WHERE experiment_id = :eid AND user_id = :uid'
    );
    $stmt->execute([':eid' => $experimentId, ':uid' => $userId]);
    return $stmt->fetchColumn() !== false;
}

/**
 * Pure authorization decision for an already-loaded experiment record.
 *
 *   - public                       -> allow
 *   - admin                        -> allow
 *   - invite + logged in + invited -> allow
 *   - otherwise                    -> deny
 *
 * Never consults slug, route_path, URL, query params, referrer, non-session
 * cookies, navigation, CSS, or JavaScript.
 */
function can_access_experiment(array $experiment): bool
{
    $visibility = (string) ($experiment['visibility'] ?? 'private');

    if ($visibility === 'public') {
        return true;
    }
    if (is_admin()) {
        return true;
    }
    if ($visibility === 'invite' && is_logged_in()) {
        $user = current_user();
        return $user !== null
            && is_user_invited_to_experiment((int) $experiment['id'], (int) $user['id']);
    }

    return false;
}

/**
 * The gate. A gated page calls this with its own slug as its first action after
 * the bootstrap. On success it returns the experiment record; on any denial (or
 * a genuinely missing slug) it renders a real HTTP 404 and terminates. The 404
 * body is identical whether the experiment is missing, private, or invite-only
 * and the caller is unauthorized, so existence never leaks.
 */
function require_experiment_access(string $slug): array
{
    $experiment = find_experiment_by_slug($slug);

    if ($experiment === null || !can_access_experiment($experiment)) {
        render_not_found();
    }

    return $experiment;
}

/**
 * Public experiments only, for any public listing that reads experiment data.
 * The public SaaS Lab page in this phase is hardcoded and does not use this;
 * it exists so that if a listing is ever added it can read nothing else.
 */
function list_public_experiments(): array
{
    return db()
        ->query("SELECT * FROM experiments WHERE visibility = 'public' ORDER BY published_at DESC, id DESC")
        ->fetchAll();
}

/**
 * Invite-visibility experiments the given user has been invited to. Scoped to
 * that user's own invite rows only; never enumerates another user's invites or
 * admin-only private experiments.
 */
function list_user_invited_experiments(int $userId): array
{
    $stmt = db()->prepare(
        "SELECT e.*
           FROM experiments e
           JOIN experiment_invites i ON i.experiment_id = e.id
          WHERE i.user_id = :uid
            AND e.visibility = 'invite'
          ORDER BY e.updated_at DESC, e.id DESC"
    );
    $stmt->execute([':uid' => $userId]);
    return $stmt->fetchAll();
}

/**
 * Users invited to an experiment (for the admin management view).
 */
function list_experiment_invites(int $experimentId): array
{
    $stmt = db()->prepare(
        'SELECT u.id, u.name, u.email, i.created_at
           FROM experiment_invites i
           JOIN users u ON u.id = i.user_id
          WHERE i.experiment_id = :eid
          ORDER BY u.email ASC'
    );
    $stmt->execute([':eid' => $experimentId]);
    return $stmt->fetchAll();
}

/**
 * Invited-user counts keyed by experiment id (for the registry list).
 */
function experiment_invite_counts(): array
{
    $rows = db()
        ->query('SELECT experiment_id, COUNT(*) AS n FROM experiment_invites GROUP BY experiment_id')
        ->fetchAll();
    $counts = [];
    foreach ($rows as $row) {
        $counts[(int) $row['experiment_id']] = (int) $row['n'];
    }
    return $counts;
}

/**
 * Grant an invite. Returns true if a new row was created, false if the user was
 * already invited (duplicate). The caller must have verified admin rights and
 * that both the experiment and user exist.
 */
function invite_user_to_experiment(int $experimentId, int $userId, int $adminId): bool
{
    if (is_user_invited_to_experiment($experimentId, $userId)) {
        return false;
    }
    $stmt = db()->prepare(
        'INSERT INTO experiment_invites (experiment_id, user_id, created_by, created_at)
         VALUES (:eid, :uid, :by, :at)'
    );
    $stmt->execute([
        ':eid' => $experimentId,
        ':uid' => $userId,
        ':by'  => $adminId,
        ':at'  => gmdate('Y-m-d H:i:s'),
    ]);
    return true;
}

/**
 * Remove an invite, revoking access immediately.
 */
function remove_experiment_invite(int $experimentId, int $userId): void
{
    $stmt = db()->prepare(
        'DELETE FROM experiment_invites WHERE experiment_id = :eid AND user_id = :uid'
    );
    $stmt->execute([':eid' => $experimentId, ':uid' => $userId]);
}

/**
 * Render a generic "Page not found" page and terminate.
 *
 * The gate's privacy guarantee depends entirely on this running before any
 * output. If output has already begun the HTTP status is already 200 and cannot
 * be changed to 404 — that would be the forbidden "200 not found" degradation.
 * We therefore fail LOUDLY (log with the exact location, and, when errors are
 * displayed, raise) rather than silently pretending success. In all cases we
 * never render the protected content.
 */
function render_not_found(): never
{
    if (headers_sent($file, $line)) {
        error_log(sprintf(
            'SaaS Lab experiment gate: output already started at %s:%d — cannot send 404. '
            . 'The gated page must call require_experiment_access() before any output.',
            $file,
            (int) $line
        ));
        // Loud failure: never a silent 200 that could imply the page exists.
        // display_errors is off in production, so this becomes a generic 500
        // rather than leaking; in development it surfaces the ordering bug.
        throw new RuntimeException(
            'Experiment gate invoked after output started; fix the page to gate before output.'
        );
    }

    http_response_code(404);

    if (function_exists('render_page_top')) {
        require_once __DIR__ . '/layout.php';
        render_page_top('Page not found');
        echo '<section class="auth-card auth-card--narrow" aria-labelledby="nf-title">'
            . '<p class="mono">404</p>'
            . '<h1 id="nf-title">Page not found</h1>'
            . '<p class="auth-lede">The page you were looking for does not exist.</p>'
            . '<p><a class="btn btn--ghost" href="' . e(url('saas-lab/')) . '">Back to SaaS Lab</a></p>'
            . '</section>';
        render_page_bottom();
    } else {
        header('Content-Type: text/html; charset=utf-8');
        echo '<!doctype html><meta charset="utf-8"><title>Page not found</title>'
            . '<h1>Page not found</h1><p>The page you were looking for does not exist.</p>';
    }

    exit;
}
