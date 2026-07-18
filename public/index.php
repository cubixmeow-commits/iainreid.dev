<?php

declare(strict_types=1);

$marker = __DIR__ . '/.portfolio-root';
if (is_readable($marker)) {
    $appRoot = trim((string) file_get_contents($marker));
    require rtrim($appRoot, '/') . '/includes/bootstrap.php';
} else {
    require dirname(__DIR__) . '/includes/bootstrap.php';
}

portfolio_boot(__DIR__);

render('home', [
    'title' => 'Iain Reid | Software Products, Experiments and SaaS Lab',
    'description' => 'The personal development portfolio of Iain Reid, featuring deployed software products, rapid SaaS experiments, development systems, and the lessons behind each build.',
    'canonical' => 'https://iainreid.dev/',
    'active_nav' => 'work',
    'body_class' => 'page-home',
], [
    'projects' => portfolio_projects(),
    'currentWork' => portfolio_current_work(),
    'saasLab' => portfolio_find('saas-lab'),
]);
