<?php

declare(strict_types=1);

/** @var array<string, mixed> $project */

$status = (string) ($project['status'] ?? 'experimental');
$title = (string) ($project['title'] ?? 'Untitled');
$summary = (string) ($project['summary'] ?? '');
$problem = (string) ($project['problem'] ?? '');
$lessons = (string) ($project['lessons'] ?? '');
$category = (string) ($project['category'] ?? '');
$year = (string) ($project['year'] ?? '');
$technologies = $project['technologies'] ?? [];
if (!is_array($technologies)) {
    $technologies = [];
}
?>
<article class="archive-row" id="project-<?= e((string) ($project['slug'] ?? '')) ?>">
  <div class="archive-main">
    <div class="archive-topline">
      <h3 class="archive-title"><?= e($title) ?></h3>
      <span class="status status--<?= e($status) ?>"><?= e(portfolio_status_label($status)) ?></span>
    </div>
    <p class="archive-summary"><?= e($summary) ?></p>
    <?php if ($problem !== ''): ?>
      <p class="archive-problem"><span class="kicker">Problem</span> <?= e($problem) ?></p>
    <?php endif; ?>
    <?php if ($lessons !== ''): ?>
      <p class="archive-lesson"><span class="kicker">Lesson</span> <?= e($lessons) ?></p>
    <?php endif; ?>
    <div class="archive-meta">
      <?php if ($year !== ''): ?><span class="meta-chip"><?= e($year) ?></span><?php endif; ?>
      <?php if ($category !== ''): ?><span class="meta-chip"><?= e($category) ?></span><?php endif; ?>
      <?php foreach ($technologies as $tech): ?>
        <span class="meta-chip meta-chip--tech"><?= e((string) $tech) ?></span>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="archive-actions">
    <?php if (!empty($project['detail_url'])): ?>
      <a class="text-link" href="<?= e((string) $project['detail_url']) ?>">Case notes</a>
    <?php endif; ?>
    <?php if (!empty($project['live_url'])): ?>
      <a class="text-link" href="<?= e((string) $project['live_url']) ?>" rel="noopener noreferrer">Live project</a>
    <?php endif; ?>
    <?php if (!empty($project['repository_url'])): ?>
      <a class="text-link" href="<?= e((string) $project['repository_url']) ?>" rel="noopener noreferrer">Repository</a>
    <?php endif; ?>
  </div>
</article>
