# Landslide Creative Wordpress Boilerplate

A Wordpress installation boilerplate for projects launched by [Landslide Creative](http://landslidecreative.com).

## General Setup

All Wordpress core files have been moved into the _/core/_ directory.

The _wp-config.php_ files have been excluded from this repo, but can be downloaded [here](https://s3.amazonaws.com/landslide-dev/wp-config.zip). Place them in the _/core/_ directory and add your database information. On the staging server, remove the _wp-config-local.php_ file. On the production server, leave only _wp-config.php_.

## Plugin Management

Plugins are managed using [Composer](https://getcomposer.org/) and [WPackagist](https://wpackagist.org/). Premium plugins are pulled from private repos.

After updating plugin versions in _composer.json_, run `composer update` to download updated plugin files.

## Theme Development

For theme specific information, see the _README.md_ file in the theme folder.