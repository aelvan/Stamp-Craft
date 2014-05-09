Stamp for Craft
===========

A tiny plugin for adding timestamp to filenames. 


Usage
---
Use it like this:
 
    <script src="{{ craft.stamp.er('/build/js/scripts.js') }}"></script> 

Which results in:

    <script src="/assets/build/js/scripts.1399647655.js"></script>

Rewrite the filenames with something like this in your .htaccess:

    # Rewrites asset versioning, ie styles.1399647655.css to styles.css.
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.+)\.(\d+)\.(js|css|png|ico|svg|jpe?g|gif)$ $1.$3 [L]

If you want a simpler alternative that doesn't need url rewriting, check out [Bust](https://github.com/davist11/craft-bust/)
by Trevor Davis. But, beware that assets with query strings [may not be cached properly by proxies](http://www.stevesouders.com/blog/2008/08/23/revving-filenames-dont-use-querystring/).


Configuration
---
Stamp needs to know the public document root to know where your files are located. By default
Stamp will use $_SERVER['DOCUMENT_ROOT'], but on some server configurations this is not the correct 
path. You can configure the path by setting the stampPublicRoot setting in your config file 
(usually found in /craft/config/general.php)
 
####Example

    'stampPublicRoot' => '/path/to/website/public/',


Changelog
---
### Version 1.0
 - Initial release