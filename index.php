<?php

declare(strict_types=1);

/**
 * iainreid.dev — Workshop Journal homepage
 * Self-contained: PHP data, HTML, CSS, and small vanilla JS.
 * Runs on PHP 8.2 (Namecheap shared hosting / LiteSpeed).
 */

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$year = (int) date('Y');
$canonical = 'https://iainreid.dev/';
$pageTitle = 'Iain Reid — VibeKB, SousMeow, and Arcana';
$pageDescription = 'Iain Reid builds VibeKB, SousMeow, and Arcana: practical systems for software understanding, guided AI workflows, and production creative generation.';

$links = [
    'github' => 'https://github.com/cubixmeow-commits',
    'x' => 'https://x.com/realiainreid',
    'x_handle' => '@realiainreid',
    'email' => 'iain@iainreid.dev',
    'mailto' => 'mailto:iain@iainreid.dev',
    'vibekb_repo' => 'https://github.com/cubixmeow-commits/VibeKB',
    'sousmeow' => 'https://cubixmeow.com/iain/projects/sousmeow/public/',
    'arcana_repo' => 'https://github.com/cubixmeow-commits/youarethesongnow',
    'arcana_product' => 'https://youarethesongnow.com',
    'arcana_understanding' => 'https://cubixmeow-commits.github.io/youarethesongnow/',
    'stoppr_repo' => 'https://github.com/cubixmeow-commits/VibeKB-stoppr',
    'stoppr_understanding' => 'https://cubixmeow-commits.github.io/VibeKB-stoppr/',
];

$projects = [
    [
        'id' => 'vibekb',
        'entry' => 'Entry I',
        'label' => 'Current masterwork',
        'title' => 'VibeKB',
        'mark' => 'I',
        'status' => 'Active',
        'summary' => 'Turns an unfamiliar software repository into a living understanding site—documenting what the software currently does, how components connect, where functionality lives, what is verified, and what remains uncertain.',
    ],
    [
        'id' => 'sousmeow',
        'entry' => 'Entry II',
        'label' => 'Guided machinery',
        'title' => 'SousMeow',
        'mark' => 'II',
        'status' => 'Active prototype',
        'summary' => 'A guided workflow system that helps people complete substantial tasks using the AI subscriptions they already have.',
    ],
    [
        'id' => 'arcana',
        'entry' => 'Entry III',
        'label' => 'Production engine',
        'title' => 'Arcana / You Are The Song Now',
        'mark' => 'III',
        'status' => 'Working system',
        'summary' => 'Transforms a song, lyrics, band identity, style direction, and optional portrait references into a single cinematic visual composition.',
    ],
];

$fieldProofs = [
    [
        'title' => 'Arcana / You Are The Song Now',
        'specimen' => 'Specimen A',
        'context' => 'VibeKB documenting a real PHP / MySQL / Gemini production application.',
        'findings' => [
            'Authentication and email verification paths',
            'Credits, plan gating, and Stripe assumptions',
            'Uploads, image generation, and queue workers',
            'Gallery behavior, watermarks, and render storage',
            'Deployment assumptions, warnings, and uncertainty',
        ],
        'repo' => $links['arcana_repo'],
        'understanding' => $links['arcana_understanding'],
    ],
    [
        'title' => 'Stoppr',
        'specimen' => 'Specimen B',
        'context' => 'VibeKB applied to a separate mobile application and its surrounding architecture.',
        'findings' => [
            'Implemented versus partial functionality',
            'Paywall and subscription flows',
            'Superwall integration and placeholder configuration',
            'OAuth assumptions',
            'Widget and app-group concerns',
            'Verified and inferred architecture boundaries',
        ],
        'repo' => $links['stoppr_repo'],
        'understanding' => $links['stoppr_understanding'],
    ],
];

$vibekbFlow = [
    ['id' => 'repo', 'label' => 'Repository', 'note' => 'Source of truth'],
    ['id' => 'model', 'label' => 'Functionality model', 'note' => 'What the software does'],
    ['id' => 'files', 'label' => 'Warnings & files', 'note' => 'Evidence with reasons'],
    ['id' => 'diagrams', 'label' => 'Explainable Diagrams', 'note' => 'Nodes and edges'],
    ['id' => 'site', 'label' => 'Understanding site', 'note' => 'Static, shareable'],
];

$vibekbNotes = [
    'Functionality-first model',
    'Nodes explain what components are',
    'Edges explain why they connect',
    'Verified versus inferred relationships',
    'Files always include reasons',
    'No graph database required',
    'Static output suitable for GitHub Pages',
];

$sousmeowFlow = [
    ['label' => 'Pantry', 'hint' => 'Persistent context'],
    ['label' => 'Recipe', 'hint' => 'One sequential step'],
    ['label' => 'Run in ChatGPT / Claude / Gemini', 'hint' => 'Use existing subscriptions'],
    ['label' => 'Bring back result', 'hint' => 'Capture the artifact'],
    ['label' => 'Quality check', 'hint' => 'Success criteria & failure signals'],
    ['label' => 'Next Recipe', 'hint' => 'Continue the workflow'],
    ['label' => 'Project Kit', 'hint' => 'Exportable outcomes'],
];

$arcanaFlow = [
    ['label' => 'Song input', 'hint' => 'Lyrics, identity, style'],
    ['label' => 'Analysis', 'hint' => 'Gemini → Song DNA'],
    ['label' => 'Prompt construction', 'hint' => 'Structured direction'],
    ['label' => 'Queue', 'hint' => 'Job intake'],
    ['label' => 'Worker', 'hint' => 'Parallel cron paths'],
    ['label' => 'Image service', 'hint' => 'Generation + fallbacks'],
    ['label' => 'Storage', 'hint' => 'Renders retained'],
    ['label' => 'Gallery', 'hint' => 'Watermarked presentation'],
];

$methodEntries = [
    [
        'mark' => '01',
        'title' => 'Find the real friction',
        'body' => 'Begin with the actual problem experienced by the user—not the abstract technology story.',
        'ties' => [
            'VibeKB' => 'Starts from the confusion that follows AI-assisted code.',
            'SousMeow' => 'Starts from unfinished AI work and brittle prompt habits.',
            'Arcana' => 'Starts from the gap between song intent and finished visuals.',
        ],
    ],
    [
        'mark' => '02',
        'title' => 'Build the smallest complete mechanism',
        'body' => 'Favor one complete end-to-end loop over many disconnected features.',
        'ties' => [
            'VibeKB' => 'Repository in → understanding site out.',
            'SousMeow' => 'Pantry → recipe → review → next step.',
            'Arcana' => 'Song in → queued render → gallery out.',
        ],
    ],
    [
        'mark' => '03',
        'title' => 'Make the system explain itself',
        'body' => 'Capture architecture, warnings, decisions, status, and handoffs in the repository.',
        'ties' => [
            'VibeKB' => 'The product is the explanation.',
            'SousMeow' => 'Every step carries success criteria and failure signals.',
            'Arcana' => 'Song DNA, queue state, and admin controls stay inspectable.',
        ],
    ],
    [
        'mark' => '04',
        'title' => 'Ship for the environment that exists',
        'body' => 'Design around actual hosting, deployment, maintenance, and operating constraints.',
        'ties' => [
            'VibeKB' => 'Static output that can live on GitHub Pages.',
            'SousMeow' => 'Works with free or paid AI subscriptions; no required API metering.',
            'Arcana' => 'Built for shared hosting, cron workers, and real billing paths.',
        ],
    ],
];

$capabilityGroups = [
    [
        'title' => 'Product systems',
        'items' => [
            'Product architecture',
            'Workflow design',
            'Authentication',
            'Billing and credits',
            'Administration and maintenance',
        ],
    ],
    [
        'title' => 'AI systems',
        'items' => [
            'Structured prompting',
            'Gemini integration',
            'Image generation',
            'Response review',
            'Human-in-the-loop workflows',
        ],
    ],
    [
        'title' => 'Application engineering',
        'items' => [
            'PHP 8.2',
            'MySQL',
            'SQLite',
            'Vanilla JavaScript',
            'HTML and CSS',
            'Cron and queue workers',
            'File and image processing',
            'Shared-hosting deployment',
        ],
    ],
    [
        'title' => 'Software understanding',
        'items' => [
            'Repository analysis',
            'Functionality mapping',
            'Explainable diagrams',
            'Provenance',
            'Warnings and uncertainty',
            'Static knowledge generation',
            'Agent handoffs',
        ],
    ],
];

$journalIndex = [
    ['mark' => 'I', 'title' => 'VibeKB', 'line' => 'Repository understanding'],
    ['mark' => 'II', 'title' => 'SousMeow', 'line' => 'Guided AI workflows'],
    ['mark' => 'III', 'title' => 'Arcana', 'line' => 'Production creative engine'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle) ?></title>
    <meta name="description" content="<?= e($pageDescription) ?>">
    <link rel="canonical" href="<?= e($canonical) ?>">
    <meta property="og:title" content="<?= e($pageTitle) ?>">
    <meta property="og:description" content="<?= e($pageDescription) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= e($canonical) ?>">
    <meta name="theme-color" content="#0d0c0a">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600&family=EB+Garamond:ital,wght@0,500;0,600;1,500&display=swap" rel="stylesheet">
    <style>
:root {
    --night: #0d0c0a;
    --stone: #171512;
    --wood: #241a12;
    --paper: #d8c79e;
    --paper-light: #eee1bd;
    --ink: #241c12;
    --ink-soft: #4a3d2a;
    --brass: #ae8540;
    --brass-light: #d2ad62;
    --moss: #456457;
    --moss-light: #5f8574;
    --ivory: #f0e8d4;
    --muted: #b7ad99;
    --muted-strong: #cfc4ae;
    --line: rgba(201, 164, 91, .34);
    --blueprint: #17332f;
    --blueprint-ink: #d5e6e0;
    --blueprint-line: rgba(179, 220, 208, .55);
    --blueprint-muted: #a8c4bb;
    --serif: "EB Garamond", "Palatino Linotype", Palatino, Georgia, serif;
    --display: "Cinzel", "Palatino Linotype", Georgia, serif;
    --sans: "Segoe UI", ui-sans-serif, system-ui, -apple-system, sans-serif;
    --mono: ui-monospace, "Cascadia Code", "Segoe UI Mono", Menlo, Consolas, monospace;
    --shadow: 0 22px 55px rgba(0, 0, 0, .48);
    --focus: 0 0 0 2px var(--night), 0 0 0 4px var(--brass-light);
    --body: 1.05rem;
    --measure: 38rem;
}

*, *::before, *::after { box-sizing: border-box; }

html {
    scroll-behavior: smooth;
    overflow-x: hidden;
    max-width: 100%;
}

body {
    margin: 0;
    min-width: 320px;
    max-width: 100%;
    color: var(--ivory);
    font-family: var(--sans);
    font-size: var(--body);
    line-height: 1.65;
    overflow-x: hidden;
    background:
        radial-gradient(circle at 50% 0%, rgba(139, 94, 39, .14), transparent 34rem),
        linear-gradient(rgba(255,255,255,.01) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.007) 1px, transparent 1px),
        var(--night);
    background-size: auto, 48px 48px, 48px 48px, auto;
}

body::before {
    content: "";
    position: fixed;
    inset: 0;
    pointer-events: none;
    z-index: 50;
    background: radial-gradient(circle at center, transparent 52%, rgba(0,0,0,.28) 100%);
}

a { color: inherit; }
p { margin: 0 0 1rem; }
h1, h2, h3, h4 {
    margin: 0;
    font-family: var(--display);
    font-weight: 600;
    line-height: 1.15;
    letter-spacing: .02em;
}

img { max-width: 100%; height: auto; display: block; }

:focus-visible {
    outline: 2px solid var(--brass-light);
    outline-offset: 3px;
}

.skip-link {
    position: absolute;
    left: 1rem;
    top: -4rem;
    z-index: 100;
    padding: .7rem 1rem;
    background: var(--paper);
    color: var(--ink);
    text-decoration: none;
    font-family: var(--display);
    font-size: .75rem;
    letter-spacing: .08em;
    text-transform: uppercase;
}
.skip-link:focus { top: 1rem; }

.ambient-light {
    position: fixed;
    width: min(36rem, 100vw);
    height: 36rem;
    top: -16rem;
    left: 50%;
    translate: -50% 0;
    border-radius: 50%;
    background: rgba(193, 125, 47, .12);
    filter: blur(80px);
    pointer-events: none;
    animation: candle 7s ease-in-out infinite alternate;
}

.dust {
    position: fixed;
    inset: 0;
    width: 100%;
    max-width: 100%;
    opacity: .14;
    pointer-events: none;
    overflow: hidden;
    background-image:
        radial-gradient(circle, rgba(238,225,189,.75) 0 1px, transparent 1.5px),
        radial-gradient(circle, rgba(238,225,189,.45) 0 1px, transparent 1.5px);
    background-size: 157px 173px, 211px 193px;
    background-position: 0 0, 71px 49px;
    animation: drift 32s linear infinite;
}

.site-header {
    position: fixed;
    z-index: 30;
    top: 0;
    left: 0;
    right: 0;
    width: 100%;
    max-width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    padding: .95rem clamp(1rem, 4vw, 3.5rem);
    border-bottom: 1px solid transparent;
    transition: background .25s ease, border-color .25s ease, backdrop-filter .25s ease;
}
.site-header.is-scrolled {
    background: rgba(13, 12, 10, .9);
    border-color: var(--line);
    backdrop-filter: blur(16px);
}

.maker-mark {
    display: flex;
    align-items: center;
    gap: .75rem;
    text-decoration: none;
    min-width: 0;
}
.maker-mark__sigil {
    display: grid;
    place-items: center;
    width: 2.45rem;
    aspect-ratio: 1;
    border: 1px solid var(--brass);
    rotate: 45deg;
    color: var(--brass-light);
    font-family: var(--display);
    font-size: .72rem;
    flex: 0 0 auto;
}
.maker-mark__sigil span {
    display: block;
    rotate: -45deg;
}
.maker-mark strong,
.maker-mark small { display: block; }
.maker-mark strong {
    font-family: var(--display);
    font-size: .86rem;
    letter-spacing: .08em;
}
.maker-mark small {
    color: var(--muted);
    font-size: .72rem;
}

.nav-toggle {
    display: none;
    position: relative;
    z-index: 40;
    width: 2.75rem;
    height: 2.75rem;
    flex: 0 0 auto;
    padding: 0;
    border: 1px solid var(--line);
    background: rgba(13, 12, 10, .78);
    color: var(--brass-light);
    cursor: pointer;
}
.nav-toggle__bars,
.nav-toggle__bars::before,
.nav-toggle__bars::after {
    display: block;
    width: 1.05rem;
    height: 1px;
    margin: 0 auto;
    background: currentColor;
    transition: transform .25s ease, opacity .2s ease;
}
.nav-toggle__bars::before,
.nav-toggle__bars::after { content: ""; }
.nav-toggle__bars::before { translate: 0 -.35rem; }
.nav-toggle__bars::after { translate: 0 .35rem; }
.site-header.is-nav-open .nav-toggle__bars { background: transparent; }
.site-header.is-nav-open .nav-toggle__bars::before { translate: 0 0; rotate: 45deg; }
.site-header.is-nav-open .nav-toggle__bars::after { translate: 0 0; rotate: -45deg; }

#site-nav {
    display: flex;
    align-items: center;
    gap: clamp(.75rem, 2vw, 1.6rem);
}
#site-nav a {
    color: var(--muted-strong);
    text-decoration: none;
    font-size: .74rem;
    letter-spacing: .1em;
    text-transform: uppercase;
    transition: color .2s ease;
}
#site-nav a:hover,
#site-nav a:focus-visible { color: var(--paper-light); }

.hero {
    position: relative;
    display: grid;
    place-items: center;
    min-height: 100svh;
    padding: 6.5rem clamp(1rem, 4vw, 3.5rem) 3.5rem;
    isolation: isolate;
    overflow: hidden;
}
.hero::before {
    content: "";
    position: absolute;
    inset: 0;
    z-index: -3;
    background:
        linear-gradient(to bottom, rgba(8,7,6,.18), rgba(8,7,6,.5) 70%, var(--night)),
        radial-gradient(ellipse at center 65%, rgba(129,78,31,.28), transparent 38%),
        linear-gradient(115deg, #0c0b09 0 18%, #1c140e 18% 22%, #100e0b 22% 78%, #1b130d 78% 82%, #0c0b09 82%);
}
.hero::after {
    content: "";
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    height: 32%;
    z-index: -2;
    background:
        repeating-linear-gradient(92deg, transparent 0 90px, rgba(0,0,0,.24) 92px 95px),
        linear-gradient(180deg, #2d1d12, #130d09 75%);
    transform: perspective(800px) rotateX(57deg);
    transform-origin: bottom;
    box-shadow: inset 0 12px 30px rgba(0,0,0,.5);
}

.workbench {
    position: absolute;
    inset: auto 0 5% 0;
    height: 28%;
    pointer-events: none;
}
.instrument,
.inkwell {
    position: absolute;
    opacity: .42;
    filter: drop-shadow(0 10px 7px rgba(0,0,0,.4));
}
.instrument--compass {
    left: 7%;
    bottom: 25%;
    width: 7rem;
    aspect-ratio: 1;
    border: 2px solid var(--brass);
    border-radius: 50%;
}
.instrument--compass::before,
.instrument--compass::after {
    content: "";
    position: absolute;
    inset: 49% 8%;
    height: 1px;
    background: var(--brass);
}
.instrument--compass::after { rotate: 90deg; }
.instrument--ruler {
    right: 4%;
    bottom: 24%;
    width: 12rem;
    height: 2.2rem;
    border: 1px solid #98723c;
    rotate: -13deg;
    background: repeating-linear-gradient(90deg, transparent 0 11px, #98723c 12px 13px);
}
.inkwell {
    right: 17%;
    bottom: 30%;
    width: 3.4rem;
    height: 3.7rem;
    border: 2px solid #30251d;
    border-radius: 40% 40% 15% 15%;
    background: linear-gradient(135deg, #5c534a, #151210);
}

.journal {
    position: relative;
    display: grid;
    grid-template-columns: .92fr 1.08fr;
    width: min(100%, 68rem);
    min-height: 32rem;
    transform: perspective(1500px) rotateX(1.5deg);
    filter: drop-shadow(0 30px 32px rgba(0,0,0,.58));
    max-width: 100%;
}
.journal::before {
    content: "";
    position: absolute;
    inset: -.85rem;
    z-index: -1;
    border-radius: .85rem;
    background: #25170f;
    box-shadow: inset 0 0 0 3px #4b3020, 0 0 0 1px #0b0806;
}
.journal::after {
    content: "";
    position: absolute;
    top: .5rem;
    bottom: .5rem;
    left: 50%;
    width: 2.2rem;
    translate: -50% 0;
    background: linear-gradient(90deg, rgba(58,39,23,.14), rgba(50,33,19,.5), rgba(255,255,255,.08), rgba(58,39,23,.18));
    filter: blur(3px);
    pointer-events: none;
}

.journal-page {
    position: relative;
    overflow: hidden;
    padding: clamp(1.6rem, 4vw, 3.4rem);
    color: var(--ink);
    background:
        radial-gradient(circle at 15% 12%, rgba(255,255,255,.22), transparent 24%),
        repeating-linear-gradient(0deg, rgba(64,45,23,.018) 0 1px, transparent 1px 6px),
        var(--paper);
    box-shadow: inset 0 0 40px rgba(74,46,17,.16);
}
.journal-page--left {
    border-radius: .4rem 0 0 .4rem;
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}
.journal-page--right {
    border-radius: 0 .4rem .4rem 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.page-number {
    font-family: var(--display);
    font-size: .68rem;
    letter-spacing: .16em;
    text-transform: uppercase;
    color: #6a5530;
}
.journal-sigil {
    width: min(58%, 11rem);
    align-self: center;
    fill: none;
    stroke: rgba(47,36,23,.55);
    stroke-width: 1.2;
    margin: .4rem 0;
}
.margin-note {
    margin: 0;
    max-width: 22rem;
    font-family: var(--serif);
    font-style: italic;
    font-size: 1.08rem;
    line-height: 1.45;
    color: var(--ink-soft);
}
.journal-index {
    margin: auto 0 0;
    padding: 0;
    list-style: none;
    width: 100%;
    border-top: 1px solid rgba(79, 61, 36, .28);
}
.journal-index li {
    display: grid;
    grid-template-columns: 1.6rem 1fr;
    gap: .55rem .75rem;
    padding: .7rem 0;
    border-bottom: 1px solid rgba(79, 61, 36, .18);
}
.journal-index .mark {
    font-family: var(--mono);
    font-size: .72rem;
    color: #6a5530;
}
.journal-index strong {
    display: block;
    font-family: var(--display);
    font-size: .82rem;
    letter-spacing: .04em;
}
.journal-index span {
    display: block;
    font-size: .86rem;
    color: var(--ink-soft);
}

.kicker {
    margin: 0 0 .65rem;
    color: var(--brass-light);
    font-family: var(--display);
    font-size: .72rem;
    letter-spacing: .15em;
    text-transform: uppercase;
}
.journal .kicker { color: #69522c; }
.journal h1 {
    font-size: clamp(2.6rem, 6vw, 4.6rem);
    max-width: 14ch;
}
.hero-copy {
    margin: 1.15rem 0 0;
    font-family: var(--serif);
    font-size: clamp(1.28rem, 2.2vw, 1.72rem);
    line-height: 1.35;
    color: var(--ink);
    max-width: 28ch;
}
.hero-note {
    margin: 0;
    font-size: 1rem;
    line-height: 1.55;
    color: var(--ink-soft);
    max-width: 36ch;
}
.ink-rule {
    width: 100%;
    height: 1px;
    margin: 1.35rem 0;
    background: linear-gradient(90deg, transparent, #4f3d24 8% 92%, transparent);
}
.text-link {
    align-self: flex-start;
    margin-top: 1.1rem;
    color: var(--moss);
    font-family: var(--display);
    font-size: .78rem;
    letter-spacing: .08em;
    text-decoration: none;
    border-bottom: 1px solid currentColor;
}
.text-link:hover,
.text-link:focus-visible { color: #2f4d3f; }
.text-link--brass { color: var(--brass-light); }
.text-link--brass:hover,
.text-link--brass:focus-visible { color: var(--paper-light); }

.section {
    width: min(100% - 2rem, 74rem);
    margin: 0 auto;
    padding: clamp(3.5rem, 8vw, 6.5rem) 0;
}
.section-heading {
    max-width: 42rem;
    margin-bottom: 2.25rem;
}
.section-heading h2,
.maker-copy h2,
.contact-block h2 {
    font-size: clamp(2rem, 4.5vw, 3.6rem);
    color: var(--paper-light);
}
.section-heading > p:last-child,
.lead {
    margin-top: .9rem;
    color: var(--muted-strong);
    max-width: var(--measure);
    font-size: 1.05rem;
}

.blueprint {
    display: grid;
    grid-template-columns: 1.15fr .85fr;
    overflow: hidden;
    border: 1px solid rgba(110, 148, 138, .45);
    background:
        linear-gradient(rgba(179,220,208,.05) 1px, transparent 1px),
        linear-gradient(90deg, rgba(179,220,208,.05) 1px, transparent 1px),
        var(--blueprint);
    background-size: 24px 24px;
    box-shadow: var(--shadow), inset 0 0 70px rgba(0,0,0,.28);
}
.blueprint__diagram {
    position: relative;
    padding: clamp(1.4rem, 3vw, 2.4rem);
    border-right: 1px solid rgba(166, 208, 197, .22);
    min-width: 0;
}
.blueprint__content {
    padding: clamp(1.6rem, 4vw, 2.8rem);
    display: flex;
    flex-direction: column;
    justify-content: center;
    min-width: 0;
}
.blueprint__content h3 {
    font-size: clamp(2rem, 3.8vw, 3.4rem);
    color: var(--paper-light);
}
.blueprint__content .body {
    margin: 1rem 0 1.35rem;
    color: var(--blueprint-ink);
    font-size: 1.05rem;
}
.problem-response {
    display: grid;
    gap: .85rem;
    margin: 0 0 1.35rem;
}
.problem-response div {
    padding: .85rem 0 0;
    border-top: 1px solid rgba(189, 208, 202, .18);
}
.problem-response dt {
    margin: 0 0 .25rem;
    color: var(--brass-light);
    font-family: var(--display);
    font-size: .68rem;
    letter-spacing: .12em;
    text-transform: uppercase;
}
.problem-response dd {
    margin: 0;
    color: var(--blueprint-ink);
    font-size: .98rem;
}
.artifact-number {
    color: var(--brass-light);
    font-family: var(--mono);
    font-size: .74rem;
    letter-spacing: .1em;
}
.spec-list { margin: 0 0 1.25rem; }
.spec-list div {
    display: grid;
    grid-template-columns: 6.5rem 1fr;
    gap: .75rem;
    padding: .7rem 0;
    border-top: 1px solid rgba(189, 208, 202, .16);
}
.spec-list dt {
    color: var(--blueprint-muted);
    font-family: var(--display);
    font-size: .66rem;
    letter-spacing: .1em;
    text-transform: uppercase;
}
.spec-list dd {
    margin: 0;
    color: var(--blueprint-ink);
    font-size: .95rem;
}

.flow {
    display: flex;
    flex-direction: column;
    gap: 0;
    margin: 0;
    padding: 0;
    list-style: none;
    counter-reset: flow-step;
}
.flow__item {
    display: flex;
    flex-direction: column;
    gap: .35rem;
}
.flow__node {
    appearance: none;
    display: block;
    width: 100%;
    text-align: left;
    padding: .75rem .9rem;
    border: 1px solid rgba(179, 220, 208, .28);
    background: rgba(8, 24, 22, .45);
    color: var(--blueprint-ink);
    cursor: pointer;
    font: inherit;
    transition: border-color .2s ease, background .2s ease, box-shadow .2s ease;
}
.flow__node:hover,
.flow__node:focus-visible,
.flow__node.is-active {
    border-color: rgba(210, 173, 98, .7);
    background: rgba(20, 48, 43, .75);
    box-shadow: inset 0 0 0 1px rgba(210, 173, 98, .18);
}
.flow__node strong {
    display: block;
    font-family: var(--display);
    font-size: .84rem;
    letter-spacing: .04em;
    margin-bottom: .15rem;
}
.flow__node small {
    display: block;
    color: var(--blueprint-muted);
    font-size: .82rem;
}
.flow__arrow {
    color: var(--blueprint-muted);
    font-family: var(--mono);
    font-size: .7rem;
    letter-spacing: .06em;
    text-transform: uppercase;
    padding: .15rem 0 .15rem .15rem;
}

.margin-tech {
    margin-top: 1.25rem;
    padding-top: 1rem;
    border-top: 1px dashed rgba(166, 208, 197, .28);
}
.margin-tech summary {
    cursor: pointer;
    color: var(--brass-light);
    font-family: var(--display);
    font-size: .7rem;
    letter-spacing: .12em;
    text-transform: uppercase;
    list-style: none;
}
.margin-tech summary::-webkit-details-marker { display: none; }
.margin-tech ul {
    margin: .85rem 0 0;
    padding: 0;
    list-style: none;
    display: grid;
    gap: .4rem;
}
.margin-tech li {
    position: relative;
    padding-left: .95rem;
    color: var(--blueprint-muted);
    font-size: .88rem;
}
.margin-tech li::before {
    content: "";
    position: absolute;
    left: 0;
    top: .55rem;
    width: .35rem;
    height: 1px;
    background: var(--brass);
}

.field-proofs {
    margin-top: 2rem;
    display: grid;
    gap: 1.25rem;
}
.field-proofs > .kicker-row {
    display: flex;
    flex-wrap: wrap;
    align-items: baseline;
    justify-content: space-between;
    gap: .75rem;
}
.field-proofs h3 {
    font-size: clamp(1.45rem, 3vw, 2rem);
    color: var(--paper-light);
}
.folio-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1.15rem;
}
.folio {
    position: relative;
    padding: 1.5rem 1.45rem 1.6rem;
    border: 1px solid var(--line);
    background:
        linear-gradient(145deg, rgba(255,255,255,.03), transparent 40%),
        linear-gradient(160deg, #211a14, #14110e);
    box-shadow: 0 16px 40px rgba(0,0,0,.28);
    min-width: 0;
}
.folio__meta {
    display: flex;
    flex-wrap: wrap;
    gap: .55rem .9rem;
    margin-bottom: 1rem;
    color: var(--muted);
    font-size: .72rem;
    letter-spacing: .08em;
    text-transform: uppercase;
    font-family: var(--display);
}
.folio h4 {
    font-size: clamp(1.35rem, 2.5vw, 1.7rem);
    margin-bottom: .55rem;
}
.folio > p {
    color: var(--muted-strong);
    max-width: 36rem;
}
.folio ul {
    margin: 1rem 0 1.25rem;
    padding: 0;
    list-style: none;
    display: grid;
    gap: .45rem;
}
.folio li {
    position: relative;
    padding-left: 1rem;
    color: var(--ivory);
    font-size: .98rem;
}
.folio li::before {
    content: "";
    position: absolute;
    left: 0;
    top: .7rem;
    width: .45rem;
    height: 1px;
    background: var(--brass);
}
.folio__links {
    display: flex;
    flex-wrap: wrap;
    gap: .85rem 1.25rem;
}

.mechanism {
    border: 1px solid var(--line);
    background:
        linear-gradient(180deg, rgba(255,255,255,.02), transparent 28%),
        linear-gradient(160deg, #1c1611, #12100d);
    box-shadow: var(--shadow);
    padding: clamp(1.4rem, 3vw, 2.2rem);
}
.mechanism__intro {
    display: grid;
    gap: 1.25rem;
    margin-bottom: 1.75rem;
}
.mechanism__intro h3 {
    font-size: clamp(2rem, 3.8vw, 3.2rem);
    color: var(--paper-light);
}
.mechanism__intro .body {
    color: var(--muted-strong);
    max-width: 42rem;
    font-size: 1.05rem;
}
.highlight-list {
    margin: 1rem 0 0;
    padding: 0;
    list-style: none;
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: .55rem .9rem;
}
.highlight-list li {
    position: relative;
    padding-left: .95rem;
    color: var(--ivory);
    font-size: .95rem;
}
.highlight-list li::before {
    content: "";
    position: absolute;
    left: 0;
    top: .7rem;
    width: .4rem;
    height: 1px;
    background: var(--brass);
}

.sequence {
    display: grid;
    grid-template-columns: repeat(7, minmax(0, 1fr));
    gap: .55rem;
    margin: 0;
    padding: 0;
    list-style: none;
}
.sequence li {
    position: relative;
    min-width: 0;
    padding: .85rem .7rem;
    border: 1px solid rgba(201, 164, 91, .22);
    background: rgba(0, 0, 0, .18);
}
.sequence strong {
    display: block;
    font-family: var(--display);
    font-size: .78rem;
    letter-spacing: .03em;
    line-height: 1.3;
    margin-bottom: .35rem;
    color: var(--paper-light);
}
.sequence small {
    display: block;
    color: var(--muted);
    font-size: .8rem;
    line-height: 1.35;
}
.sequence li:not(:last-child)::after {
    content: "→";
    position: absolute;
    right: -.4rem;
    top: 50%;
    translate: 50% -50%;
    z-index: 1;
    color: var(--brass);
    font-size: .75rem;
    background: var(--night);
    padding: .1rem;
}

.arcana-sequence {
    grid-template-columns: repeat(4, minmax(0, 1fr));
}
.arcana-sequence li:nth-child(4)::after { display: none; }
.arcana-features {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: .65rem;
    margin: 1.5rem 0 0;
    padding: 0;
    list-style: none;
}
.arcana-features li {
    padding: .7rem .8rem;
    border: 1px solid rgba(201, 164, 91, .18);
    color: var(--muted-strong);
    font-size: .9rem;
}

.method-ledger {
    display: grid;
    gap: 1rem;
}
.method-entry {
    display: grid;
    grid-template-columns: 3.5rem 1fr;
    gap: 1rem 1.25rem;
    padding: 1.35rem 0;
    border-top: 1px solid var(--line);
}
.method-entry:last-child { border-bottom: 1px solid var(--line); }
.method-entry__mark {
    font-family: var(--mono);
    color: var(--brass-light);
    font-size: .85rem;
    letter-spacing: .08em;
    padding-top: .2rem;
}
.method-entry h3 {
    font-size: clamp(1.3rem, 2.4vw, 1.7rem);
    margin-bottom: .45rem;
}
.method-entry > p {
    color: var(--muted-strong);
    max-width: 40rem;
}
.method-ties {
    margin: 1rem 0 0;
    padding: 0;
    list-style: none;
    display: grid;
    gap: .55rem;
}
.method-ties li {
    display: grid;
    grid-template-columns: 7rem 1fr;
    gap: .75rem;
    font-size: .95rem;
}
.method-ties strong {
    font-family: var(--display);
    font-size: .72rem;
    letter-spacing: .08em;
    text-transform: uppercase;
    color: var(--brass-light);
    font-weight: 600;
}
.method-ties span { color: var(--ivory); }

.materials-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1.15rem;
}
.material-group {
    padding: 1.35rem 1.3rem 1.45rem;
    border: 1px solid var(--line);
    background: linear-gradient(160deg, #1d1712, #13100d);
}
.material-group h3 {
    font-size: 1.25rem;
    margin-bottom: .9rem;
    color: var(--paper-light);
}
.material-group ul {
    margin: 0;
    padding: 0;
    list-style: none;
    display: grid;
    gap: .45rem;
}
.material-group li {
    color: var(--muted-strong);
    font-size: .98rem;
    padding-left: .9rem;
    position: relative;
}
.material-group li::before {
    content: "";
    position: absolute;
    left: 0;
    top: .7rem;
    width: .4rem;
    height: 1px;
    background: var(--brass);
}

.maker-section {
    display: grid;
    grid-template-columns: 12.5rem minmax(0, 1fr);
    gap: clamp(1.5rem, 4vw, 3rem);
    align-items: start;
}
.maker-portrait {
    position: relative;
    width: 12.5rem;
    max-width: 100%;
    overflow: hidden;
    aspect-ratio: 4 / 5;
    border: 1px solid var(--line);
    border-radius: .75rem;
    background: linear-gradient(145deg, #221b15, #12100e);
    box-shadow: 0 16px 36px rgba(0, 0, 0, .42), 0 0 0 1px rgba(210, 173, 98, .08);
}
.maker-portrait::before {
    content: "";
    position: absolute;
    inset: .5rem;
    z-index: 1;
    border: 1px solid rgba(210, 173, 98, .18);
    border-radius: .5rem;
    pointer-events: none;
}
.maker-portrait img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: 78% 18%;
}
.maker-copy { min-width: 0; }
.maker-copy p:not(.kicker) {
    color: var(--muted-strong);
    max-width: 40rem;
    font-size: 1.05rem;
}
.signature {
    margin-top: 1.6rem;
    color: var(--brass-light);
    font-family: var(--serif);
    font-size: 1.85rem;
    font-style: italic;
    transform: rotate(-3deg);
    transform-origin: left;
}

.contact-block {
    border-top: 1px solid var(--line);
    padding-top: 2.5rem;
}
.contact-block .lead { margin-bottom: 1.5rem; }
.contact-actions {
    display: flex;
    flex-wrap: wrap;
    gap: .85rem 1.4rem;
    margin: 0;
    padding: 0;
    list-style: none;
}
.contact-actions a,
.contact-actions button {
    display: inline-flex;
    align-items: center;
    gap: .55rem;
    color: var(--muted-strong);
    text-decoration: none;
    font-family: var(--serif);
    font-size: 1.1rem;
    background: none;
    border: 0;
    border-bottom: 1px solid transparent;
    padding: 0;
    cursor: pointer;
    transition: color .2s ease, border-color .2s ease;
}
.contact-actions a:hover,
.contact-actions a:focus-visible,
.contact-actions button:hover,
.contact-actions button:focus-visible {
    color: var(--brass-light);
    border-bottom-color: currentColor;
}
.copy-status {
    margin: .85rem 0 0;
    min-height: 1.25em;
    color: var(--brass-light);
    font-family: var(--serif);
    font-style: italic;
    font-size: 1rem;
}

.site-footer {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    gap: .85rem 1.25rem;
    width: min(100% - 2rem, 74rem);
    margin: 0 auto;
    padding: 1.6rem 0 2.4rem;
    border-top: 1px solid var(--line);
    color: var(--muted);
    font-size: .74rem;
    letter-spacing: .08em;
    text-transform: uppercase;
}
.site-footer a,
.showdown-link {
    appearance: none;
    margin: 0;
    padding: 0;
    border: 0;
    border-bottom: 1px solid currentColor;
    background: none;
    color: var(--brass);
    font: inherit;
    font-family: var(--display);
    letter-spacing: .12em;
    text-transform: uppercase;
    text-decoration: none;
    cursor: pointer;
    transition: color .2s ease;
}
.site-footer a:hover,
.site-footer a:focus-visible,
.showdown-link:hover,
.showdown-link:focus-visible {
    color: var(--brass-light);
}

.showdown-modal {
    position: fixed;
    inset: 0;
    z-index: 80;
    display: grid;
    place-items: center;
    padding: 1.25rem;
}
.showdown-modal[hidden] { display: none; }
.showdown-modal__backdrop {
    position: absolute;
    inset: 0;
    background: rgba(8, 7, 5, .78);
    backdrop-filter: blur(6px);
}
.showdown-modal__panel {
    position: relative;
    z-index: 1;
    width: min(100%, 32rem);
    padding: clamp(1.6rem, 4vw, 2.4rem);
    border: 1px solid var(--line);
    border-radius: .35rem;
    background:
        linear-gradient(160deg, rgba(238, 225, 189, .08), transparent 42%),
        linear-gradient(180deg, #1d1711 0%, #13100d 100%);
    box-shadow: var(--shadow);
    color: var(--ivory);
}
.showdown-modal__panel .kicker {
    margin-bottom: .55rem;
    color: var(--brass);
}
.showdown-modal__panel h2 {
    margin-bottom: 1rem;
    font-size: clamp(1.35rem, 3vw, 1.7rem);
    color: var(--paper-light);
}
.showdown-modal__riddle {
    margin-bottom: 1.4rem;
    color: var(--muted-strong);
    font-family: var(--serif);
    font-size: 1.18rem;
    line-height: 1.65;
}
.showdown-modal__close {
    position: absolute;
    top: .7rem;
    right: .85rem;
    appearance: none;
    border: 0;
    background: none;
    color: var(--muted);
    font-size: 1.5rem;
    line-height: 1;
    cursor: pointer;
}
.showdown-modal__close:hover,
.showdown-modal__close:focus-visible {
    color: var(--brass-light);
}
.showdown-modal__form { display: grid; gap: .65rem; }
.showdown-modal__label {
    font-family: var(--display);
    font-size: .72rem;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--brass);
}
.showdown-modal__input {
    width: 100%;
    padding: .85rem 1rem;
    border: 1px solid rgba(201, 164, 91, .35);
    border-radius: .25rem;
    background: rgba(0, 0, 0, .28);
    color: var(--ivory);
    font-family: var(--serif);
    font-size: 1.1rem;
}
.showdown-modal__input:focus {
    outline: 2px solid var(--brass-light);
    border-color: var(--brass-light);
}
.showdown-modal__submit {
    appearance: none;
    justify-self: start;
    margin-top: .35rem;
    padding: .75rem 1.15rem;
    border: 1px solid var(--line);
    border-radius: .25rem;
    background: linear-gradient(180deg, rgba(174, 133, 64, .22), rgba(174, 133, 64, .08));
    color: var(--brass-light);
    font-family: var(--display);
    font-size: .72rem;
    letter-spacing: .1em;
    text-transform: uppercase;
    cursor: pointer;
}
.showdown-modal__submit:hover,
.showdown-modal__submit:focus-visible {
    border-color: var(--brass-light);
    color: var(--paper-light);
}
.showdown-modal__submit:disabled {
    opacity: .6;
    cursor: wait;
}
.showdown-modal__feedback {
    min-height: 1.4em;
    margin: .2rem 0 0;
    color: var(--paper);
    font-family: var(--serif);
    font-size: 1rem;
    font-style: italic;
}

[data-reveal] {
    opacity: 0;
    translate: 0 1rem;
    transition: opacity .75s ease, translate .75s ease;
}
[data-reveal].is-visible {
    opacity: 1;
    translate: 0 0;
}

@keyframes candle {
    from { opacity: .7; scale: .97; }
    to { opacity: 1; scale: 1.03; }
}
@keyframes drift {
    to { background-position: 100px 180px, -80px 240px; }
}

@media (max-width: 1024px) {
    .sequence {
        grid-template-columns: repeat(4, minmax(0, 1fr));
    }
    .sequence li:nth-child(4)::after { display: none; }
    .arcana-sequence {
        grid-template-columns: repeat(4, minmax(0, 1fr));
    }
    .arcana-features {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 900px) {
    .nav-toggle { display: grid; place-items: center; }
    #site-nav {
        position: absolute;
        top: calc(100% - 1px);
        right: 1rem;
        left: 1rem;
        display: flex;
        flex-direction: column;
        align-items: stretch;
        gap: 0;
        padding: .4rem 0;
        border: 1px solid var(--line);
        background: rgba(13, 12, 10, .96);
        backdrop-filter: blur(16px);
        box-shadow: 0 18px 40px rgba(0, 0, 0, .45);
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        translate: 0 -.35rem;
        transition: opacity .25s ease, translate .25s ease, visibility .25s ease;
    }
    .site-header.is-nav-open {
        background: rgba(13, 12, 10, .96);
        border-color: var(--line);
        backdrop-filter: blur(16px);
    }
    .site-header.is-nav-open #site-nav {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
        translate: 0 0;
    }
    #site-nav a {
        padding: 1rem 1.15rem;
        border-top: 1px solid rgba(201, 164, 91, .14);
        min-height: 2.75rem;
    }
    #site-nav a:first-child { border-top: 0; }

    .journal {
        grid-template-columns: 1fr;
        width: min(100%, 38rem);
        transform: none;
    }
    .journal::after { display: none; }
    .journal-page--left { border-radius: .4rem .4rem 0 0; }
    .journal-page--right { border-radius: 0 0 .4rem .4rem; }
    .journal-sigil { width: 8.5rem; }

    .blueprint { grid-template-columns: 1fr; }
    .blueprint__diagram {
        border-right: 0;
        border-bottom: 1px solid rgba(166, 208, 197, .22);
    }

    .folio-grid,
    .materials-grid,
    .highlight-list {
        grid-template-columns: 1fr;
    }

    .maker-section {
        grid-template-columns: 1fr;
        justify-items: start;
    }
    .maker-portrait {
        width: 10.5rem;
        max-width: 42vw;
    }

    .sequence,
    .arcana-sequence {
        grid-template-columns: 1fr;
    }
    .sequence li:not(:last-child)::after,
    .arcana-sequence li:nth-child(4)::after {
        content: "↓";
        right: auto;
        left: 1rem;
        top: auto;
        bottom: -.55rem;
        translate: 0 50%;
    }
}

@media (max-width: 620px) {
    .site-header { padding: .8rem 1rem; }
    .maker-mark small { display: none; }
    .hero { padding-inline: .75rem; }
    .journal-page { padding: 1.5rem 1.25rem; }
    .journal h1 { font-size: clamp(2.3rem, 12vw, 3.4rem); }
    .section { width: min(100% - 1.25rem, 74rem); padding: 3rem 0; }
    .spec-list div,
    .method-ties li {
        grid-template-columns: 1fr;
        gap: .25rem;
    }
    .method-entry {
        grid-template-columns: 1fr;
        gap: .35rem;
    }
    .maker-portrait {
        width: 9rem;
        max-width: 38vw;
    }
    .arcana-features { grid-template-columns: 1fr; }
    .site-footer {
        width: calc(100% - 1.25rem);
        flex-direction: column;
        align-items: flex-start;
    }
    .workbench { display: none; }
}

@media (prefers-reduced-motion: reduce) {
    html { scroll-behavior: auto; }
    *, *::before, *::after {
        animation-duration: .01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: .01ms !important;
    }
    [data-reveal] {
        opacity: 1;
        translate: none;
    }
}
    </style>
</head>
<body>
    <a class="skip-link" href="#main">Skip to content</a>
    <div class="ambient-light" aria-hidden="true"></div>
    <div class="dust" aria-hidden="true"></div>

    <header class="site-header">
        <a class="maker-mark" href="#top" aria-label="Iain Reid — return to top">
            <span class="maker-mark__sigil" aria-hidden="true"><span>IR</span></span>
            <span>
                <strong>Iain Reid</strong>
                <small>Independent Product Developer</small>
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
        <nav id="site-nav" aria-label="Primary">
            <a href="#work">Work</a>
            <a href="#method">Method</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
            <a href="<?= e($links['github']) ?>" rel="noopener noreferrer">GitHub</a>
        </nav>
    </header>

    <main id="main">
        <section class="hero" id="top" aria-labelledby="hero-heading">
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
                    <p class="margin-note">Three systems. One concern: making powerful tools understandable enough to use, operate, and continue building.</p>
                    <ul class="journal-index" aria-label="Workshop index">
                        <?php foreach ($journalIndex as $entry): ?>
                            <li>
                                <span class="mark"><?= e($entry['mark']) ?></span>
                                <span>
                                    <strong><?= e($entry['title']) ?></strong>
                                    <span><?= e($entry['line']) ?></span>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </article>

                <article class="journal-page journal-page--right">
                    <p class="kicker">The Workshop Journal of</p>
                    <h1 id="hero-heading">Iain Reid</h1>
                    <p class="hero-copy">I build systems that make complex software and AI-assisted work understandable.</p>
                    <div class="ink-rule"></div>
                    <p class="hero-note">Repository understanding, guided AI workflows, production creative systems, practical deployment, and maintainable software—recorded as working mechanisms rather than demos.</p>
                    <a class="text-link" href="#work">Open the workbench <span aria-hidden="true">↓</span></a>
                </article>
            </div>
        </section>

        <section class="section" id="work" aria-labelledby="work-heading">
            <div class="section-heading" data-reveal>
                <p class="kicker"><?= e($projects[0]['entry']) ?> · <?= e($projects[0]['label']) ?></p>
                <h2 id="work-heading">VibeKB</h2>
                <p>The current masterwork on the bench: a system for understanding software before the next change.</p>
            </div>

            <article class="blueprint" data-reveal aria-labelledby="vibekb-title">
                <div class="blueprint__diagram">
                    <p class="kicker" style="color: var(--brass-light);">Technical folio · understanding flow</p>
                    <ol class="flow" id="vibekb-flow" aria-label="VibeKB understanding flow">
                        <?php
                        $flowConnectors = [
                            1 => 'analyzed into',
                            2 => 'organized with',
                            3 => 'rendered through',
                            4 => 'published as',
                        ];
                        foreach ($vibekbFlow as $i => $node):
                        ?>
                            <li class="flow__item">
                                <button
                                    type="button"
                                    class="flow__node<?= $i === 0 ? ' is-active' : '' ?>"
                                    data-flow-node="<?= e($node['id']) ?>"
                                    aria-pressed="<?= $i === 0 ? 'true' : 'false' ?>">
                                    <strong><?= e($node['label']) ?></strong>
                                    <small><?= e($node['note']) ?></small>
                                </button>
                                <?php if (isset($flowConnectors[$i + 1])): ?>
                                    <div class="flow__arrow" aria-hidden="true">↓ <?= e($flowConnectors[$i + 1]) ?></div>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ol>
                    <details class="margin-tech">
                        <summary>Blueprint margin notes</summary>
                        <ul>
                            <?php foreach ($vibekbNotes as $note): ?>
                                <li><?= e($note) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </details>
                </div>

                <div class="blueprint__content">
                    <span class="artifact-number">Artifact <?= e($projects[0]['mark']) ?></span>
                    <p class="kicker">Repository understanding</p>
                    <h3 id="vibekb-title">VibeKB</h3>
                    <p class="body"><?= e($projects[0]['summary']) ?></p>
                    <dl class="problem-response">
                        <div>
                            <dt>The core problem</dt>
                            <dd>AI-assisted development makes software faster to create but harder to understand later.</dd>
                        </div>
                        <div>
                            <dt>The system response</dt>
                            <dd>VibeKB creates a repository-owned, source-grounded model before the next developer or agent changes anything.</dd>
                        </div>
                    </dl>
                    <dl class="spec-list">
                        <div><dt>Status</dt><dd><?= e($projects[0]['status']) ?></dd></div>
                        <div><dt>Concern</dt><dd>Make complex software understandable, structured, and usable.</dd></div>
                        <div><dt>Output</dt><dd>Static understanding site with commit-pinned source links.</dd></div>
                    </dl>
                    <a class="text-link text-link--brass" href="<?= e($links['vibekb_repo']) ?>" rel="noopener noreferrer">
                        Open the VibeKB repository <span aria-hidden="true">→</span>
                    </a>
                </div>
            </article>

            <div class="field-proofs" data-reveal>
                <div class="kicker-row">
                    <div>
                        <p class="kicker">Applied studies</p>
                        <h3>Field proofs</h3>
                    </div>
                    <p class="lead" style="margin:0; max-width:28rem;">VibeKB applied to real repositories—annotated specimens, not interchangeable archive cards.</p>
                </div>

                <div class="folio-grid">
                    <?php foreach ($fieldProofs as $proof): ?>
                        <article class="folio">
                            <div class="folio__meta">
                                <span><?= e($proof['specimen']) ?></span>
                                <span>Field record</span>
                            </div>
                            <h4><?= e($proof['title']) ?></h4>
                            <p><?= e($proof['context']) ?></p>
                            <ul>
                                <?php foreach ($proof['findings'] as $finding): ?>
                                    <li><?= e($finding) ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <div class="folio__links">
                                <a class="text-link text-link--brass" href="<?= e($proof['repo']) ?>" rel="noopener noreferrer">Repository <span aria-hidden="true">→</span></a>
                                <a class="text-link text-link--brass" href="<?= e($proof['understanding']) ?>" rel="noopener noreferrer">Understanding site <span aria-hidden="true">→</span></a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="section" id="sousmeow" aria-labelledby="sousmeow-heading">
            <div class="section-heading" data-reveal>
                <p class="kicker"><?= e($projects[1]['entry']) ?> · <?= e($projects[1]['label']) ?></p>
                <h2 id="sousmeow-heading">SousMeow</h2>
                <p>Guided machinery for finishing substantial work with the AI tools people already pay for.</p>
            </div>

            <article class="mechanism" data-reveal>
                <div class="mechanism__intro">
                    <div>
                        <span class="artifact-number">Artifact <?= e($projects[1]['mark']) ?></span>
                        <h3>Not a prompt library</h3>
                        <p class="body"><?= e($projects[1]['summary']) ?> It is closer to sitting beside someone who is good at AI and being guided through the complete task.</p>
                        <ul class="highlight-list">
                            <li>Cookbooks contain complete workflows.</li>
                            <li>Recipes are sequential steps.</li>
                            <li>Pantry context persists across the run.</li>
                            <li>Artifacts retain versions.</li>
                            <li>Every step has success criteria and failure signals.</li>
                            <li>Works with free or paid AI subscriptions.</li>
                            <li>The core loop avoids required API metering.</li>
                            <li>Results can be exported as a project kit.</li>
                        </ul>
                        <p style="margin-top:1.25rem;">
                            <a class="text-link text-link--brass" href="<?= e($links['sousmeow']) ?>" rel="noopener noreferrer">
                                Open SousMeow <span aria-hidden="true">→</span>
                            </a>
                        </p>
                    </div>
                </div>

                <ol class="sequence" aria-label="SousMeow guided workflow">
                    <?php foreach ($sousmeowFlow as $step): ?>
                        <li>
                            <strong><?= e($step['label']) ?></strong>
                            <small><?= e($step['hint']) ?></small>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </article>
        </section>

        <section class="section" id="arcana" aria-labelledby="arcana-heading">
            <div class="section-heading" data-reveal>
                <p class="kicker"><?= e($projects[2]['entry']) ?> · <?= e($projects[2]['label']) ?></p>
                <h2 id="arcana-heading">Arcana / You Are The Song Now</h2>
                <p>A complete production engine that turns song, identity, and style into a cinematic visual.</p>
            </div>

            <article class="mechanism" data-reveal>
                <div class="mechanism__intro">
                    <div>
                        <span class="artifact-number">Artifact <?= e($projects[2]['mark']) ?></span>
                        <h3>Production creative system</h3>
                        <p class="body"><?= e($projects[2]['summary']) ?> Built as an operable product—not a single prompt demo—with accounts, credits, queues, storage, and shared-hosting deployment in mind.</p>
                        <ul class="arcana-features" aria-label="Production capabilities">
                            <li>Gemini song analysis</li>
                            <li>Structured Song DNA</li>
                            <li>Prompt construction</li>
                            <li>Image generation</li>
                            <li>Style selection</li>
                            <li>Dynamic band-style analysis</li>
                            <li>Portrait references</li>
                            <li>Multiple aspect ratios</li>
                            <li>Queue processing</li>
                            <li>Parallel cron workers</li>
                            <li>Fallback paths</li>
                            <li>Accounts &amp; email verification</li>
                            <li>Credits &amp; plan gating</li>
                            <li>Stripe (integration present)</li>
                            <li>Render storage &amp; gallery</li>
                            <li>Watermarks</li>
                            <li>Admin &amp; maintenance controls</li>
                            <li>Shared-hosting deployment</li>
                        </ul>
                        <p class="lead" style="margin-top:1.1rem; font-size:.95rem;">
                            Commercial integrations are part of the production surface; verification depth varies by path.
                        </p>
                        <div class="folio__links" style="margin-top:1rem;">
                            <a class="text-link text-link--brass" href="<?= e($links['arcana_repo']) ?>" rel="noopener noreferrer">Repository <span aria-hidden="true">→</span></a>
                            <a class="text-link text-link--brass" href="<?= e($links['arcana_product']) ?>" rel="noopener noreferrer">Product <span aria-hidden="true">→</span></a>
                            <a class="text-link text-link--brass" href="<?= e($links['arcana_understanding']) ?>" rel="noopener noreferrer">Understanding site <span aria-hidden="true">→</span></a>
                        </div>
                    </div>
                </div>

                <ol class="sequence arcana-sequence" aria-label="Arcana production flow">
                    <?php foreach ($arcanaFlow as $step): ?>
                        <li>
                            <strong><?= e($step['label']) ?></strong>
                            <small><?= e($step['hint']) ?></small>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </article>
        </section>

        <section class="section" id="method" aria-labelledby="method-heading">
            <div class="section-heading" data-reveal>
                <p class="kicker">Maker’s ledger</p>
                <h2 id="method-heading">How the work gets built</h2>
                <p>Four principles that connect VibeKB, SousMeow, and Arcana.</p>
            </div>

            <div class="method-ledger" data-reveal>
                <?php foreach ($methodEntries as $entry): ?>
                    <article class="method-entry">
                        <div class="method-entry__mark"><?= e($entry['mark']) ?></div>
                        <div>
                            <h3><?= e($entry['title']) ?></h3>
                            <p><?= e($entry['body']) ?></p>
                            <ul class="method-ties">
                                <?php foreach ($entry['ties'] as $name => $tie): ?>
                                    <li>
                                        <strong><?= e($name) ?></strong>
                                        <span><?= e($tie) ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="section" id="materials" aria-labelledby="materials-heading">
            <div class="section-heading" data-reveal>
                <p class="kicker">Workshop materials</p>
                <h2 id="materials-heading">Capabilities by outcome</h2>
                <p>Grouped by what the work produces—not a wall of logos.</p>
            </div>

            <div class="materials-grid" data-reveal>
                <?php foreach ($capabilityGroups as $group): ?>
                    <section class="material-group" aria-labelledby="cap-<?= e(strtolower(str_replace(' ', '-', $group['title']))) ?>">
                        <h3 id="cap-<?= e(strtolower(str_replace(' ', '-', $group['title']))) ?>"><?= e($group['title']) ?></h3>
                        <ul>
                            <?php foreach ($group['items'] as $item): ?>
                                <li><?= e($item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </section>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="section maker-section" id="about" aria-labelledby="about-heading" data-reveal>
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
                <h2 id="about-heading">Software as craftsmanship</h2>
                <p>Iain has prior software-development experience. Modern AI tools changed the speed at which complete systems can be built. The harder problem is keeping those systems understandable and usable.</p>
                <p>His work focuses on turning ideas into systems that can be operated and continued—repository understanding, guided workflows, and production engines shaped for the environments they actually ship into.</p>
                <div class="signature">Iain Reid</div>
            </div>
        </section>

        <section class="section" id="contact" aria-labelledby="contact-heading">
            <div class="contact-block" data-reveal>
                <p class="kicker">Workshop invitation</p>
                <h2 id="contact-heading">Bring me the complicated part.</h2>
                <p class="lead">I’m interested in practical software products, repository understanding, guided AI workflows, and systems that need to become clearer before they can grow.</p>
                <ul class="contact-actions">
                    <li>
                        <a href="<?= e($links['mailto']) ?>"><?= e($links['email']) ?></a>
                    </li>
                    <li>
                        <button type="button" data-copy-email="<?= e($links['email']) ?>">Copy email</button>
                    </li>
                    <li>
                        <a href="<?= e($links['github']) ?>" rel="noopener noreferrer">GitHub profile</a>
                    </li>
                    <li>
                        <a href="<?= e($links['x']) ?>" rel="noopener noreferrer"><?= e($links['x_handle']) ?></a>
                    </li>
                </ul>
                <p class="copy-status" id="copy-status" role="status" aria-live="polite"></p>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <span>iainreid.dev</span>
        <button class="showdown-link" type="button" data-showdown-open>Showdown</button>
        <span>
            <a href="<?= e($links['github']) ?>" rel="noopener noreferrer">GitHub</a>
            ·
            <a href="<?= e($links['x']) ?>" rel="noopener noreferrer"><?= e($links['x_handle']) ?></a>
            ·
            <a href="<?= e($links['mailto']) ?>">Email</a>
            ·
            Workshop record · <?= e((string) $year) ?>
        </span>
    </footer>

    <div class="showdown-modal" id="showdown-modal" hidden>
        <div class="showdown-modal__backdrop" data-showdown-close tabindex="-1"></div>
        <div
            class="showdown-modal__panel"
            role="dialog"
            aria-modal="true"
            aria-labelledby="showdown-title"
            aria-describedby="showdown-riddle">
            <button class="showdown-modal__close" type="button" data-showdown-close aria-label="Close">×</button>
            <p class="kicker">Sealed folio · Showdown</p>
            <h2 id="showdown-title">A riddle from the workshop</h2>
            <p id="showdown-riddle" class="showdown-modal__riddle">
                one wrong move and the entire process focuses on this:
            </p>
            <form class="showdown-modal__form" id="showdown-form" novalidate>
                <label class="showdown-modal__label" for="showdown-answer">Your answer</label>
                <input
                    class="showdown-modal__input"
                    id="showdown-answer"
                    name="answer"
                    type="text"
                    autocomplete="off"
                    spellcheck="false"
                    maxlength="64"
                    required>
                <button class="showdown-modal__submit" type="submit">Unseal the gate</button>
                <p class="showdown-modal__feedback" id="showdown-feedback" role="status" aria-live="polite"></p>
            </form>
        </div>
    </div>

    <script>
(() => {
    'use strict';

    const header = document.querySelector('.site-header');
    const toggle = document.querySelector('.nav-toggle');
    const nav = document.querySelector('#site-nav');
    const revealItems = document.querySelectorAll('[data-reveal]');
    const desktopQuery = window.matchMedia('(min-width: 901px)');
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

    const updateHeader = () => {
        if (!header) return;
        header.classList.toggle('is-scrolled', window.scrollY > 24);
    };

    const setNavOpen = (open) => {
        if (!header || !toggle) return;
        header.classList.toggle('is-nav-open', open);
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        toggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
    };

    const closeNav = () => setNavOpen(false);

    updateHeader();
    window.addEventListener('scroll', updateHeader, { passive: true });

    if (toggle && nav && header) {
        toggle.addEventListener('click', () => {
            setNavOpen(!header.classList.contains('is-nav-open'));
        });

        nav.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', closeNav);
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') closeNav();
        });

        document.addEventListener('click', (event) => {
            if (!header.classList.contains('is-nav-open')) return;
            if (header.contains(event.target)) return;
            closeNav();
        });

        const handleDesktopChange = (event) => {
            if (event.matches) closeNav();
        };

        if (typeof desktopQuery.addEventListener === 'function') {
            desktopQuery.addEventListener('change', handleDesktopChange);
        } else if (typeof desktopQuery.addListener === 'function') {
            desktopQuery.addListener(handleDesktopChange);
        }
    }

    if (reduceMotion.matches || !('IntersectionObserver' in window)) {
        revealItems.forEach((item) => item.classList.add('is-visible'));
    } else {
        const observer = new IntersectionObserver((entries, activeObserver) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('is-visible');
                activeObserver.unobserve(entry.target);
            });
        }, {
            rootMargin: '0px 0px -8% 0px',
            threshold: 0.12,
        });
        revealItems.forEach((item) => observer.observe(item));
    }

    const flowNodes = document.querySelectorAll('[data-flow-node]');
    flowNodes.forEach((node) => {
        node.addEventListener('click', () => {
            flowNodes.forEach((other) => {
                other.classList.toggle('is-active', other === node);
                other.setAttribute('aria-pressed', other === node ? 'true' : 'false');
            });
        });
    });

    const copyButton = document.querySelector('[data-copy-email]');
    const copyStatus = document.querySelector('#copy-status');
    if (copyButton) {
        copyButton.addEventListener('click', async () => {
            const email = copyButton.getAttribute('data-copy-email') || '';
            try {
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    await navigator.clipboard.writeText(email);
                } else {
                    const temp = document.createElement('textarea');
                    temp.value = email;
                    document.body.appendChild(temp);
                    temp.select();
                    document.execCommand('copy');
                    temp.remove();
                }
                if (copyStatus) copyStatus.textContent = 'Email copied.';
            } catch (_error) {
                if (copyStatus) copyStatus.textContent = 'Copy unavailable — use the mailto link.';
            }
        });
    }

    const modal = document.querySelector('#showdown-modal');
    const openTriggers = document.querySelectorAll('[data-showdown-open]');
    const closeTriggers = document.querySelectorAll('[data-showdown-close]');
    const form = document.querySelector('#showdown-form');
    const answerInput = document.querySelector('#showdown-answer');
    const feedback = document.querySelector('#showdown-feedback');
    const submitButton = form ? form.querySelector('button[type="submit"]') : null;
    let lastFocus = null;

    const setFeedback = (message) => {
        if (feedback) feedback.textContent = message;
    };

    const openModal = () => {
        if (!modal) return;
        lastFocus = document.activeElement;
        modal.hidden = false;
        document.body.style.overflow = 'hidden';
        setFeedback('');
        if (answerInput) {
            answerInput.value = '';
            answerInput.focus();
        }
    };

    const closeModal = () => {
        if (!modal || modal.hidden) return;
        modal.hidden = true;
        document.body.style.overflow = '';
        setFeedback('');
        if (lastFocus && typeof lastFocus.focus === 'function') {
            lastFocus.focus();
        }
    };

    openTriggers.forEach((trigger) => {
        trigger.addEventListener('click', openModal);
    });

    closeTriggers.forEach((trigger) => {
        trigger.addEventListener('click', closeModal);
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && modal && !modal.hidden) {
            closeModal();
        }
    });

    if (form && answerInput) {
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            setFeedback('');

            const answer = answerInput.value.trim();
            if (!answer) {
                setFeedback('Soon enough the secrets will be revealed');
                return;
            }

            if (submitButton) submitButton.disabled = true;

            try {
                const response = await fetch('showdown-gate.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ answer }),
                    cache: 'no-store',
                });

                const data = await response.json();

                if (data && data.ok === true && typeof data.redirect === 'string') {
                    window.location.assign(data.redirect);
                    return;
                }

                setFeedback(
                    (data && typeof data.message === 'string' && data.message)
                        || 'Soon enough the secrets will be revealed'
                );
            } catch (_error) {
                setFeedback('Soon enough the secrets will be revealed');
            } finally {
                if (submitButton) submitButton.disabled = false;
            }
        });
    }
})();
    </script>
</body>
</html>
