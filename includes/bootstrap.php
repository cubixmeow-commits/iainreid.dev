<?php

declare(strict_types=1);

/** @var string|null */
$GLOBALS['PORTFOLIO_ROOT'] = $GLOBALS['PORTFOLIO_ROOT'] ?? null;

/**
 * Resolve and remember the private application root.
 * Production uses public/.portfolio-root written by .cpanel.yml.
 * Local development uses the repository root beside /public.
 */
function portfolio_boot(string $publicDir): void
{
    $marker = rtrim($publicDir, DIRECTORY_SEPARATOR) . '/.portfolio-root';
    if (is_readable($marker)) {
        $path = trim((string) file_get_contents($marker));
        if ($path !== '' && is_file($path . '/data/projects.php')) {
            $GLOBALS['PORTFOLIO_ROOT'] = $path;
            return;
        }
    }

    $candidate = dirname($publicDir);
    if (is_file($candidate . '/data/projects.php')) {
        $GLOBALS['PORTFOLIO_ROOT'] = $candidate;
        return;
    }

    throw new RuntimeException('Portfolio root not found. Create public/.portfolio-root or keep data/ beside public/.');
}

function portfolio_root(): string
{
    if (!empty($GLOBALS['PORTFOLIO_ROOT']) && is_string($GLOBALS['PORTFOLIO_ROOT'])) {
        return $GLOBALS['PORTFOLIO_ROOT'];
    }

    $fallback = dirname(__DIR__);
    if (is_file($fallback . '/data/projects.php')) {
        $GLOBALS['PORTFOLIO_ROOT'] = $fallback;
        return $fallback;
    }

    throw new RuntimeException('Portfolio application root could not be resolved. Call portfolio_boot() first.');
}

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * @return list<array<string, mixed>>
 */
function portfolio_projects(): array
{
    static $projects = null;
    if ($projects !== null) {
        return $projects;
    }

    /** @var list<array<string, mixed>> $loaded */
    $loaded = require portfolio_root() . '/data/projects.php';
    usort(
        $loaded,
        static fn(array $a, array $b): int => ((int) ($a['display_order'] ?? 100)) <=> ((int) ($b['display_order'] ?? 100))
    );
    $projects = $loaded;
    return $projects;
}

/**
 * @return list<array<string, mixed>>
 */
function portfolio_projects_by_status(string ...$statuses): array
{
    $wanted = array_fill_keys($statuses, true);
    return array_values(array_filter(
        portfolio_projects(),
        static fn(array $p): bool => isset($wanted[(string) ($p['status'] ?? '')])
    ));
}

/**
 * @return list<array<string, mixed>>
 */
function portfolio_current_work(): array
{
    return array_values(array_filter(
        portfolio_projects(),
        static fn(array $p): bool => !empty($p['current_focus'])
    ));
}

function portfolio_find(string $slug): ?array
{
    foreach (portfolio_projects() as $project) {
        if (($project['slug'] ?? '') === $slug) {
            return $project;
        }
    }
    return null;
}

/**
 * @return array<string, string>
 */
function portfolio_status_labels(): array
{
    return [
        'active' => 'Active',
        'building' => 'Building',
        'new' => 'New',
        'experimental' => 'Experimental',
        'shipped' => 'Shipped',
        'paused' => 'Paused',
        'retired' => 'Retired',
        'archived' => 'Archived',
    ];
}

function portfolio_status_label(string $status): string
{
    $labels = portfolio_status_labels();
    return $labels[$status] ?? ucfirst($status);
}

/**
 * @param array<string, mixed> $meta
 * @param array<string, mixed> $data
 */
function render(string $view, array $meta = [], array $data = []): void
{
    $root = portfolio_root();
    $viewFile = $root . '/includes/views/' . $view . '.php';
    if (!is_file($viewFile)) {
        http_response_code(500);
        echo 'View not found.';
        return;
    }

    $defaults = [
        'title' => 'Iain Reid | Software Products, Experiments and SaaS Lab',
        'description' => 'The personal development portfolio of Iain Reid, featuring deployed software products, rapid SaaS experiments, development systems, and the lessons behind each build.',
        'canonical' => 'https://iainreid.dev/',
        'og_type' => 'website',
        'body_class' => '',
        'active_nav' => '',
    ];
    $meta = array_merge($defaults, $meta);

    extract($data, EXTR_SKIP);
    require $root . '/includes/layout.php';
}
