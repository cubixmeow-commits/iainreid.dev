<?php

declare(strict_types=1);

$projects = require __DIR__ . '/includes/projects.php';
$current = $projects[0];
$archive = array_slice($projects, 1);

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The workshop journal of Iain Reid, an independent software developer building practical systems, experiments, and digital tools.">
    <title>Iain Reid — The Workshop Journal</title>
    <link rel="stylesheet" href="assets/css/style.css?v=20260719f">
</head>
<body>
    <div class="ambient-light" aria-hidden="true"></div>
    <div class="dust" aria-hidden="true"></div>

    <header class="site-header">
        <a class="maker-mark" href="#top" aria-label="Return to the beginning">
            <span class="maker-mark__sigil">IR</span>
            <span>
                <strong>Iain Reid</strong>
                <small>Independent software developer</small>
            </span>
        </a>
        <button
            class="nav-toggle"
            type="button"
            aria-expanded="false"
            aria-controls="site-nav"
            aria-label="Open menu">
            <span class="nav-toggle__bars" aria-hidden="true"></span>
        </button>
        <nav id="site-nav" aria-label="Primary navigation">
            <a href="#journal">Journal</a>
            <a href="#workshop">Workshop</a>
            <a href="/site/saas-lab/">SaaS Lab</a>
            <a href="#archive">Archive</a>
            <a href="#about">The Maker</a>
        </nav>
    </header>

    <main id="top">
        <section class="hero" id="journal">
            <div class="workbench" aria-hidden="true">
                <div class="instrument instrument--compass"></div>
                <div class="instrument instrument--ruler"></div>
                <div class="inkwell"></div>
            </div>

            <div class="journal" data-reveal>
                <article class="journal-page journal-page--left">
                    <div class="page-number">Workshop Log · 001</div>
                    <svg class="journal-sigil" viewBox="0 0 160 160" role="img" aria-label="Decorative engineering sigil">
                        <circle cx="80" cy="80" r="56"/>
                        <circle cx="80" cy="80" r="34"/>
                        <path d="M80 12v136M12 80h136M32 32l96 96M128 32l-96 96"/>
                        <circle cx="80" cy="80" r="7"/>
                    </svg>
                    <p class="margin-note">A record of useful machines, unfinished ideas, and the systems that survived the forge.</p>
                </article>

                <article class="journal-page journal-page--right">
                    <p class="kicker">The Workshop Journal of</p>
                    <h1>Iain Reid</h1>
                    <p class="hero-copy">I design practical software systems that turn complicated work into clear, usable experiences.</p>
                    <div class="ink-rule"></div>
                    <p class="hero-note">Currently shaping small SaaS products, guided AI workflows, creative engines, and tools built for real people rather than demo reels.</p>
                    <a class="text-link" href="#workshop">Open the current entry <span aria-hidden="true">↓</span></a>
                </article>
            </div>
        </section>

        <section class="section section--current" id="workshop">
            <div class="section-heading" data-reveal>
                <p class="kicker">Entry I · On the workbench</p>
                <h2>Current Experiment</h2>
                <p>The newest system taking shape in the workshop.</p>
            </div>

            <article class="blueprint" data-reveal>
                <div class="blueprint__diagram" aria-hidden="true">
                    <svg viewBox="0 0 520 360">
                        <rect x="38" y="42" width="444" height="276" rx="4"/>
                        <circle cx="260" cy="180" r="96"/>
                        <circle cx="260" cy="180" r="48"/>
                        <path d="M260 84v192M164 180h192M192 112l136 136M328 112 192 248"/>
                        <path d="M72 82h88M72 104h58M360 256h84M386 278h58"/>
                        <path d="M92 262c38-58 82-75 132-52M296 148c45-34 91-29 136 16"/>
                    </svg>
                    <span class="diagram-label diagram-label--a">validation loop</span>
                    <span class="diagram-label diagram-label--b">experiment ledger</span>
                </div>

                <div class="blueprint__content">
                    <span class="artifact-number"><?= e($current['mark']) ?></span>
                    <p class="kicker"><?= e($current['eyebrow']) ?></p>
                    <h3><?= e($current['title']) ?></h3>
                    <p><?= e($current['description']) ?></p>
                    <dl class="spec-list">
                        <div><dt>Status</dt><dd><?= e($current['status']) ?></dd></div>
                        <div><dt>Materials</dt><dd><?= e(implode(' · ', $current['materials'])) ?></dd></div>
                        <div><dt>Purpose</dt><dd>Rapidly test whether an idea deserves to become a product.</dd></div>
                    </dl>
                    <?php if (($current['slug'] ?? '') === 'saas-lab'): ?>
                        <a class="text-link text-link--workshop" href="/site/saas-lab/">Enter SaaS Lab <span aria-hidden="true">→</span></a>
                    <?php endif; ?>
                </div>
            </article>
        </section>

        <section class="section" id="archive">
            <div class="section-heading" data-reveal>
                <p class="kicker">Shelf II · Selected constructions</p>
                <h2>Workshop Archive</h2>
                <p>Systems, prototypes, and creative machinery documented as working artifacts.</p>
            </div>

            <div class="artifact-grid">
                <?php foreach ($archive as $project): ?>
                    <article class="artifact-card" data-reveal>
                        <div class="artifact-card__topline">
                            <span class="artifact-number"><?= e($project['mark']) ?></span>
                            <span class="status-dot"></span>
                            <span><?= e($project['status']) ?></span>
                        </div>
                        <p class="kicker"><?= e($project['eyebrow']) ?></p>
                        <h3><?= e($project['title']) ?></h3>
                        <p><?= e($project['description']) ?></p>
                        <div class="materials" aria-label="Technologies used">
                            <?php foreach ($project['materials'] as $material): ?>
                                <span><?= e($material) ?></span>
                            <?php endforeach; ?>
                        </div>
                        <div class="card-etching" aria-hidden="true"></div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="section maker-section" id="about" data-reveal>
            <div class="maker-portrait">
                <img
                    src="assets/images/portrait.jpg"
                    alt="Portrait of Iain Reid"
                    width="400"
                    height="500"
                    decoding="async">
            </div>
            <div class="maker-copy">
                <p class="kicker">A note about the maker</p>
                <h2>Software as craftsmanship</h2>
                <p>I build because I like turning vague ideas into systems people can actually use. My work sits between product design, engineering, experimentation, and the practical application of modern AI tools.</p>
                <p>This archive is not arranged as a list of technologies. It is a record of problems studied, mechanisms designed, and useful things made.</p>
                <div class="signature">Iain Reid</div>
                <ul class="maker-contact">
                    <li>
                        <a href="mailto:iain@iainreid.dev">
                            <svg class="contact-icon" viewBox="0 0 24 24" width="16" height="16" aria-hidden="true" focusable="false">
                                <path fill="currentColor" d="M3 6.75A1.75 1.75 0 0 1 4.75 5h14.5A1.75 1.75 0 0 1 21 6.75v10.5A1.75 1.75 0 0 1 19.25 19H4.75A1.75 1.75 0 0 1 3 17.25V6.75Zm1.75-.25a.25.25 0 0 0-.25.25v.3l7.1 4.62c.25.16.55.16.8 0l7.1-4.62v-.3a.25.25 0 0 0-.25-.25H4.75Zm15.5 2.52-6.55 4.26a2.25 2.25 0 0 1-2.4 0L4.75 9.02v8.23c0 .14.11.25.25.25h14.5a.25.25 0 0 0 .25-.25V9.02Z"/>
                            </svg>
                            <span>iain@iainreid.dev</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://x.com/realiainreid" target="_blank" rel="noopener noreferrer">
                            <svg class="contact-icon" viewBox="0 0 24 24" width="16" height="16" aria-hidden="true" focusable="false">
                                <path fill="currentColor" d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.727-8.835L1.992 2.25H8.08l4.259 5.686L18.244 2.25Zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77Z"/>
                            </svg>
                            <span>@realiainreid</span>
                        </a>
                    </li>
                </ul>
            </div>
        </section>
    </main>

    <footer>
        <span>iainreid.dev</span>
        <span>Workshop record · <?= date('Y') ?></span>
    </footer>

    <script src="assets/js/app.js?v=20260719c"></script>
</body>
</html>
