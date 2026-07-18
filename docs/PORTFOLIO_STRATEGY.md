# Portfolio strategy for iainreid.dev

## Purpose

iainreid.dev is the personal development portfolio and public software laboratory of Iain Reid Glendinning.

It is not a conventional résumé, agency brochure, or gallery of polished mockups.

It is a living archive of what Iain builds, tests, learns, launches, improves, pauses, and sometimes abandons.

Guiding principle:

**Show the work, not just the winners.**

## Living-portfolio strategy

The site should make it easy to understand:

1. Who Iain Reid is.
2. What he builds.
3. What he is actively working on.
4. Why he builds many small software products and experiments.
5. What each project taught him.
6. Which projects are active, experimental, paused, completed, or retired.
7. How the work demonstrates real product thinking and development ability.

The tone should stay honest, active, technically credible, and personal.

A failed or paused project may still be valuable because it demonstrates product judgment, rapid prototyping, technical implementation, design decisions, market testing, lessons learned, iteration, and deployment experience.

## Role of SaaS Lab

SaaS Lab is central to the portfolio.

It is both:

1. A real software project.
2. The operating system used to organize, build, launch, and evaluate multiple SaaS experiments.

SaaS Lab exists to reduce repeated foundation work such as authentication, database setup, project structure, deployment configuration, admin tools, forms, status tracking, documentation, and experiment notes.

Its purpose is to shorten the distance from idea to working product to real-world evidence.

Technical positioning should stay practical and evidence-based:

- small deployable applications
- simple infrastructure
- PHP-compatible deployment
- SQLite or similarly portable storage
- low operational cost
- minimal dependencies
- shared-hosting compatibility

Do not claim technical features that do not exist. Label planned work as planned.

## Target audiences

- Developers evaluating technical taste and delivery
- Potential employers
- Collaborators and founders
- Nontechnical visitors who still need a clear explanation

Do not assume the visitor already understands SaaS, MVPs, repositories, or product validation. Explain briefly in plain language.

## Homepage messaging hierarchy

1. **Identity:** I'm Iain Reid. I build, launch, and document software products.
2. **Site purpose:** iainreid.dev is a living personal development portfolio.
3. **Current work:** What is actively being built now.
4. **SaaS Lab:** The system behind rapid product experiments.
5. **Archive:** Development history with honest statuses.
6. **Principles:** How the work is approached.
7. **About:** Compact personal context.
8. **Footer:** Continuously updated site, GitHub, contact.

Avoid generic portfolio language such as "passionate developer", "innovative solutions", "cutting-edge technology", "digital experiences", "transforming ideas into reality", "leveraging AI", or "welcome to my portfolio".

Do not use em dashes.

## Project status model

Supported statuses:

- Active
- Building
- New
- Experimental
- Shipped
- Paused
- Retired
- Archived

Use only statuses that fit the real project. Prefer an empty field over a fabricated value.

## Truth and evidence rules

- All claims must be supported by repository data or approved content.
- No fake metrics, users, revenue, testimonials, employers, awards, or outcomes.
- Live links and repository links must point to real destinations.
- Lessons and outcomes should be written only when they are honest summaries of actual work.
- Projects should not be hidden solely because they failed or were paused.

## Visual principles

The site should feel like a distinctive development workshop:

- technical but approachable
- editorial
- structured
- compact
- evidence-oriented
- mobile-first
- slightly experimental without becoming chaotic

Borrow concepts from project indexes, lab records, release histories, and repositories without cloning GitHub's visual design.

Avoid generic AI-portfolio tropes: giant gradient headlines, purple glow blobs, glass cards everywhere, fake terminals, animated noise, oversized bento grids, template testimonials, and meaningless statistics.

## Content rules

- Every section must contribute meaningful information.
- Keep paragraphs compact and readable on an iPhone.
- Prefer concrete language over slogans.
- Critical content must remain available without JavaScript.
- Mobile usability is mandatory.

## What the site must never become

- A highlight reel that hides unfinished or paused work
- A fake metrics dashboard
- A generic AI-generated portfolio template
- A résumé that invents experience
- A design showcase that never shows deployed software
- A dead-link museum

## How future projects should be added

1. Add or update a record in `data/projects.php`.
2. Fill only fields you can support with evidence.
3. Set an honest `status`, `category`, and `display_order`.
4. Mark `current_focus` only for work that is truly active now.
5. Link to a live URL, repository, or detail page when one exists.
6. Confirm the homepage archive and SaaS Lab related list still read clearly.
7. Review `.cpanel.yml` if deployment paths, entry points, or assets changed.
8. Keep copy free of fabricated outcomes.

### Suggested fields

- `slug`
- `title`
- `summary`
- `status`
- `category`
- `year`
- `started_at`
- `updated_at`
- `live_url`
- `repository_url`
- `detail_url`
- `technologies`
- `problem`
- `hypothesis`
- `outcome`
- `lessons`
- `featured`
- `display_order`
- `current_focus`
