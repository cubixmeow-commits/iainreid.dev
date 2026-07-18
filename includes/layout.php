<?php

declare(strict_types=1);

/** @var array<string, mixed> $meta */
/** @var string $viewFile */

$activeNav = (string) ($meta['active_nav'] ?? '');
$year = (int) date('Y');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e((string) $meta['title']) ?></title>
  <meta name="description" content="<?= e((string) $meta['description']) ?>">
  <meta name="theme-color" content="#E8EEF2">
  <link rel="canonical" href="<?= e((string) $meta['canonical']) ?>">

  <meta property="og:title" content="<?= e((string) $meta['title']) ?>">
  <meta property="og:description" content="<?= e((string) $meta['description']) ?>">
  <meta property="og:type" content="<?= e((string) $meta['og_type']) ?>">
  <meta property="og:url" content="<?= e((string) $meta['canonical']) ?>">
  <meta property="og:site_name" content="iainreid.dev">

  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="<?= e((string) $meta['title']) ?>">
  <meta name="twitter:description" content="<?= e((string) $meta['description']) ?>">

  <link rel="icon" href="/assets/img/favicon.svg" type="image/svg+xml">
  <link rel="manifest" href="/site.webmanifest">

  <link rel="preload" href="/assets/fonts/sora-600.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="/assets/fonts/source-sans-3-400.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="stylesheet" href="/assets/css/site.css">
</head>
<body class="<?= e((string) $meta['body_class']) ?>">
  <a class="skip-link" href="#main">Skip to content</a>

  <header class="site-header">
    <div class="shell header-inner">
      <a class="brand" href="/" aria-label="iainreid.dev home">
        <span class="brand-mark" aria-hidden="true"></span>
        <span class="brand-text">
          <span class="brand-name">Iain Reid</span>
          <span class="brand-domain">iainreid.dev</span>
        </span>
      </a>

      <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav">
        <span class="nav-toggle-bars" aria-hidden="true"></span>
        Menu
      </button>

      <nav class="site-nav" id="site-nav" aria-label="Primary">
        <a href="/#work"<?= $activeNav === 'work' ? ' aria-current="page"' : '' ?>>Work</a>
        <a href="/saas-lab/"<?= $activeNav === 'saas-lab' ? ' aria-current="page"' : '' ?>>SaaS Lab</a>
        <a href="/#experiments"<?= $activeNav === 'experiments' ? ' aria-current="page"' : '' ?>>Experiments</a>
        <a href="/#about"<?= $activeNav === 'about' ? ' aria-current="page"' : '' ?>>About</a>
        <a class="nav-external" href="https://github.com/cubixmeow-commits" rel="noopener noreferrer">GitHub</a>
      </nav>
    </div>
  </header>

  <main id="main">
    <?php require $viewFile; ?>
  </main>

  <footer class="site-footer">
    <div class="shell footer-inner">
      <div class="footer-brand">
        <p class="footer-title">iainreid.dev</p>
        <p class="footer-note">A living personal development portfolio. Continuously updated as projects move, stall, ship, or retire.</p>
      </div>
      <div class="footer-links">
        <a href="https://github.com/cubixmeow-commits" rel="noopener noreferrer">GitHub</a>
        <a href="mailto:hello@cubixmeow.com">hello@cubixmeow.com</a>
        <a href="/saas-lab/">SaaS Lab</a>
        <a href="/#work">Work</a>
      </div>
      <p class="footer-meta">&copy; <?= $year ?> Iain Reid Glendinning</p>
    </div>
  </footer>

  <script src="/assets/js/site.js" defer></script>
</body>
</html>
