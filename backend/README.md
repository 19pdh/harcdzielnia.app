# Backend

## Getting started

`git clone https://github.com/19pdh/harcdzielnia.app`
`cd backend/config`
Create file `config.php` and fill it like `config/config.template.php`.

## Rewrites

Basically you can access API at `routes/<name>.php`, but you can also redirect traffic from the configured `base_url` (for example `http://localhost/api/<name>`) to `routes/<name>.php`.
