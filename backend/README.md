# Backend

## Getting started

You need PHP installed (e.g. `sudo apt install php` on Ubuntu)

Then run:

`git clone https://github.com/19pdh/harcdzielnia.app`

`cd backend/config`

Create file `config.php` and fill it like `config.template.php`.

## Rewrites

Basically you can access API at `routes/<name>.php` and use basic GET params, but you should rewrite endpoints on your own.

Example for Apache:

```
RewriteRule items$ routes/public/items.php
RewriteRule items/([0-9]+)$ routes/public/item.php?id=$1
RewriteRule items/([0-9]+)/handed$ routes/public/item-handed?id=$1
RewriteRule items/add$ routes/public/add-item.php

RewriteRule items/unapproved$ routes/management/unapproved-items.php
RewriteRule items/([0-9]+)/details$ routes/management/item-details.php?id=$1
RewriteRule items/create$ routes/management/create-item.php
RewriteRule items/([0-9]+)/approve$ routes/management/approve-item.php?id=$1
RewriteRule items/([0-9]+)/delete$ routes/management/delete-item.php?id=$1
RewriteRule items/([0-9]+)/hide$ routes/management/hide-item.php?id=$1

RewriteRule users$ routes/admin/users.php
RewriteRule users/add$ routes/admin/add-user.php
RewriteRule users/([0-9]+)/delete$ routes/admin/delete-user.php?id=$1

RewriteRule user$ routes/auth/user.php
RewriteRule user/login$ routes/auth/login.php
RewriteRule user/logout$ routes/auth/logout.php
RewriteRule user/reset-password$ routes/auth/reset-password.php
RewriteRule user/change-password$ routes/auth/change-password.php
```

(e.g. `/items/1 -> /routes/item.php?id=1`)

## API Endpoints

### Public

**GET** `/items` - list items
**GET** `/items/ID` - detailed info about item with ID
**POST** `/items/ID/handed` - hide item on website (item was handed over) - sending confirmation link via email
|Name|Description|
|---------|---------|
| email| E-mail used in adding item form |
| token _(optional)_| Token from email (probably placed in GET query param) |

**POST** `/items/add` - add new item
|Name|Description|
|---------|---------|
|name|Item name|
|description|Item description|
|image **(file)**|Item image|
|order_type|Item order type (1/2/3)|
|contact_info| Public contact info of item owner|
|email|Item owner e-mail for system notifications and authentication|

### Management

**GET** `/items/unapproved` - list unapproved items
**GET** `/items/ID/details` - detailed info (and owner email) about item with ID
**POST** `items/create` - create new item (bypassing approve process)
|Name|Description|
|---------|---------|
|name|Item name|
|description|Item description|
|image **(file)**|Item image|
|order_type|Item order type (1/2/3)|
|contact_info|Public contact info of item owner|
|email|Item owner e-mail for system notifications and authentication|
|csrf|CSRF token from cookie "csrf"|
**POST** `/items/ID/approve` - approve new item
|Name|Description|
|---------|---------|
|csrf|CSRF token from cookie "csrf"|
**POST** `/items/ID/delete` - delete existing item
|Name|Description|
|---------|---------|
|csrf|CSRF token from cookie "csrf"|
**POST** `/items/ID/hide` - hide existing item on website (bypass email confirmation)
|Name|Description|
|---------|---------|
|csrf|CSRF token from cookie "csrf"|

### User

**GET** `/user` - get currently logged in user data
**POST** `/user/login` - user login
|Name|Description|
|---------|---------|
|email|User e-mail|
|password|User password|
|csrf|CSRF token from cookie "csrf"|
**GET** `/user/logout` - user logout
**POST** `/user/change-password` - change user password
|Name|Description|
|---------|---------|
|csrf|CSRF token from cookie "csrf"|
|password|New user password|
|old-password|Old user password|
**POST** `/user/reset-password` - reset user password
|Name|Description|
|---------|---------|
|csrf|CSRF token from cookie "csrf"|
|email|User email|

### Admin

**GET** `/users` - list users
**POST** `/users/add` - add new user (sending default password via email)
|Name|Description|
|---------|---------|
|name|User name|
|permissions|User permissions (0/1/2/3)|
|email|User email|
|csrf|CSRF token from cookie "csrf"|
**POST** `/users/ID/delete` - delete user with ID
|Name|Description|
|---------|---------|
|csrf|CSRF token from cookie "csrf"|
