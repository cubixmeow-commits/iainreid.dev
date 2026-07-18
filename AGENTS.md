# Agent instructions: iainreid.dev

This repository is the public personal development portfolio for Iain Reid Glendinning at https://iainreid.dev.

Before changing product copy, project data, homepage structure, or deployment, read `docs/PORTFOLIO_STRATEGY.md`.

## Permanent rules

1. iainreid.dev is a living personal development portfolio.
2. Projects should not be hidden solely because they failed or were paused.
3. All claims must be supported by repository data or approved content.
4. No fake metrics, users, revenue, testimonials, or outcomes.
5. SaaS Lab is the central system for organizing rapid product experiments.
6. New projects must use the shared project-data model in `data/projects.php`.
7. Homepage changes must preserve the clear explanation of the portfolio and SaaS Lab.
8. Mobile usability is mandatory.
9. The design must not degrade into a generic AI-generated portfolio.
10. Deployment compatibility must be reviewed before completing changes.

## Stack constraints

- PHP presentation site with no required build step
- Central project registry: `data/projects.php`
- Public web root: `public/`
- Private application files: `includes/`, `data/`, `docs/`
- Self-hosted fonts and local assets only
- Prefer shared-hosting and Namecheap cPanel compatibility

## cPanel deployment maintenance

Namecheap cPanel deploys this repository through the root `.cpanel.yml` file into:

- Web document root: `$HOME/public_html/` (contents of `public/` only)
- Private application root: `$HOME/iainreid-dev/`

Treat deployment compatibility as part of the definition of done for every change.

Before completing any coding task:

1. Review whether files, folders, entry points, build outputs, dependencies, or runtime storage changed.
2. Re-open `.cpanel.yml`.
3. Update it when deployment requirements changed.
4. Leave it unchanged when no deployment change is required.
5. Validate every path referenced by `.cpanel.yml`.
6. Never overwrite secrets, `.env`, production databases, uploads, or server-only config.
7. Mention in the final summary either:
   - `.cpanel.yml updated`, with the reason, or
   - `.cpanel.yml reviewed; no update required`.

## Content boundaries

- Do not invent employers, education, awards, revenue, customers, or years of experience.
- Do not expose a personal email unless it is already intentionally public.
- Do not copy Pieter Levels' visual design, wording, branding, layout, or code.
- Use only the broad strategic idea of a transparent public archive of projects and experiments.
- Do not use em dashes in user-facing copy.

## Homepage integrity

A first-time visitor must be able to answer:

- Who is Iain Reid?
- What is iainreid.dev?
- What kinds of products does he build?
- What is SaaS Lab?
- Why does SaaS Lab exist?
- How does it help him test ideas?
- Which projects are active?
- Which projects are experiments?
- Where can the visitor inspect the actual work?
- What has Iain learned from building these products?
