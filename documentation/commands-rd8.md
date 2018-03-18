RoboDrupal8 2.x
===============

* [`dcc`](#drupalcacherebuild)
* [`dce`](#drupalconfigurationexport)
* [`dci`](#drupalconfigurationimport)
* [`frontend`](#frontend)
* [`help`](#help)
* [`install-alias`](#install-alias)
* [`list`](#list)
* [`tests`](#tests)
* [`validate`](#validate)

**composer:**

* [`composer:install`](#composerinstall)
* [`composer:require`](#composerrequire)
* [`composer:update`](#composerupdate)
* [`composer:validate`](#composervalidate)

**config:**

* [`config:dump`](#configdump)
* [`config:export`](#configexport)
* [`config:get`](#configget)
* [`config:save`](#configsave)

**drupal:**

* [`drupal:cache:rebuild`](#drupalcacherebuild)
* [`drupal:configuration:export`](#drupalconfigurationexport)
* [`drupal:configuration:import`](#drupalconfigurationimport)
* [`drupal:core-cron`](#drupalcore-cron)
* [`drupal:database:drop`](#drupaldatabasedrop)
* [`drupal:database:export`](#drupaldatabaseexport)
* [`drupal:database:import`](#drupaldatabaseimport)
* [`drupal:extension:enable`](#drupalextensionenable)
* [`drupal:extension:uninstall`](#drupalextensionuninstall)
* [`drupal:extra:login-one-time-url`](#drupalextralogin-one-time-url)
* [`drupal:extra:maintenance-mode`](#drupalextramaintenance-mode)
* [`drupal:filesystem:clear`](#drupalfilesystemclear)
* [`drupal:filesystem:protect-site`](#drupalfilesystemprotect-site)
* [`drupal:install-from-config`](#drupalinstall-from-config)
* [`drupal:install-scratch`](#drupalinstall-scratch)
* [`drupal:locale:check`](#drupallocalecheck)
* [`drupal:locale:update`](#drupallocaleupdate)
* [`drupal:settings`](#drupalsettings)
* [`drupal:settings:generate`](#drupalsettingsgenerate)
* [`drupal:settings:hash-salt`](#drupalsettingshash-salt)
* [`drupal:update`](#drupalupdate)
* [`drupal:update:database`](#drupalupdatedatabase)
* [`drupal:update:entities`](#drupalupdateentities)

**examples:**

* [`examples:init`](#examplesinit)

**fix:**

* [`fix:phpcbf`](#fixphpcbf)

**frontend:**

* [`frontend:build`](#frontendbuild)
* [`frontend:setup`](#frontendsetup)
* [`frontend:test`](#frontendtest)

**git:**

* [`git:commit-msg`](#gitcommit-msg)
* [`git:git-hooks`](#gitgit-hooks)
* [`git:pre-commit`](#gitpre-commit)

**setup:**

* [`setup:deploy`](#setupdeploy)
* [`setup:from-config`](#setupfrom-config)
* [`setup:from-database`](#setupfrom-database)
* [`setup:scratch`](#setupscratch)

**tests:**

* [`tests:all`](#tests)
* [`tests:security-updates`](#testssecurity-updates)

**validate:**

* [`validate:all`](#validate)
* [`validate:composer`](#validatecomposer)
* [`validate:phpcs`](#validatephpcs)
* [`validate:phpcs:files`](#validatephpcsfiles)

`frontend`
----------

Runs all frontend targets.

### Usage

* `frontend`

Runs all frontend targets.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`help`
------

Displays help for a command

### Usage

* `help [--format FORMAT] [--raw] [--] [<command_name>]`

The help command displays help for a given command:

  php ./vendor/bin/rd8 help list

You can also output the help in other formats by using the --format option:

  php ./vendor/bin/rd8 help --format=xml list

To display the list of available commands, please use the list command.

### Arguments

#### `command_name`

The command name

* Is required: no
* Is array: no
* Default: `'help'`

### Options

#### `--format`

The output format (txt, xml, json, or md)

* Accept value: yes
* Is value required: yes
* Is multiple: no
* Default: `'txt'`

#### `--raw`

To output raw command help

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`install-alias`
---------------

Installs the RD8 alias for command line usage.

### Usage

* `install-alias`

Installs the RD8 alias for command line usage.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`list`
------

Lists commands

### Usage

* `list [--raw] [--format FORMAT] [-h|--help] [-q|--quiet] [-v|vv|vvv|--verbose] [-V|--version] [--ansi] [--no-ansi] [-n|--no-interaction] [-y|--yes] [-D|--define DEFINE] [-s|--site [SITE]] [--] [<command>] [<namespace>]`

The list command lists all commands:

  php ./vendor/bin/rd8 list

You can also display the commands for a specific namespace:

  php ./vendor/bin/rd8 list test

You can also output the information in other formats by using the --format option:

  php ./vendor/bin/rd8 list --format=xml

It's also possible to get raw list of commands (useful for embedding command runner):

  php ./vendor/bin/rd8 list --raw

### Arguments

#### `namespace`

The namespace name

* Is required: no
* Is array: no
* Default: `NULL`

### Options

#### `--raw`

To output raw command list

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--format`

The output format (txt, xml, json, or md)

* Accept value: yes
* Is value required: yes
* Is multiple: no
* Default: `'txt'`

`tests`
-------

Runs all tests, including Behat, PHPUnit, and security updates check.

### Usage

* `tests`
* `tests:all`

Runs all tests, including Behat, PHPUnit, and security updates check.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`validate`
----------

Runs all code validation commands.

### Usage

* `validate`
* `validate:all`

Runs all code validation commands.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`composer:install`
------------------

Install packages.

### Usage

* `composer:install [--dev] [--source] [--format [FORMAT]]`

Install packages.

### Options

#### `--dev`

Whether package should be added to require-dev.

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--source`

Forces installation from package sources when possible, including VCS information.

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--format`

Format the result data. Available formats: csv,json,list,php,print-r,string,tsv,var_export,xml,yaml

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'yaml'`

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`composer:require`
------------------

Requires a composer package.

### Usage

* `composer:require [--dev] [--format [FORMAT]] [--] <package_name> <package_version>`

Requires a composer package.

### Arguments

#### `package_name`

* Is required: yes
* Is array: no
* Default: `NULL`

#### `package_version`

* Is required: yes
* Is array: no
* Default: `NULL`

### Options

#### `--dev`

Whether package should be added to require-dev.

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--format`

Format the result data. Available formats: csv,json,list,php,print-r,string,tsv,var_export,xml,yaml

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'yaml'`

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`composer:update`
-----------------

Update packages.

### Usage

* `composer:update [--dev] [--source] [--format [FORMAT]]`

Update packages.

### Options

#### `--dev`

Whether package should be added to require-dev.

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--source`

Forces installation from package sources when possible, including VCS information.

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--format`

Format the result data. Available formats: csv,json,list,php,print-r,string,tsv,var_export,xml,yaml

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'yaml'`

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`composer:validate`
-------------------

Validates root composer.json and composer.lock files.

### Usage

* `composer:validate`

Validates root composer.json and composer.lock files.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`config:dump`
-------------

Dumps all configuration values.

### Usage

* `config:dump`

Dumps all configuration values.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`config:export`
---------------

Export all configurations values.

### Usage

* `config:export [--file [FILE]]`

Export all configurations values.

### Options

#### `--file`

File to save dump yaml configurations.

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `''`

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`config:get`
------------

Gets the value of a config variable.

### Usage

* `config:get <key>`

Gets the value of a config variable.

### Arguments

#### `key`

The key for the configuration item to get.

* Is required: yes
* Is array: no
* Default: `NULL`

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`config:save`
-------------

Export all configurations values.

### Usage

* `config:save [--file] [--] <file_path>`

Export all configurations values.

### Arguments

#### `file_path`

* Is required: yes
* Is array: no
* Default: `NULL`

### Options

#### `--file`

File to save dump yaml configurations.

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`drupal:cache:rebuild`
----------------------

Clear cache of drupal.

### Usage

* `drupal:cache:rebuild`
* `dcc`

Clear cache of drupal.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`drupal:configuration:export`
-----------------------------

Export configuration of drupal.

### Usage

* `drupal:configuration:export [--report] [--] [<config_export>]`
* `dce`

Export configuration of drupal.

### Arguments

#### `config_export`

Destination directory_sync to save the configurations.

* Is required: no
* Is array: no
* Default: `'sync'`

### Options

#### `--report`

Print output command

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`drupal:configuration:import`
-----------------------------

Import configuration of drupal.

### Usage

* `drupal:configuration:import [--report]`
* `dci`

Import configuration of drupal.

### Options

#### `--report`

Print output command

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`drupal:core-cron`
------------------

Launch drupal core cron.

### Usage

* `drupal:core-cron`

Launch drupal core cron.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`drupal:database:drop`
----------------------

Drop tables.

### Usage

* `drupal:database:drop`

Drop tables.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`drupal:database:export`
------------------------

Export database.

### Usage

* `drupal:database:export [--directory [DIRECTORY]]`

Export database.

### Options

#### `--directory`

Where to save the dump file.

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `NULL`

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`drupal:database:import`
------------------------

Import database.

### Usage

* `drupal:database:import <dump_file>`

Import database.

### Arguments

#### `dump_file`

Path of dump file to import.

* Is required: yes
* Is array: no
* Default: `NULL`

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`drupal:extension:enable`
-------------------------

Enable module.

### Usage

* `drupal:extension:enable <module>`

Enable module.

### Arguments

#### `module`

* Is required: yes
* Is array: no
* Default: `NULL`

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`drupal:extension:uninstall`
----------------------------

Uninstall module.

### Usage

* `drupal:extension:uninstall <module>`

Uninstall module.

### Arguments

#### `module`

* Is required: yes
* Is array: no
* Default: `NULL`

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`drupal:extra:login-one-time-url`
---------------------------------

Display one-time login url.

### Usage

* `drupal:extra:login-one-time-url [--name [NAME]]`

Display one-time login url.

### Options

#### `--name`

A user name to log in as. If not provided, defaults to uid=1.

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'1'`

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`drupal:extra:maintenance-mode`
-------------------------------

Active/disable maintenance_mode in Drupal site.

### Usage

* `drupal:extra:maintenance-mode [<active>]`

Active/disable maintenance_mode in Drupal site.

### Arguments

#### `active`

* Is required: no
* Is array: no
* Default: `true`

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`drupal:filesystem:clear`
-------------------------

Clear files and folders in ./sites/[site]/*.

### Usage

* `drupal:filesystem:clear`

Clear files and folders in ./sites/[site]/*.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`drupal:filesystem:protect-site`
--------------------------------

Set correct permissions for files and folders in docroot/sites/*.

### Usage

* `drupal:filesystem:protect-site`

Set correct permissions for files and folders in docroot/sites/*.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`drupal:install-from-config`
----------------------------

Install from configuration.

### Usage

* `drupal:install-from-config`

Install from configuration.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`drupal:install-scratch`
------------------------

Install scratch Drupal.

### Usage

* `drupal:install-scratch`

Install scratch Drupal.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`drupal:locale:check`
---------------------

Checks for available translation updates.

### Usage

* `drupal:locale:check`

Checks for available translation updates.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`drupal:locale:update`
----------------------

Imports the available translation updates.

### Usage

* `drupal:locale:update`

Imports the available translation updates.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`drupal:settings`
-----------------

Generate default settings files for Drupal and drush and generate salt.txt.

### Usage

* `drupal:settings`

Generate default settings files for Drupal and drush and generate salt.txt.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`drupal:settings:generate`
--------------------------

Generates default settings files for Drupal and drush.

### Usage

* `drupal:settings:generate`

Generates default settings files for Drupal and drush.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`drupal:settings:hash-salt`
---------------------------

Writes a hash salt to ${project.root}/salt.txt if one does not exist.

### Usage

* `drupal:settings:hash-salt`

Writes a hash salt to ${project.root}/salt.txt if one does not exist.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`drupal:update`
---------------

Update drupal core and entities.

### Usage

* `drupal:update`

Update drupal core and entities.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`drupal:update:database`
------------------------

Drupal update database command.

### Usage

* `drupal:update:database [--entity-updates]`

Drupal update database command.

### Options

#### `--entity-updates`

Run automatic entity schema updates at the end of any update hooks.

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`drupal:update:entities`
------------------------

Drupal update entities command.

### Usage

* `drupal:update:entities`

Drupal update entities command.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`examples:init`
---------------

Generate example files for writing custom commands and hooks.

### Usage

* `examples:init`

Generate example files for writing custom commands and hooks.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`fix:phpcbf`
------------

Fixes and beautifies custom code according to Drupal Coding standards.

### Usage

* `fix:phpcbf [<directory>]`

Fixes and beautifies custom code according to Drupal Coding standards.

### Arguments

#### `directory`

* Is required: no
* Is array: no
* Default: `''`

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`frontend:build`
----------------

Executes frontend-build target hook.

### Usage

* `frontend:build`

Executes frontend-build target hook.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`frontend:setup`
----------------

Executes frontend-setup target hook.

### Usage

* `frontend:setup`

Executes frontend-setup target hook.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`frontend:test`
---------------

Executes frontend-test target hook.

### Usage

* `frontend:test`

Executes frontend-test target hook.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`git:commit-msg`
----------------

Validates a git commit message.

### Usage

* `git:commit-msg <message>`

Validates a git commit message.

### Arguments

#### `message`

* Is required: yes
* Is array: no
* Default: `NULL`

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`git:git-hooks`
---------------

Installs RD8 git hooks to local .git/hooks directory.

### Usage

* `git:git-hooks`

Installs RD8 git hooks to local .git/hooks directory.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`git:pre-commit`
----------------

Validates staged files.

### Usage

* `git:pre-commit [--format [FORMAT]] [--] <changed_files>`

TODO: load changed_files from git staged.
TODO: implement other validation.

### Arguments

#### `changed_files`

A list of staged files, separated by \n.

* Is required: yes
* Is array: no
* Default: `NULL`

### Options

#### `--format`

Format the result data. Available formats: csv,json,list,php,print-r,string,tsv,var_export,xml,yaml

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'yaml'`

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`setup:deploy`
--------------

Setup project and deploy the drupal site exist.

### Usage

* `setup:deploy`

Setup project and deploy the drupal site exist.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`setup:from-config`
-------------------

Setup project and install Drupal from configuration directory.

### Usage

* `setup:from-config`

Setup project and install Drupal from configuration directory.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`setup:from-database`
---------------------

Setup project and install Drupal from database.

### Usage

* `setup:from-database <database_dump> [<local>]`

Setup project and install Drupal from database.

### Arguments

#### `database_dump`

* Is required: yes
* Is array: no
* Default: `NULL`

#### `local`

* Is required: no
* Is array: no
* Default: `false`

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`setup:scratch`
---------------

Setup project and install drupal scratch from RD8 configuration.

### Usage

* `setup:scratch [<local>]`

Setup project and install drupal scratch from RD8 configuration.

### Arguments

#### `local`

* Is required: no
* Is array: no
* Default: `false`

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`tests:security-updates`
------------------------

Check local Drupal installation for security updates.

### Usage

* `tests:security-updates`

Check local Drupal installation for security updates.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`validate:composer`
-------------------

Validates root composer.json and composer.lock files.

### Usage

* `validate:composer`

Validates root composer.json and composer.lock files.

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`validate:phpcs`
----------------

Executes PHP Code Sniffer against all phpcs.filesets files.

### Usage

* `validate:phpcs [<directory>]`

By default, these include custom themes, modules, and tests.

### Arguments

#### `directory`

* Is required: no
* Is array: no
* Default: `''`

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`

`validate:phpcs:files`
----------------------

Executes PHP Code Sniffer against a list of files, if in phpcs.filesets.

### Usage

* `validate:phpcs:files <file_list>`

This command will execute PHP Codesniffer against a list of files if those
files are a subset of the phpcs.filesets filesets.

### Arguments

#### `file_list`

A list of files to scan, separated by \n.

* Is required: yes
* Is array: no
* Default: `NULL`

### Options

#### `--help|-h`

Display this help message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--quiet|-q`

Do not output any message

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--verbose|-v|-vv|-vvv`

Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--version|-V`

Display this application version

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--ansi`

Force ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-ansi`

Disable ANSI output

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--no-interaction|-n`

Do not ask any interactive question

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--yes|-y`

Answer all confirmations with "yes"

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

#### `--site|-s`

URI of the drupal site to use (only needed in multisite environments).

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'default'`
