# Build Notes

The initial prototype uses CSS-built scenery and inline SVG diagrams so it remains fast, responsive, and deployable before generated artwork is added.

Edit portfolio entries in `includes/projects.php`. The first entry is rendered as the current experiment; the remaining entries appear in the archive.

VibeKB is the featured project. Its public portfolio page lives at `saas-lab/index.php` (URL path `/site/saas-lab/` for deploy continuity). Update that page’s copy in place; keep the existing layout and components.

The existing cPanel deployment target remains `/home/iainmcok/public_html/site/`.
