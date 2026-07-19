# Deployment

The repository keeps the existing cPanel Git deployment flow.

Deployment target:

`/home/iainmcok/public_html/site/`

Recommended permissions after deployment:

```bash
find ~/public_html/site -type d -exec chmod 755 {} \;
find ~/public_html/site -type f -exec chmod 644 {} \;
```
