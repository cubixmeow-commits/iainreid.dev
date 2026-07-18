<?php

declare(strict_types=1);

/** @var array<string, mixed>|null $saasLab */
/** @var list<array<string, mixed>> $related */

$status = (string) ($saasLab['status'] ?? 'active');
?>

<section class="hero hero-compact" aria-labelledby="lab-page-heading">
  <div class="shell">
    <p class="eyebrow">System project</p>
    <h1 id="lab-page-heading">SaaS Lab</h1>
    <p class="hero-lede">A structured environment for turning software ideas into small, testable products, then deciding what the evidence says next.</p>
    <div class="hero-actions">
      <?php if (!empty($saasLab['repository_url'])): ?>
        <a class="btn btn-primary" href="<?= e((string) $saasLab['repository_url']) ?>" rel="noopener noreferrer">Open the repository</a>
      <?php endif; ?>
      <a class="btn btn-secondary" href="/#archive">Back to the archive</a>
    </div>
    <p class="focus-line">
      <span class="status status--<?= e($status) ?>"><?= e(portfolio_status_label($status)) ?></span>
      <span>V1 implemented. Broader validation tooling is planned, not claimed as finished.</span>
    </p>
  </div>
</section>

<section class="section" aria-labelledby="what-heading">
  <div class="shell narrow">
    <h2 id="what-heading">What SaaS Lab is</h2>
    <p>SaaS Lab is both a real software project and the operating system used to organize, build, launch, and evaluate multiple SaaS experiments.</p>
    <p>It exists because too much development time can be lost rebuilding the same foundation for every new idea. Instead of starting from an empty folder, SaaS Lab provides a repeatable structure for capturing ideas, defining scope, launching prototypes, and recording lessons.</p>
  </div>
</section>

<section class="section" aria-labelledby="problem-heading">
  <div class="shell narrow">
    <h2 id="problem-heading">The problem it solves</h2>
    <p>Common repeated work includes authentication, database setup, project structure, deployment configuration, admin tools, forms, user state, status tracking, documentation, launch checklists, analytics hooks, and experiment notes.</p>
    <p>That repetition creates friction before any product learning can begin. SaaS Lab is meant to reduce that distance between idea, working product, and real-world evidence.</p>
  </div>
</section>

<section class="section" aria-labelledby="why-heading">
  <div class="shell narrow">
    <h2 id="why-heading">Why it was created</h2>
    <p>The goal is not to generate endless ideas. The goal is to make small product tests cheaper to run and easier to judge honestly.</p>
    <p>SaaS Lab should help answer practical questions: Is the idea worth building? What is the smallest useful version? Can it be deployed quickly? Does anyone actually need it? What evidence supports continuing? What did the experiment teach?</p>
  </div>
</section>

<section class="section" aria-labelledby="lifecycle-heading">
  <div class="shell">
    <div class="section-head">
      <h2 id="lifecycle-heading">Experiment lifecycle</h2>
      <p class="section-lede">A simple loop used across the portfolio.</p>
    </div>
    <ol class="lifecycle lifecycle-wide">
      <li><span class="lifecycle-step">01</span><div><h3>Capture</h3><p>Write down the idea and the assumption under test.</p></div></li>
      <li><span class="lifecycle-step">02</span><div><h3>Define</h3><p>Set the smallest scope that can produce evidence.</p></div></li>
      <li><span class="lifecycle-step">03</span><div><h3>Build</h3><p>Launch from shared foundations instead of blank scaffolding.</p></div></li>
      <li><span class="lifecycle-step">04</span><div><h3>Launch</h3><p>Put a real prototype somewhere people can use it.</p></div></li>
      <li><span class="lifecycle-step">05</span><div><h3>Measure</h3><p>Watch usage, confusion, and whether the problem holds.</p></div></li>
      <li><span class="lifecycle-step">06</span><div><h3>Decide</h3><p>Continue, revise, pause, or retire, then document the lesson.</p></div></li>
    </ol>
  </div>
</section>

<section class="section" aria-labelledby="now-heading">
  <div class="shell split-panels">
    <div class="info-panel">
      <h2 id="now-heading">Implemented now</h2>
      <ul class="plain-list">
        <li>Shared user accounts and authentication</li>
        <li>Installer and platform migrations</li>
        <li>Project factory with one starter template (`logged-in-prototype`)</li>
        <li>Isolated project databases</li>
        <li>Project create, open, and archive flows</li>
        <li>Activity events and a Founder Dashboard</li>
        <li>PHP and SQLite stack aimed at low-cost shared hosting</li>
      </ul>
    </div>
    <div class="info-panel info-panel--planned">
      <h2>Planned / developing</h2>
      <ul class="plain-list">
        <li>Broader validation and portfolio-management tools</li>
        <li>Richer experiment notes and decision records</li>
        <li>Additional project templates beyond the V1 starter</li>
        <li>Clearer public links from each lab project into this portfolio archive</li>
      </ul>
      <p class="panel-note">These items are labeled planned so they are not mistaken for finished capabilities.</p>
    </div>
  </div>
</section>

<section class="section" aria-labelledby="tech-heading">
  <div class="shell narrow">
    <h2 id="tech-heading">Technical positioning</h2>
    <p>SaaS Lab is intentionally practical: small deployable applications, simple infrastructure, PHP-compatible deployment, SQLite storage, low operational cost, minimal dependencies, and shared-hosting compatibility.</p>
    <p>No Node.js build step, Docker requirement, or Composer package set is required for V1.</p>
    <div class="archive-meta">
      <?php foreach (($saasLab['technologies'] ?? []) as $tech): ?>
        <span class="meta-chip meta-chip--tech"><?= e((string) $tech) ?></span>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section" aria-labelledby="related-heading">
  <div class="shell">
    <div class="section-head">
      <h2 id="related-heading">Related portfolio work</h2>
      <p class="section-lede">Projects that show the same product-building approach SaaS Lab is meant to accelerate. Not every project below was generated inside SaaS Lab yet.</p>
    </div>
    <div class="archive-list">
      <?php foreach ($related as $project): ?>
        <?php require portfolio_root() . '/includes/partials/project-row.php'; ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section" aria-labelledby="next-heading">
  <div class="shell narrow">
    <h2 id="next-heading">Current status and next milestone</h2>
    <p>V1 phases for installation, auth, routing, project creation, the starter template, events, and the Founder Dashboard are implemented in the SaaS Lab repository.</p>
    <p>Next milestone: keep the lab deployable beside this portfolio, then use it to launch the next small experiment with less repeated setup and clearer decision notes.</p>
  </div>
</section>
