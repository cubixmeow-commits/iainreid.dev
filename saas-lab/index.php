<?php

declare(strict_types=1);

// Shared SaaS Lab account system: gives this page an auth-state-aware account
// entry point. The bootstrap starts the session and wires the helpers.
// Public idea counts come from the database; private/invite ideas never appear.
require __DIR__ . '/../includes/bootstrap.php';

$publicIdeaCount = count_public_ideas();
$publicIdeaCountLabel = str_pad((string) $publicIdeaCount, 2, '0', STR_PAD_LEFT);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SaaS Lab is Iain Reid's system for testing software ideas before overbuilding them. Focused, deployable experiments that let evidence decide what earns more time.">
    <meta name="theme-color" content="#0d0c0a">
    <meta property="og:title" content="SaaS Lab · Iain Reid">
    <meta property="og:description" content="A system for testing software ideas before overbuilding them.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://iainreid.dev/site/saas-lab/">
    <meta name="twitter:card" content="summary">
    <title>SaaS Lab · Experiment Ledger · Iain Reid</title>
    <link rel="canonical" href="https://iainreid.dev/site/saas-lab/">
    <link rel="stylesheet" href="../assets/css/style.css?v=20260719g">
    <link rel="stylesheet" href="../assets/css/saas-lab.css?v=20260719a">
    <link rel="stylesheet" href="../assets/css/auth.css?v=20260719a">
</head>
<body>
    <div class="ambient-light" aria-hidden="true"></div>
    <div class="dust" aria-hidden="true"></div>
    <div class="ledger-rule" aria-hidden="true"></div>

    <header class="site-header">
        <a class="maker-mark" href="/site/" aria-label="Return to the workshop journal">
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
            <a href="/site/">Workshop</a>
            <a href="/site/saas-lab/" aria-current="page">SaaS Lab</a>
            <a href="#experiments">Experiments</a>
            <a href="#method">Method</a>
            <a href="#principles">Principles</a>
            <span class="lab-account-nav" role="group" aria-label="Lab access">
                <?php if (is_logged_in()): ?>
                    <?php if (is_admin()): ?>
                        <a class="btn btn--ghost" href="<?= e(url('admin/experiments.php')) ?>">Ideas</a>
                        <a class="btn btn--ghost" href="<?= e(url('admin/')) ?>">Admin</a>
                    <?php endif; ?>
                    <a class="btn btn--ghost" href="<?= e(url('auth/account.php')) ?>">Account</a>
                <?php else: ?>
                    <a class="btn btn--ghost" href="<?= e(url('auth/login.php')) ?>">Log in</a>
                    <a class="btn btn--primary" href="<?= e(url('auth/register.php')) ?>">Create account</a>
                <?php endif; ?>
            </span>
        </nav>
    </header>

    <main>
        <!-- Hero -->
        <section class="lab-hero" id="top" aria-labelledby="lab-title">
            <div class="lab-hero__intro" data-reveal>
                <p class="mono">Field ledger · Experiments</p>
                <h1 id="lab-title">SaaS Lab</h1>
                <p class="lab-hero__lede">A system for testing software ideas before overbuilding them.</p>
                <p class="lab-hero__copy">I build focused, deployable experiments. Each one exists to learn whether an idea deserves more time and complexity, using the smallest version that can answer the question in real conditions.</p>
                <div class="lab-hero__meta">
                    <span><b>Public ideas</b> <?= e($publicIdeaCountLabel) ?></span>
                    <span><b>Method</b> problem to evidence</span>
                    <span><b>Bench</b> shared Linux hosting</span>
                </div>
            </div>

            <aside class="board" data-reveal aria-label="Active experiment index">
                <div class="board__head">
                    <span class="board__title">Active bench</span>
                    <span class="board__count">03</span>
                </div>
                <ul class="board__rows">
                    <li class="board__row">
                        <span class="board__id">EXP-01</span>
                        <a class="board__name" href="#exp-sousmeow">SousMeow</a>
                        <span class="signal signal--active">Active prototype</span>
                    </li>
                    <li class="board__row">
                        <span class="board__id">EXP-02</span>
                        <a class="board__name" href="#exp-arcana">Arcana</a>
                        <span class="signal signal--working">Working system</span>
                    </li>
                    <li class="board__row">
                        <span class="board__id">EXP-03</span>
                        <a class="board__name" href="#exp-storyforge">StoryForge</a>
                        <span class="signal signal--dev">In development</span>
                    </li>
                </ul>
                <div class="board__pipe" aria-label="Experiment pipeline">
                    <span>problem</span><i>→</i>
                    <span>loop</span><i>→</i>
                    <span>deploy</span><i>→</i>
                    <span>observe</span><i>→</i>
                    <span>decide</span>
                </div>
            </aside>
        </section>

        <!-- What it is -->
        <section class="section lab-section" id="about" aria-labelledby="about-heading">
            <div class="section-heading" data-reveal>
                <span class="mono">01 · Premise</span>
                <h2 id="about-heading">Evidence before ambition</h2>
                <p class="eyebrow-note">Most ideas are abandoned or overbuilt for the same reason. Nobody puts them in front of reality early enough to learn what they actually need.</p>
            </div>
            <div class="instruments" data-reveal>
                <p><span class="accent">SaaS Lab is a workbench for turning a software idea into something real enough to test.</span> The rule is simple. Finish one complete product loop, put it into real use, then let behaviour decide whether the idea earns more scope. An experiment that ends early is not a failure. It is a question answered cheaply.</p>
                <div class="inv-grid">
                    <div class="inv-group">
                        <h3>What it is</h3>
                        <ul>
                            <li>A testing method</li>
                            <li>A record of decisions</li>
                            <li>A place to start ideas</li>
                        </ul>
                    </div>
                    <div class="inv-group">
                        <h3>What it is not</h3>
                        <ul>
                            <li>A startup pitch</li>
                            <li>A demo reel</li>
                            <li>A promise to ship</li>
                        </ul>
                    </div>
                    <div class="inv-group">
                        <h3>Each experiment asks</h3>
                        <ul>
                            <li>Is the problem real</li>
                            <li>Does the loop hold</li>
                            <li>Is more complexity earned</li>
                        </ul>
                    </div>
                    <div class="inv-group">
                        <h3>Outcomes</h3>
                        <ul>
                            <li>Continue or simplify</li>
                            <li>Pivot the question</li>
                            <li>Archive with lessons</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Active experiments -->
        <section class="section lab-section" id="experiments" aria-labelledby="experiments-heading">
            <div class="section-heading" data-reveal>
                <span class="mono">02 · On the bench</span>
                <h2 id="experiments-heading">Three experiments in progress</h2>
                <p class="eyebrow-note">Each product is treated as a live experiment with a hypothesis, a working loop, and a decision waiting on evidence.</p>
            </div>

            <div class="experiments">
                <!-- EXP-01 SousMeow -->
                <article class="experiment" id="exp-sousmeow" data-reveal aria-labelledby="exp1-name">
                    <div class="experiment__head">
                        <span class="experiment__ghost" aria-hidden="true">01</span>
                        <span class="experiment__id">EXP-01</span>
                        <h3 class="experiment__name" id="exp1-name">SousMeow</h3>
                        <span class="signal signal--active">Active prototype</span>
                    </div>
                    <div class="experiment__body">
                        <div class="experiment__narrative">
                            <div class="experiment__hypothesis">
                                <span class="field-label">Hypothesis</span>
                                <blockquote>People will run multi-step AI work when it uses the subscriptions they already pay for, with no API keys and no per-token billing.</blockquote>
                            </div>
                            <div class="experiment__block">
                                <span class="field-label">Problem being tested</span>
                                <p>Prompts get shared as isolated snippets. A complete process, like research then draft then refine, rarely survives being copied between people. The steps and the order are the part that gets lost.</p>
                            </div>
                            <div class="experiment__block">
                                <span class="field-label">Working product loop</span>
                                <div class="loop">
                                    <span>Record a process as a Cookbook</span><i>→</i>
                                    <span>Run it on your own AI subscription</span><i>→</i>
                                    <span>Each step feeds the next</span>
                                </div>
                            </div>
                        </div>
                        <div class="rail">
                            <dl>
                                <div>
                                    <dt>Evidence watched</dt>
                                    <dd class="muted">Whether people finish a whole Cookbook instead of stopping after the first step, and whether authors return to publish a second.</dd>
                                </div>
                                <div>
                                    <dt>Technology</dt>
                                    <dd class="tech"><span>PHP</span><span>MySQL</span><span>JavaScript</span></dd>
                                </div>
                                <div>
                                    <dt>Decision gate</dt>
                                    <dd>Do runs complete end to end, and do authors package processes they already do by hand?</dd>
                                </div>
                                <div>
                                    <dt>Next experiment</dt>
                                    <dd class="muted">Share a Cookbook by link and run it with no setup.</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </article>

                <!-- EXP-02 Arcana -->
                <article class="experiment" id="exp-arcana" data-reveal aria-labelledby="exp2-name">
                    <div class="experiment__head">
                        <span class="experiment__ghost" aria-hidden="true">02</span>
                        <span class="experiment__id">EXP-02</span>
                        <h3 class="experiment__name" id="exp2-name">Arcana</h3>
                        <span class="signal signal--working">Working system</span>
                    </div>
                    <div class="experiment__body">
                        <div class="experiment__narrative">
                            <div class="experiment__hypothesis">
                                <span class="field-label">Hypothesis</span>
                                <blockquote>A song carries enough structure, in its themes, mood, symbols, and imagery, to drive a finished piece of art without the listener writing a prompt.</blockquote>
                            </div>
                            <div class="experiment__block">
                                <span class="field-label">Problem being tested</span>
                                <p>Image tools expect prompt engineering. Most people can describe how a song feels but not how to phrase that for a generator. The gap sits between feeling and instruction.</p>
                            </div>
                            <div class="experiment__block">
                                <span class="field-label">Working product loop</span>
                                <div class="loop">
                                    <span>Choose a song</span><i>→</i>
                                    <span>Read its themes and mood</span><i>→</i>
                                    <span>Compose a visual brief</span><i>→</i>
                                    <span>Generate one finished piece</span>
                                </div>
                            </div>
                        </div>
                        <div class="rail">
                            <dl>
                                <div>
                                    <dt>Evidence watched</dt>
                                    <dd class="muted">Whether the result feels like the song to the person who chose it, and whether one generation is enough or people reach to regenerate.</dd>
                                </div>
                                <div>
                                    <dt>Technology</dt>
                                    <dd class="tech"><span>PHP</span><span>Gemini</span><span>Imagick</span></dd>
                                </div>
                                <div>
                                    <dt>Decision gate</dt>
                                    <dd>Does song analysis produce art people keep without editing the prompt themselves?</dd>
                                </div>
                                <div>
                                    <dt>Next experiment</dt>
                                    <dd class="muted">Drive a short visual sequence from the same analysis, not a single frame.</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </article>

                <!-- EXP-03 StoryForge -->
                <article class="experiment" id="exp-storyforge" data-reveal aria-labelledby="exp3-name">
                    <div class="experiment__head">
                        <span class="experiment__ghost" aria-hidden="true">03</span>
                        <span class="experiment__id">EXP-03</span>
                        <h3 class="experiment__name" id="exp3-name">StoryForge</h3>
                        <span class="signal signal--dev">In development</span>
                    </div>
                    <div class="experiment__body">
                        <div class="experiment__narrative">
                            <div class="experiment__hypothesis">
                                <span class="field-label">Hypothesis</span>
                                <blockquote>Fiction is easier to finish when the messy front of the work, the research and structure, is made explicit before any drafting begins.</blockquote>
                            </div>
                            <div class="experiment__block">
                                <span class="field-label">Problem being tested</span>
                                <p>Writers stall between idea and manuscript. The connective tissue, the reader promise, the outline, the character and world bibles, usually lives in someone's head and breaks under the weight of a full draft.</p>
                            </div>
                            <div class="experiment__block">
                                <span class="field-label">Working product loop</span>
                                <div class="loop">
                                    <span>Market intelligence and Story DNA</span><i>→</i>
                                    <span>Reader promise and outline</span><i>→</i>
                                    <span>Character and world bibles</span><i>→</i>
                                    <span>Chapters and export</span>
                                </div>
                            </div>
                        </div>
                        <div class="rail">
                            <dl>
                                <div>
                                    <dt>Evidence watched</dt>
                                    <dd class="muted">Whether writers reach a finished chapter, and whether front-loaded structure reduces rewrites mid draft.</dd>
                                </div>
                                <div>
                                    <dt>Technology</dt>
                                    <dd class="tech"><span>PHP</span><span>Markdown</span><span>AI workflows</span></dd>
                                </div>
                                <div>
                                    <dt>Decision gate</dt>
                                    <dd>Does structure defined up front carry a writer from premise to exported chapters?</dd>
                                </div>
                                <div>
                                    <dt>Next experiment</dt>
                                    <dd class="muted">Export into the formats readers actually use.</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <!-- Operating method -->
        <section class="section lab-section" id="method" aria-labelledby="method-heading">
            <div class="section-heading" data-reveal>
                <span class="mono">03 · Operating method</span>
                <h2 id="method-heading">From problem to decision</h2>
                <p class="eyebrow-note">Every experiment follows the same path. Launch is one possible outcome at the gate, not the goal of the process.</p>
            </div>
            <div class="pipeline" data-reveal>
                <div class="pipe-step">
                    <div class="pipe-step__num">01</div>
                    <div class="pipe-step__body">
                        <h3>Identify a real problem</h3>
                        <p>Start from friction that already exists for real people, not from a feature that would be interesting to build.</p>
                    </div>
                </div>
                <div class="pipe-step">
                    <div class="pipe-step__num">02</div>
                    <div class="pipe-step__body">
                        <h3>Define the smallest complete loop</h3>
                        <p>Find the shortest path where a person gives input and gets a useful result. Complete matters more than large.</p>
                    </div>
                </div>
                <div class="pipe-step">
                    <div class="pipe-step__num">03</div>
                    <div class="pipe-step__body">
                        <h3>Build a deployable experiment</h3>
                        <p>Ship something that runs under real hosting conditions. A prototype that cannot be used teaches very little.</p>
                    </div>
                </div>
                <div class="pipe-step">
                    <div class="pipe-step__num">04</div>
                    <div class="pipe-step__body">
                        <h3>Put it into real use</h3>
                        <p>Hand it to real people with real intent. Opinions are useful. Behaviour is the evidence that counts.</p>
                    </div>
                </div>
                <div class="pipe-step">
                    <div class="pipe-step__num">05</div>
                    <div class="pipe-step__body">
                        <h3>Observe friction and behaviour</h3>
                        <p>Watch where people stop, repeat, or work around the design. The friction points are the honest feedback.</p>
                    </div>
                </div>
                <div class="pipe-step pipe-step--gate">
                    <div class="pipe-step__num"><span>◆</span></div>
                    <div class="pipe-step__body">
                        <h3>Decide at the gate</h3>
                        <p>Read the evidence and choose the next move. Each choice is a valid result, including a clean ending.</p>
                        <div class="gate-outcomes">
                            <span>Continue</span>
                            <span>Pivot</span>
                            <span>Simplify</span>
                            <span>Archive</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Principles -->
        <section class="section lab-section" id="principles" aria-labelledby="principles-heading">
            <div class="section-heading" data-reveal>
                <span class="mono">04 · Lab principles</span>
                <h2 id="principles-heading">How the bench is run</h2>
            </div>
            <ol class="tenets" data-reveal>
                <li class="tenet">
                    <span class="tenet__num">P1</span>
                    <p>Finish the complete loop before expanding scope.</p>
                </li>
                <li class="tenet">
                    <span class="tenet__num">P2</span>
                    <p>Simple infrastructure is often an advantage.</p>
                </li>
                <li class="tenet">
                    <span class="tenet__num">P3</span>
                    <p>Let evidence justify complexity.</p>
                </li>
                <li class="tenet">
                    <span class="tenet__num">P4</span>
                    <p>Build for real deployment conditions.</p>
                </li>
                <li class="tenet">
                    <span class="tenet__num">P5</span>
                    <p>Archive experiments without treating them as failures.</p>
                </li>
                <li class="tenet">
                    <span class="tenet__num">P6</span>
                    <p>AI speeds up execution. It does not replace product judgment.</p>
                </li>
            </ol>
        </section>

        <!-- Technical approach -->
        <section class="section lab-section" id="stack" aria-labelledby="stack-heading">
            <div class="section-heading" data-reveal>
                <span class="mono">05 · The bench</span>
                <h2 id="stack-heading">Instruments on hand</h2>
                <p class="eyebrow-note">The stack is deliberately small. The point is not the tools. It is being able to move from idea to deployed software quickly.</p>
            </div>
            <div class="instruments" data-reveal>
                <p><span class="accent">Modest, well understood tools remove the distance between an idea and something running.</span> Shared hosting keeps each experiment honest about real deployment conditions from the first day.</p>
                <div class="inv-grid">
                    <div class="inv-group">
                        <h3>Runtime</h3>
                        <ul>
                            <li>PHP 8.2</li>
                            <li>HTML</li>
                            <li>CSS</li>
                            <li>JavaScript</li>
                        </ul>
                    </div>
                    <div class="inv-group">
                        <h3>Data</h3>
                        <ul>
                            <li>SQLite</li>
                            <li>MySQL</li>
                        </ul>
                    </div>
                    <div class="inv-group">
                        <h3>Automation</h3>
                        <ul>
                            <li>Cron workers</li>
                            <li>GitHub</li>
                        </ul>
                    </div>
                    <div class="inv-group">
                        <h3>Delivery</h3>
                        <ul>
                            <li>cPanel</li>
                            <li>Shared Linux hosting</li>
                        </ul>
                    </div>
                    <div class="inv-group">
                        <h3>AI assistance</h3>
                        <ul>
                            <li>Claude</li>
                            <li>Cursor</li>
                            <li>ChatGPT</li>
                            <li>Gemini</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="lab-close" data-reveal aria-labelledby="close-heading">
        <h2 id="close-heading">Ideas get cheaper to judge with practice</h2>
        <p>SaaS Lab is the method behind the products in the workshop. Every experiment leaves a record, and the record is what makes the next decision faster.</p>
        <div class="lab-close__links">
            <a href="/site/">Return to the workshop journal</a>
            <a href="mailto:iain@iainreid.dev">iain@iainreid.dev</a>
        </div>
        </section>
    </main>

    <footer>
        <span>iainreid.dev / saas-lab</span>
        <span>Field ledger · <time datetime="2026">2026</time></span>
    </footer>

    <script src="../assets/js/app.js?v=20260719d"></script>
</body>
</html>
