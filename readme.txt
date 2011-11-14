Configuration steps:
====================

1. Edit application/config/config.php
	- set your site URL here: $config['base_url'] = "http://example.com/";

2. Import database
	- create a new database
	- run database.sql

3. Setup database connection:
	- edit system/application/config/database.php:
		$db['default']['hostname'] = "your_host";
		$db['default']['username'] = "your_user";
		$db['default']['password'] = "your_db_password";
		$db['default']['database'] = "your_db_name";

4. Get rid of index.php from URL (apache mod_rewrite required)
	- if application is not in your server root, edit last line in htaccess.txt: RewriteRule ^(.*)$ /path/to/app/index.php/$1 [L]
	- edit system/application/config/config.php: $config['index_page'] = "";
	- rename htaccess.txt to .htaccess

That's it

=====================

Bugs, opinions, feature requests, support: http://code.google.com/p/carbogrid/