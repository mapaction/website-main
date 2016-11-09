# website-main
Wordpress templates and customisation for MapAction's website

## Structure
- deploy/
  - Deployment scripts (see [Deployment](#deployment))
- wordpress/
  - Subfolder containing our Wordpress themes and plugins. Folder structure should match that of a full wordpress site, eg. the main theme goes in `wordpress/wp-content/themes/mapaction` 
- dev/
  - Contains files and scripts useful for development (see [Development](#development))

<a name="deployment"></a>
# Deployment
TODO

<a name="development"></a>
# Development
Development can be done with a local mysql database and apache server - in which case you will want to configure `wordpress/wp-config.php` to match the settings of your development machine.

Alternatively you can use Docker containers to start an Apache and Mysql server, and ensure you're working from the correct version of both. We provide Dockerfiles to build the needed docker containers: `dev/docker/mapaction-apache` and `dev/docker/mapaction-mysql`

The easiest way to run these is use the scripts in `dev/bin`:

- `dev/bin/start-mysql.sh` will:
  - Build a Docker image called `mapaction-mysql`
  - Start a container running that image
  - Mount the container's `/var/lib/mysql` to `dev/mysql_data` so your mysql data persists across container rebuilds
  - The default datbase is called `mapaction`, with username `mapaction` and password `mapaction`. (I know, right?)
- `dev/bin/start-apache.sh` will:
  - Build a Docker image called `mapaction-apache`
  - Start a container running that image
  - Mount the container's `/var/www/html` to `wordpress` so this will use the wordpress files installed in your local file system, and you can edit them directly
  - This requires the mysql container to be running, and be named mapaction-mysql (as it will be if started with the `dev/bin/start-mysql.sh` script). In the configuration the Myslq host should simply be `mapaction-mysql`

You will need to edit the file in `wordpress/wp-config.php` to match this setup by changing the following lines:
```php
<?php
define('DB_NAME', 'mapaction');
define('DB_USER', 'mapaction');
define('DB_PASSWORD', 'mapaction');
define('DB_HOST', 'mapaction-mysql');
?>
