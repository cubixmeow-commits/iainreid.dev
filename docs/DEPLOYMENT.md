# Deployment

The repository keeps the existing cPanel Git deployment flow.

Deployment target:

`/home/iainmcok/public_html/site/`

Recommended permissions after deployment:

```bash
find ~/public_html/site -type d -exec chmod 755 {} \;
find ~/public_html/site -type f -exec chmod 644 {} \;
```

## URL mapping

The public document root is `public_html/`. The repository deploys to
`public_html/site/`, so the site is served under `https://iainreid.dev/site/`
(for example the SaaS Lab page is `https://iainreid.dev/site/saas-lab/`). The
shared account system lives under the same base path (`/site/auth/...`,
`/site/admin/`). This base path is configured in one place: `includes/config.php`.

## Shared account system (SaaS Lab)

The Git deployment now also copies `auth/`, `admin/`, `data/`, and `scripts/`,
and removes the stale static `saas-lab/index.html` (that page is now served by
`saas-lab/index.php`). See `docs/AUTH.md` for the full account-system guide.

### Database directory must be writable

The SQLite database is created at runtime at
`~/public_html/site/data/saas-lab.sqlite`. SQLite also writes journal/lock files
in that directory, so **`data/` itself must be writable by the PHP user**.
Ownership matters more than the numeric mode; on this host PHP runs as the site
user, so owner-write suffices. Least-permissive starting point:

```bash
chmod 750 ~/public_html/site/data
# after the DB is created:
chmod 640 ~/public_html/site/data/saas-lab.sqlite
```

Do not use 777. The blanket `chmod` above still leaves `data/` owner-writable.

### Create the first administrator (on the server)

```bash
cd ~/public_html/site
SAAS_LAB_ADMIN_PASSWORD='strong-password' \
  php scripts/create-admin.php --name="Iain Reid" --email="admin@example.com"
```

### Verify the database is not reachable over HTTP (required post-deploy test)

```bash
curl -I https://iainreid.dev/site/data/saas-lab.sqlite
```

Expected: **403 Forbidden** (404 also acceptable). A 200 / file download is a
deployment blocker — fix `data/.htaccess` and permissions before proceeding.

## Gated experiments (`x/`)

The deployment now also copies the `x/` directory (gated experiment routes, e.g.
`x/hello.php` served at `https://iainreid.dev/site/x/hello.php`). The
`experiments/` template folder and `docs/` are intentionally **not** deployed.

### Stale gated-route files (important)

The cPanel deploy is **copy-only** — it never deletes files the repository
removed or renamed. If you rename or replace a gated route, the **old, possibly
ungated file stays live on the server and can bypass the gate**. After any such
change, remove the stale file over SSH, for example:

```bash
rm -f ~/public_html/site/x/old-name.php
# or an entire renamed experiment folder:
rm -rf ~/public_html/site/x/old-slug
```

Then re-verify the old URL returns 404 and the new one is gated. See
`docs/EXPERIMENT_VISIBILITY.md` for the full verification procedure.
