# Build Notes

The initial prototype uses CSS-built scenery and inline SVG diagrams so it remains fast, responsive, and deployable before generated artwork is added.

Edit portfolio entries in `includes/projects.php`. The first entry is rendered as the current experiment; the remaining entries appear in the archive.

SaaS Lab lives at `saas-lab/index.html` as a self-contained landing page. Add new experiments by inserting another project card in that file.

The existing cPanel deployment target remains `/home/iainmcok/public_html/site/`.
