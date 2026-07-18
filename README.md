# iainreid.dev

Personal development portfolio for **Iain Reid Glendinning**.

Live site: [https://iainreid.dev](https://iainreid.dev)

This is a living record of software products, experiments, systems, and lessons. The guiding principle is:

**Show the work, not just the winners.**

SaaS Lab is the central system for organizing rapid product experiments. See `docs/PORTFOLIO_STRATEGY.md` and the dedicated page at `/saas-lab/`.

## Stack

- PHP 8 presentation layer (no framework, no build step)
- Central project registry in `data/projects.php`
- Self-hosted fonts and local CSS/JS
- Namecheap cPanel deployment via `.cpanel.yml`

## Local preview

```sh
php -S 127.0.0.1:8080 -t public
```

Then open http://127.0.0.1:8080

The public entry points resolve the private app root automatically when `data/` and `includes/` sit beside `public/`.

## Structure

```
data/projects.php     # shared project archive
includes/             # bootstrap, layout, views
public/               # document root contents
docs/                 # permanent strategy docs
AGENTS.md             # instructions for coding agents
.cpanel.yml           # Namecheap cPanel deploy tasks
```

## Adding a project

1. Edit `data/projects.php`.
2. Use only statuses and facts you can support.
3. Keep homepage and SaaS Lab explanations clear.
4. Review `.cpanel.yml` if deployment inputs changed.

## Deployment (cPanel)

This repository uses cPanel Git Version Control with a root-level `.cpanel.yml`.

| Item | Value |
|------|--------|
| Destination (document root) | `$HOME/public_html/` |
| Private application root | `$HOME/iainreid-dev/` |
| Web source published | contents of `public/` |
| Production branch | `main` |
| Build command | none |

### What deploys

On deploy, cPanel runs the tasks in `.cpanel.yml`, which:

1. Sets `APPPATH` to `$HOME/iainreid-dev/` and `DEPLOYPATH` to `$HOME/public_html/`
2. Copies private app code (`includes/`, `data/`, `docs/`, plus key docs) into `APPPATH`
3. Copies the contents of `public/` into the document root with `public/.`
4. Removes leftover placeholder static files from earlier deploys (`index.html`, old CSS/JS names)
5. Writes a `.portfolio-root` marker so PHP can find the private app root

Source control files (`.git`, `.cpanel.yml`) are not copied into the web root.

### One-time setup in cPanel

1. In **cPanel → Files → Git Version Control**, create or clone this repository on the server.
2. Confirm `.cpanel.yml` is present at the repository root on the branch you deploy.
3. If the primary domain document root is not `$HOME/public_html/`, edit `DEPLOYPATH` in `.cpanel.yml` before deploying (for example a subdomain path under `public_html`).
4. Deploy:
   - **Push deployment:** push to the cPanel-managed remote; the post-receive hook runs `.cpanel.yml` automatically.
   - **Pull deployment:** use **Update from Remote**, then **Deploy HEAD Commit**.

### Changing the deploy process

Whenever the app structure changes, update `.cpanel.yml` so every source path it references still exists, then validate the YAML before merging.

```bash
python3 -c "import yaml, pathlib; yaml.safe_load(pathlib.Path('.cpanel.yml').read_text())"
```

### Important hosting note

The sibling **SaaS Lab** repository previously targeted the same document root (`$HOME/public_html/`). This portfolio is now the primary site for iainreid.dev. SaaS Lab should be moved to a subdirectory or subdomain before both are deployed, or its `.cpanel.yml` should be updated so the two apps do not overwrite each other.

## Contact

- GitHub: [github.com/cubixmeow-commits](https://github.com/cubixmeow-commits)
- Email: hello@cubixmeow.com
