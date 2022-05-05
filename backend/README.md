# Backend

## Getting started

You need PHP installed (e.g. `sudo apt install php` on Ubuntu)

`git clone https://github.com/19pdh/harcdzielnia.app`

`cd backend/config`

Create file `config.php` and fill it like `config.template.php`.

## Rewrites

Basically you can access API at `routes/<name>.php`, but you should rewrite endpoints on your own with `id` param in URL.

Example for Apache:

```
RewriteRule items/([0-9]+)$ routes/items.php?id=$1
```

(`/items/1 -> /routes/items.php?id=1`)
