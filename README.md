Stamp for Craft
===========
A tiny plugin for adding timestamp to filenames. 

*This is the Craft 4.x version of Stamp, for older Craft versions see tags in the [repository](https://github.com/aelvan/Stamp-Craft/tags).*

Requirements
---
This plugin requires Craft CMS 4.0.0 or later.

Installation
---
To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require aelvan/stamp

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Stamp.

Usage
---
Use it like this:
 
    <script src="{{ craft.stamp.er('/assets/build/js/scripts.js') }}"></script> 

Which results in:

    <script src="/assets/build/js/scripts.1399647655.js"></script>

The er() method takes a second parameter for setting the format of the output. Possible values are `file` (default), `folder`, `query` and `tsonly`.

Example with `folder`:

    <script src="{{ craft.stamp.er('/assets/build/js/scripts.js', 'folder') }}"></script> 

Result:

    <script src="/assets/build/js/1399647655/scripts.js"></script>

Example with `query`:

    <script src="{{ craft.stamp.er('/assets/build/js/scripts.js', 'query') }}"></script> 

Result:

    <script src="/assets/build/js/scripts.js?ts=1399647655"></script>

Example with `only`:

    Timestamp is: {{ craft.stamp.er('/assets/build/js/scripts.js', 'only') }} 

Result:

    Timestamp is: 1399647655


Hashing option
---

The `craft.stamp.er()` method takes a third parameter for setting the algorithm of the output. Possible values are `ts` (default), and `hash`.

`ts` stands for timestamp and behaves as shown above. `hash` gets the CRC32 checksum of the file instead of the timestamp. It's useful for cases when you need your cache busting to be fully deterministic.

For example:

    <script src="{{ craft.stamp.er('/assets/build/js/scripts.js', 'file', 'hash') }}"></script>

Result:

    <script src="/assets/build/js/scripts.2031312059.js"></script>


URL rewriting
---
For methods `file` and `folder` you probably want to do some url rewriting. Below are some examples of how this can be done,
adjust as needed for your server and project setup.

Apache:

    # Rewrites asset versioning, ie styles.1399647655.css to styles.css.
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.+)\.(\d{10})\.(js|css)$ $1.$3 [L]  # /assets/build/js/scripts.1399647655.js
    # RewriteRule ^(.+)/(\d{10})/(.+)\.(js|css)$ $1/$3.$4 [L]  # /assets/build/js/1399647655/scripts.js

nginx:

    location @assetversioning {
        rewrite ^(.+)\.[0-9]+\.(css|js)$ $1.$2 last;  # /assets/build/js/scripts.1399647655.js
        # rewrite ^(.+)/([0-9]+)/(.+)\.(js|css)$ $1/$3.$4 last;  # /assets/build/js/1399647655/scripts.js
    }    

    location ~* ^/assets/.*\.(?:css|js)$ {
        try_files $uri @assetversioning;
        expires max;
        add_header Pragma public;
        add_header Cache-Control "public, must-revalidate, proxy-revalidate";
    }


Configuration
---
Stamp needs to know the public document root to know where your files are located. By default
Stamp will use `@webroot`, but on some server configurations this is not the correct
path. You can configure the path by creating a config file called `stamp.php` in your config folder, 
and adding the `publicRoot` setting.

#### Example

    'publicRoot' => '/path/to/website/public/',

Changelog
---
See [CHANGELOG.md](https://github.com/aelvan/Stamp-Craft/blob/craft3/CHANGELOG.md).
