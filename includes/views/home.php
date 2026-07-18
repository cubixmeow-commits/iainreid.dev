<?php

declare(strict_types=1);

/** @var list<array<string, mixed>> $projects */
/** @var list<array<string, mixed>> $currentWork */
/** @var array<string, mixed>|null $saasLab */

$experiments = array_values(array_filter(
    $projects,
    static fn(array $p): bool => in_array(($p['status'] ?? ''), ['experimental', 'paused', 'retired', 'archived'], true)
        || (($p['category'] ?? '') === 'experiment')
));
?>

<section class="hero" aria-labelledby="hero-heading">
  <div class="shell hero-grid">
    <div class="hero-copy">
      <p class="eyebrow">Personal development portfolio</p>
      <p class="hero-identity">I'm Iain Reid. I build, launch, and document software products.</p>
      <h1 id="hero-heading">I build software products and document what happens next.</h1>
      <p class="hero-lede">iainreid.dev is a living record of the products, experiments, systems, and lessons behind my work, from early prototypes to deployed applications.</p>
      <div class="hero-actions">
        <a class="btn btn-primary" href="#work">Explore the work</a>
        <a class="btn btn-secondary" href="/saas-lab/">Enter SaaS Lab</a>
      </div>
      <p class="focus-line">
        <span class="focus-dot" aria-hidden="true"></span>
        Current focus: SaaS Lab foundations and Rally competition rules
      </p>
    </div>
    <aside class="hero-panel" aria-label="Portfolio framing">
      <p class="panel-label">Workshop index</p>
      <dl class="hero-stats">
        <div>
          <dt>Show the work</dt>
          <dd>Active builds, experiments, pauses, and shipped products stay visible.</dd>
        </div>
        <div>
          <dt>SaaS Lab</dt>
          <dd>The operating system for rapid product experiments.</dd>
        </div>
        <div>
          <dt>Evidence over polish</dt>
          <dd>Deployed software and lessons matter more than mockups.</dd>
        </div>
      </dl>
    </aside>
  </div>
</section>

<section class="section" id="work" aria-labelledby="work-heading">
  <div class="shell">
    <div class="section-head">
      <p class="eyebrow">Current work</p>
      <h2 id="work-heading">What is being built now</h2>
      <p class="section-lede">A short view of active product and systems work. Status labels stay honest.</p>
    </div>
    <div class="current-grid">
      <?php foreach ($currentWork as $project): ?>
        <article class="current-card">
          <div class="current-top">
            <h3><?= e((string) $project['title']) ?></h3>
            <span class="status status--<?= e((string) $project['status']) ?>"><?= e(portfolio_status_label((string) $project['status'])) ?></span>
          </div>
          <p><?= e((string) $project['summary']) ?></p>
          <div class="archive-meta">
            <span class="meta-chip"><?= e((string) ($project['category'] ?? '')) ?></span>
            <?php foreach (($project['technologies'] ?? []) as $tech): ?>
              <span class="meta-chip meta-chip--tech"><?= e((string) $tech) ?></span>
            <?php endforeach; ?>
          </div>
          <div class="archive-actions">
            <?php if (!empty($project['detail_url'])): ?>
              <a class="text-link" href="<?= e((string) $project['detail_url']) ?>">Details</a>
            <?php endif; ?>
            <?php if (!empty($project['live_url'])): ?>
              <a class="text-link" href="<?= e((string) $project['live_url']) ?>" rel="noopener noreferrer">Live project</a>
            <?php endif; ?>
            <?php if (!empty($project['repository_url'])): ?>
              <a class="text-link" href="<?= e((string) $project['repository_url']) ?>" rel="noopener noreferrer">Repository</a>
            <?php endif; ?>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section section-lab" id="saas-lab" aria-labelledby="lab-heading">
  <div class="shell">
    <div class="section-head">
      <p class="eyebrow">SaaS Lab</p>
      <h2 id="lab-heading">A laboratory for turning ideas into evidence.</h2>
      <p class="section-lede">SaaS Lab is the system I use to organize, prototype, launch, and evaluate small software products. It replaces the repeated setup work behind every new idea with a reusable process, so more time can go toward testing whether the product is actually useful.</p>
    </div>

    <div class="lab-layout">
      <div class="lab-copy">
        <h3>Why it exists</h3>
        <p>Building the same infrastructure repeatedly creates friction. Authentication, databases, project structure, deployment config, admin tools, forms, status tracking, and experiment notes get rebuilt for every idea. SaaS Lab exists to make that process faster, more consistent, and more honest.</p>
        <p>The goal is not endless ideation. The goal is to shorten the distance from idea to working product to real-world evidence.</p>
        <div class="hero-actions">
          <a class="btn btn-primary" href="/saas-lab/">Open the SaaS Lab page</a>
          <?php if (!empty($saasLab['repository_url'])): ?>
            <a class="btn btn-secondary" href="<?= e((string) $saasLab['repository_url']) ?>" rel="noopener noreferrer">View the repository</a>
          <?php endif; ?>
        </div>
      </div>

      <ol class="lifecycle">
        <li>
          <span class="lifecycle-step">01</span>
          <div>
            <h3>Capture</h3>
            <p>Record the idea, the intended user, and the assumption worth testing.</p>
          </div>
        </li>
        <li>
          <span class="lifecycle-step">02</span>
          <div>
            <h3>Define</h3>
            <p>Cut the idea down to the smallest version that can teach something useful.</p>
          </div>
        </li>
        <li>
          <span class="lifecycle-step">03</span>
          <div>
            <h3>Build</h3>
            <p>Reuse shared foundations instead of starting from an empty folder.</p>
          </div>
        </li>
        <li>
          <span class="lifecycle-step">04</span>
          <div>
            <h3>Launch</h3>
            <p>Deploy a real prototype people can touch, not a slide deck.</p>
          </div>
        </li>
        <li>
          <span class="lifecycle-step">05</span>
          <div>
            <h3>Measure</h3>
            <p>Collect signals: usage, friction, confusion, and whether the problem is real.</p>
          </div>
        </li>
        <li>
          <span class="lifecycle-step">06</span>
          <div>
            <h3>Decide</h3>
            <p>Continue, revise, pause, or retire. Document the lesson either way.</p>
          </div>
        </li>
      </ol>
    </div>
  </div>
</section>

<section class="section" id="archive" aria-labelledby="archive-heading">
  <div class="shell">
    <div class="section-head">
      <p class="eyebrow">Project archive</p>
      <h2 id="archive-heading">Development history, not a highlight reel</h2>
      <p class="section-lede">This archive includes serious products and rapid experiments. A paused or unfinished project can still show product judgment, technical implementation, and what the attempt taught.</p>
    </div>
    <div class="archive-list">
      <?php foreach ($projects as $project): ?>
        <?php require portfolio_root() . '/includes/partials/project-row.php'; ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section" id="experiments" aria-labelledby="experiments-heading">
  <div class="shell">
    <div class="section-head">
      <p class="eyebrow">Experiments</p>
      <h2 id="experiments-heading">Small tests with clear lessons</h2>
      <p class="section-lede">Experiments exist to answer a question quickly. They are kept visible so the next build starts with better judgment.</p>
    </div>
    <div class="experiment-grid">
      <?php foreach ($experiments as $project): ?>
        <article class="experiment-item">
          <div class="current-top">
            <h3><?= e((string) $project['title']) ?></h3>
            <span class="status status--<?= e((string) $project['status']) ?>"><?= e(portfolio_status_label((string) $project['status'])) ?></span>
          </div>
          <p><?= e((string) $project['summary']) ?></p>
          <?php if (!empty($project['lessons'])): ?>
            <p class="archive-lesson"><span class="kicker">Lesson</span> <?= e((string) $project['lessons']) ?></p>
          <?php endif; ?>
          <?php if (!empty($project['repository_url'])): ?>
            <a class="text-link" href="<?= e((string) $project['repository_url']) ?>" rel="noopener noreferrer">Inspect the work</a>
          <?php endif; ?>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section" id="principles" aria-labelledby="principles-heading">
  <div class="shell">
    <div class="section-head">
      <p class="eyebrow">Operating principles</p>
      <h2 id="principles-heading">How the work gets done</h2>
      <p class="section-lede">Practical rules for shipping software that can survive contact with reality.</p>
    </div>
    <ol class="principles">
      <li>
        <h3>Build the smallest version that can teach something.</h3>
        <p>If a prototype cannot produce a lesson, it is probably still too vague.</p>
      </li>
      <li>
        <h3>Deploy real software instead of stopping at mockups.</h3>
        <p>A live path, even a rough one, exposes constraints that design files hide.</p>
      </li>
      <li>
        <h3>Prefer simple infrastructure that can be operated.</h3>
        <p>PHP-compatible hosting, portable storage, and few dependencies keep iteration cheap.</p>
      </li>
      <li>
        <h3>Reuse foundations instead of rebuilding boilerplate.</h3>
        <p>SaaS Lab exists so authentication, structure, and launch checklists do not consume every experiment.</p>
      </li>
      <li>
        <h3>Treat paused and failed experiments as evidence.</h3>
        <p>Stopping is useful when the decision and the lesson are written down.</p>
      </li>
      <li>
        <h3>Document decisions so the next build starts smarter.</h3>
        <p>The portfolio is a working memory, not a brochure.</p>
      </li>
    </ol>
  </div>
</section>

<section class="section section-about" id="about" aria-labelledby="about-heading">
  <div class="shell about-grid">
    <div>
      <p class="eyebrow">About</p>
      <h2 id="about-heading">Iain Reid</h2>
      <p class="section-lede">Developer and product builder focused on original web products, rapid prototyping, deployment, and practical AI-assisted development.</p>
      <p>I combine software development, product design, and experiment discipline. The public archive on this site is intentional: it shows what I am building, what I am testing, and what each attempt taught me.</p>
      <p>Core stack in current work: PHP, SQL databases such as SQLite and MySQL, and small front ends that stay maintainable on shared hosting.</p>
    </div>
    <aside class="about-aside" aria-label="Quick facts">
      <ul class="fact-list">
        <li><span>Identity</span> Iain Reid Glendinning</li>
        <li><span>Site</span> Living development portfolio</li>
        <li><span>System</span> SaaS Lab for rapid experiments</li>
        <li><span>Public work</span> GitHub under cubixmeow-commits</li>
        <li><span>Contact</span> <a href="mailto:hello@cubixmeow.com">hello@cubixmeow.com</a></li>
      </ul>
    </aside>
  </div>
</section>
