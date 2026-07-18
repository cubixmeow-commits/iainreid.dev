<?php

declare(strict_types=1);

$publicDir = dirname(__DIR__);
$marker = $publicDir . '/.portfolio-root';
if (is_readable($marker)) {
    $appRoot = trim((string) file_get_contents($marker));
    require rtrim($appRoot, '/') . '/includes/bootstrap.php';
} else {
    require dirname($publicDir) . '/includes/bootstrap.php';
}

portfolio_boot($publicDir);

$saasLab = portfolio_find('saas-lab');
$related = array_values(array_filter(
    portfolio_projects(),
    static fn(array $p): bool => ($p['slug'] ?? '') !== 'saas-lab'
));

render('saas-lab', [
    'title' => 'SaaS Lab | Iain Reid',
    'description' => 'SaaS Lab is Iain Reid\'s structured environment for turning software ideas into small, testable, deployable products and recording what the experiments teach.',
    'canonical' => 'https://iainreid.dev/saas-lab/',
    'active_nav' => 'saas-lab',
    'body_class' => 'page-saas-lab',
], [
    'saasLab' => $saasLab,
    'related' => $related,
]);
