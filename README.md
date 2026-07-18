# iainreid.dev

Personal development portfolio for [iainreid.dev](https://iainreid.dev).

## Site layout

Static files that should be served publicly live under `public/`:

- `public/index.html` — landing page
- `public/assets/css/styles.css` — styles
- `public/assets/js/main.js` — light interaction / motion

## Deployment (cPanel)

This repository uses cPanel Git Version Control with a root-level `.cpanel.yml`.

### What deploys

On deploy, cPanel runs the tasks in `.cpanel.yml`, which:

1. Sets `DEPLOYPATH` to `$HOME/public_html/`
2. Ensures that directory exists
3. Copies the contents of `public/` into the document root

Source control files (`.git`, `.cpanel.yml`, this README) are not copied into the web root.

### One-time setup in cPanel

1. In **cPanel → Files → Git™ Version Control**, create or clone this repository on the server.
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
