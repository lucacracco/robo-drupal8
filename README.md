Robo Drupal8 Builder
====================

This repository contains various functions for build and rebuild your project [Drupal8](https://www.drupal.org/) with [Robo](http://robo.li/) through simplified configuration file.
This code method (defined idea of functionality) is experimental.

Run function in Stack Task or directly. 
You can define global configuration/options for one or multi-site project through file configuration yml.

The implementation uses [Robo Drush Extension](https://github.com/boedah/robo-drush) for integration with [Drush](http://www.drush.org/en/master/) and [Robo](http://robo.li/).

**Note**: only version `~1.0` of Robo.


## Table of contents

- [Installation](#installation)
- [My RoboFile](#my robofile)
- [Usage](#usage)
- [Examples](#examples)


Usage
=====

## Installation

Use the trait (according to your used version) in your RoboFile:

```php
class RoboFile extends \Robo\Tasks
{

    use \LucaCracco\Robo\Task\Drupal8\loadTasks;

    //...
}
```

When load/use the `taskDrupal8Stack` (Stack Task) or `taskDrupal8Functionality` (directly), you must pass the following parameters to properly initialize the object:
* Environment variable (local|stage|prod|custom1|..);
* Match to the sites that you want to start, useful for multi-site. In the case of a single installation to use/leave 'default'.
* Path where to find the [configuration files](#configuration-project).

See example in repository of `RoboFile.php`.


## My Robofile

I have included in the repository an example of `RoboFile` that I used and still use in various projects, including multi site.

The file is not complete and is constantly updated.

## Configuration project

In the folder [build](build) you will find the basic configuration files.

Customize these in your project to get full control of the build.

```yml
# Enviroment
environment: local
# Base Path
base_path: /var/www/html
# Path to drush
drush_path: drush
....
# Site configuration
site_configuration:
  mail: user@example.com
  name: 'Drupal Example'
  profile: standard
  config_dir: '../config/default'
  root: 'web'
...
```

Examples
========

### Site build from scratch

```php
...
$this->taskDrupal8Stack($parameter['environment'], $parameter['sub_dir'], $parameter['path_properties'])
  ->backupDatabase()
  ->setupInstallation()
  ->install()
  ->configureSettings()
  ->protectSite()
  ->coreCron()
  ->rebuildCache()
  ->installModules();
...
```

### Site build from configs dir

```php
...
$this->taskDrupal8Stack($parameter['environment'], $parameter['sub_dir'], $parameter['path_properties'])
  ->backupDatabase()
  ->setupInstallation()
  ->installFromConfig()
  ->configureSettings()
  ->protectSite()
  ->coreCron()
  ->rebuildCache();
 ...
```

### Export configuration

```php
...
$this->taskDrupal8Stack($parameter['environment'], $parameter['sub_dir'], $parameter['path_properties'])
  ->rebuildCache()
  ->exportConfig()
  ->run();
...
```

**Note**:
_Current method of importing configurations!_ 

Drush command to install Drupal with args `--config-dir` (that defined a path pointing to a full set of configuration which should be imported after installation) (https://drushcommands.com/drush-8x/core/site-install/ ), not worked well.

Or at least it does not work properly with the multi site.

Currently use [Configuration installer](https://www.drupal.org/project/config_installer).

Include this in your project if you want to use this functionality.

Complete example
----------------

In the store I also included a concrete example of use: you'll find it in the [example](example) folder. 

Use [Docker](https://www.docker.com/) (my custom image) but you can change with any other amp stack system.

### Install
Execute the task `buildNew` from [RoboFile.php](/RoboFile.php) after download dependencies with [Composer](https://getcomposer.org/).

```bash
# Use composer for download dependencies
composer install --prefer-dist
# Start installation with Robo
vendor/bin/robo build:new -s default -e local
```

Export configuration after installation or update building.
```bash
vendor/bin/robo configuration:export -s default -e local
```

Rebuild Drupal site from only configurations dir (not imported database).
```bash
vendor/bin/robo build:conf -s default -e local
```

See [RoboFile.php](RoboFile.php) for other functionality.

Contact
=======

For issues, questions or tips go to:
[https://github.com/lucacracco/robo-drupal8(https://github.com/lucacracco/robo-drupal8)