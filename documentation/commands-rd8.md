RoboDrupal8
===========

* dcc
* dce
* dci
* frontend
* help
* install-alias
* list
* sci
* setup
* su
* tests
* validate

**composer:**

* composer:install
* composer:require
* composer:update
* composer:validate

**config:**

* config:dump
* config:export
* config:get
* config:save

**drupal:**

* drupal:cache:rebuild
* drupal:configuration:export
* drupal:configuration:import
* drupal:core-cron
* drupal:database:drop
* drupal:database:export
* drupal:database:import
* drupal:extension:enable
* drupal:extension:uninstall
* drupal:extra:login-one-time-url
* drupal:extra:maintenance-mode
* drupal:filesystem:protect-site
* drupal:install-from-config
* drupal:install-scratch
* drupal:locale:check
* drupal:locale:update
* drupal:settings
* drupal:settings:generate
* drupal:settings:hash-salt
* drupal:update
* drupal:update:database
* drupal:update:entities

**examples:**

* examples:init

**fix:**

* fix:phpcbf

**frontend:**

* frontend:build
* frontend:setup
* frontend:test

**git:**

* git:commit-msg
* git:pre-commit

**setup:**

* setup:all
* setup:build
* setup:build:composer:install
* setup:build:install
* setup:config-import
* setup:config:update
* setup:git-hooks
* setup:import:import

**tests:**

* tests:all
* tests:security-updates

**validate:**

* validate:all
* validate:composer
* validate:phpcs
* validate:phpcs:files

frontend
--------

* Description: Runs all frontend targets.
* Usage:

  * `frontend`

Runs all frontend targets.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

help
----

* Description: Displays help for a command
* Usage:

  * `help [--format FORMAT] [--raw] [--] [<command_name>]`

The <info>help</info> command displays help for a given command:

  <info>php vendor/bin/rd8 help list</info>

You can also output the help in other formats by using the <comment>--format</comment> option:

  <info>php vendor/bin/rd8 help --format=xml list</info>

To display the list of available commands, please use the <info>list</info> command.

### Arguments:

**command_name:**

* Name: command_name
* Is required: no
* Is array: no
* Description: The command name
* Default: `'help'`

### Options:

**format:**

* Name: `--format`
* Shortcut: <none>
* Accept value: yes
* Is value required: yes
* Is multiple: no
* Description: The output format (txt, xml, json, or md)
* Default: `'txt'`

**raw:**

* Name: `--raw`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: To output raw command help
* Default: `false`

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

install-alias
-------------

* Description: Installs the RD8 alias for command line usage.
* Usage:

  * `install-alias`

Installs the RD8 alias for command line usage.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

list
----

* Description: Lists commands
* Usage:

  * `list [--raw] [--format FORMAT] [-h|--help] [-q|--quiet] [-v|vv|vvv|--verbose] [-V|--version] [--ansi] [--no-ansi] [-n|--no-interaction] [-y|--yes] [-D|--define DEFINE] [-s|--site [SITE]] [--] <command> [<namespace>]`

The <info>list</info> command lists all commands:

  <info>php vendor/bin/rd8 list</info>

You can also display the commands for a specific namespace:

  <info>php vendor/bin/rd8 list test</info>

You can also output the information in other formats by using the <comment>--format</comment> option:

  <info>php vendor/bin/rd8 list --format=xml</info>

It's also possible to get raw list of commands (useful for embedding command runner):

  <info>php vendor/bin/rd8 list --raw</info>

### Arguments:

**namespace:**

* Name: namespace
* Is required: no
* Is array: no
* Description: The namespace name
* Default: `NULL`

### Options:

**raw:**

* Name: `--raw`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: To output raw command list
* Default: `false`

**format:**

* Name: `--format`
* Shortcut: <none>
* Accept value: yes
* Is value required: yes
* Is multiple: no
* Description: The output format (txt, xml, json, or md)
* Default: `'txt'`

setup
-----

* Description: Install dependencies, builds docroot, installs Drupal.
* Usage:

  * `setup`
  * `setup:all`

Install dependencies, builds docroot, installs Drupal.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

tests
-----

* Description: Runs all tests, including Behat, PHPUnit, and security updates check.
* Usage:

  * `tests`
  * `tests:all`

Runs all tests, including Behat, PHPUnit, and security updates check.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

validate
--------

* Description: Runs all code validation commands.
* Usage:

  * `validate`
  * `validate:all`

Runs all code validation commands.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

composer:install
----------------

* Description: Install packages.
* Usage:

  * `composer:install [--dev] [--source] [--format FORMAT]`

Install packages.

### Options:

**dev:**

* Name: `--dev`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Whether package should be added to require-dev.
* Default: `false`

**source:**

* Name: `--source`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Forces installation from package sources when possible, including VCS information.
* Default: `false`

**format:**

* Name: `--format`
* Shortcut: <none>
* Accept value: yes
* Is value required: yes
* Is multiple: no
* Description: Format the result data. Available formats: csv,json,list,php,print-r,string,tsv,var_export,xml,yaml
* Default: `'yaml'`

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

composer:require
----------------

* Description: Requires a composer package.
* Usage:

  * `composer:require [--dev] [--format FORMAT] [--] <package_name> <package_version>`

Requires a composer package.

### Arguments:

**package_name:**

* Name: package_name
* Is required: yes
* Is array: no
* Description: <none>
* Default: `NULL`

**package_version:**

* Name: package_version
* Is required: yes
* Is array: no
* Description: <none>
* Default: `NULL`

### Options:

**dev:**

* Name: `--dev`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Whether package should be added to require-dev.
* Default: `false`

**format:**

* Name: `--format`
* Shortcut: <none>
* Accept value: yes
* Is value required: yes
* Is multiple: no
* Description: Format the result data. Available formats: csv,json,list,php,print-r,string,tsv,var_export,xml,yaml
* Default: `'yaml'`

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

composer:update
---------------

* Description: Update packages.
* Usage:

  * `composer:update [--dev] [--source] [--format FORMAT]`

Update packages.

### Options:

**dev:**

* Name: `--dev`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Whether package should be added to require-dev.
* Default: `false`

**source:**

* Name: `--source`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Forces installation from package sources when possible, including VCS information.
* Default: `false`

**format:**

* Name: `--format`
* Shortcut: <none>
* Accept value: yes
* Is value required: yes
* Is multiple: no
* Description: Format the result data. Available formats: csv,json,list,php,print-r,string,tsv,var_export,xml,yaml
* Default: `'yaml'`

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

composer:validate
-----------------

* Description: Validates root composer.json and composer.lock files.
* Usage:

  * `composer:validate`

Validates root composer.json and composer.lock files.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

config:dump
-----------

* Description: Dumps all configuration values.
* Usage:

  * `config:dump`

Dumps all configuration values.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

config:export
-------------

* Description: Export all configurations values.
* Usage:

  * `config:export [--file [FILE]]`

Export all configurations values.

### Options:

**file:**

* Name: `--file`
* Shortcut: <none>
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: File to save dump yaml configurations.
* Default: `''`

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

config:get
----------

* Description: Gets the value of a config variable.
* Usage:

  * `config:get <key>`

Gets the value of a config variable.

### Arguments:

**key:**

* Name: key
* Is required: yes
* Is array: no
* Description: The key for the configuration item to get.
* Default: `NULL`

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

config:save
-----------

* Description: Export all configurations values.
* Usage:

  * `config:save [--file] [--] <file_path>`

Export all configurations values.

### Arguments:

**file_path:**

* Name: file_path
* Is required: yes
* Is array: no
* Description: <none>
* Default: `NULL`

### Options:

**file:**

* Name: `--file`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: File to save dump yaml configurations.
* Default: `false`

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

drupal:cache:rebuild
--------------------

* Description: Clear cache of drupal.
* Usage:

  * `drupal:cache:rebuild`
  * `dcc`

Clear cache of drupal.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

drupal:configuration:export
---------------------------

* Description: Export configuration of drupal.
* Usage:

  * `drupal:configuration:export [--report] [--] [<destination>]`
  * `dce`

Export configuration of drupal.

### Arguments:

**destination:**

* Name: destination
* Is required: no
* Is array: no
* Description: Destination directory_sync to save the configurations.
* Default: `'sync'`

### Options:

**report:**

* Name: `--report`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Print output command
* Default: `false`

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

drupal:configuration:import
---------------------------

* Description: Import configuration of drupal.
* Usage:

  * `drupal:configuration:import [--report]`
  * `dci`

Import configuration of drupal.

### Options:

**report:**

* Name: `--report`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Print output command
* Default: `false`

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

drupal:core-cron
----------------

* Description: Launch drupal core cron.
* Usage:

  * `drupal:core-cron`

Launch drupal core cron.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

drupal:database:drop
--------------------

* Description: Drop tables.
* Usage:

  * `drupal:database:drop`

Drop tables.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

drupal:database:export
----------------------

* Description: Export database.
* Usage:

  * `drupal:database:export [--directory [DIRECTORY]]`

Export database.

### Options:

**directory:**

* Name: `--directory`
* Shortcut: <none>
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: Where to save the dump file.
* Default: `NULL`

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

drupal:database:import
----------------------

* Description: Import database.
* Usage:

  * `drupal:database:import <dump_file>`

Import database.

### Arguments:

**dump_file:**

* Name: dump_file
* Is required: yes
* Is array: no
* Description: Path of dump file to import.
* Default: `NULL`

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

drupal:extension:enable
-----------------------

* Description: Enable module.
* Usage:

  * `drupal:extension:enable <module>`

Enable module.

### Arguments:

**module:**

* Name: module
* Is required: yes
* Is array: no
* Description: <none>
* Default: `NULL`

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

drupal:extension:uninstall
--------------------------

* Description: Uninstall module.
* Usage:

  * `drupal:extension:uninstall <module>`

Uninstall module.

### Arguments:

**module:**

* Name: module
* Is required: yes
* Is array: no
* Description: <none>
* Default: `NULL`

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

drupal:extra:login-one-time-url
-------------------------------

* Description: Display one-time login url.
* Usage:

  * `drupal:extra:login-one-time-url [--name [NAME]]`

Display one-time login url.

### Options:

**name:**

* Name: `--name`
* Shortcut: <none>
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: A user name to log in as. If not provided, defaults to uid=1.
* Default: `'1'`

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

drupal:extra:maintenance-mode
-----------------------------

* Description: Active/disable maintenance_mode in Drupal site.
* Usage:

  * `drupal:extra:maintenance-mode [<active>]`

Active/disable maintenance_mode in Drupal site.

### Arguments:

**active:**

* Name: active
* Is required: no
* Is array: no
* Description: <none>
* Default: `true`

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

drupal:filesystem:protect-site
------------------------------

* Description: Set correct permissions for files and folders in docroot/sites/*.
* Usage:

  * `drupal:filesystem:protect-site`

Set correct permissions for files and folders in docroot/sites/*.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

drupal:install-from-config
--------------------------

* Description: Install from configuration.
* Usage:

  * `drupal:install-from-config`

Install from configuration.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

drupal:install-scratch
----------------------

* Description: Install scratch Drupal.
* Usage:

  * `drupal:install-scratch`

Install scratch Drupal.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

drupal:locale:check
-------------------

* Description: Checks for available translation updates.
* Usage:

  * `drupal:locale:check`

Checks for available translation updates.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

drupal:locale:update
--------------------

* Description: Imports the available translation updates.
* Usage:

  * `drupal:locale:update`

Imports the available translation updates.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

drupal:settings
---------------

* Description: Generate default settinsg files for Drupal and drush and generate salt.txt.
* Usage:

  * `drupal:settings`

Generate default settinsg files for Drupal and drush and generate salt.txt.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

drupal:settings:generate
------------------------

* Description: Generates default settings files for Drupal and drush.
* Usage:

  * `drupal:settings:generate`

Generates default settings files for Drupal and drush.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

drupal:settings:hash-salt
-------------------------

* Description: Writes a hash salt to ${project.root}/salt.txt if one does not exist.
* Usage:

  * `drupal:settings:hash-salt`

Writes a hash salt to ${project.root}/salt.txt if one does not exist.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

drupal:update
-------------

* Description: Update drupal core and entities.
* Usage:

  * `drupal:update`

Update drupal core and entities.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

drupal:update:database
----------------------

* Description: Drupal update database command.
* Usage:

  * `drupal:update:database [--entity-updates]`

Drupal update database command.

### Options:

**entity-updates:**

* Name: `--entity-updates`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Run automatic entity schema updates at the end of any update hooks.
* Default: `false`

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

drupal:update:entities
----------------------

* Description: Drupal update entities command.
* Usage:

  * `drupal:update:entities`

Drupal update entities command.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

examples:init
-------------

* Description: Generate example files for writing custom commands and hooks.
* Usage:

  * `examples:init`

Generate example files for writing custom commands and hooks.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

fix:phpcbf
----------

* Description: Fixes and beautifies custom code according to Drupal Coding standards.
* Usage:

  * `fix:phpcbf [<directory>]`

Fixes and beautifies custom code according to Drupal Coding standards.

### Arguments:

**directory:**

* Name: directory
* Is required: no
* Is array: no
* Description: <none>
* Default: `''`

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

frontend:build
--------------

* Description: Executes frontend-build target hook.
* Usage:

  * `frontend:build`

Executes frontend-build target hook.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

frontend:setup
--------------

* Description: Executes frontend-setup target hook.
* Usage:

  * `frontend:setup`

Executes frontend-setup target hook.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

frontend:test
-------------

* Description: Executes frontend-test target hook.
* Usage:

  * `frontend:test`

Executes frontend-test target hook.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

git:commit-msg
--------------

* Description: Validates a git commit message.
* Usage:

  * `git:commit-msg <message>`

Validates a git commit message.

### Arguments:

**message:**

* Name: message
* Is required: yes
* Is array: no
* Description: <none>
* Default: `NULL`

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

git:pre-commit
--------------

* Description: Validates staged files.
* Usage:

  * `git:pre-commit [--format FORMAT] [--] <changed_files>`

TODO: load changed_files from git staged.
TODO: implement other validation.

### Arguments:

**changed_files:**

* Name: changed_files
* Is required: yes
* Is array: no
* Description: A list of staged files, separated by \n.
* Default: `NULL`

### Options:

**format:**

* Name: `--format`
* Shortcut: <none>
* Accept value: yes
* Is value required: yes
* Is multiple: no
* Description: Format the result data. Available formats: csv,json,list,php,print-r,string,tsv,var_export,xml,yaml
* Default: `'yaml'`

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

setup:build
-----------

* Description: Generates all required files for a full build.
* Usage:

  * `setup:build`

//interactConfigIdentical

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

setup:build:composer:install
----------------------------

* Description: Installs Composer dependencies.
* Usage:

  * `setup:build:composer:install`

Installs Composer dependencies.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

setup:build:install
-------------------

* Description: Installs Drupal and sets correct file/directory permissions.
* Usage:

  * `setup:build:install`

Installs Drupal and sets correct file/directory permissions.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

setup:config-import
-------------------

* Description: Imports configuration from the config directory.
* Usage:

  * `setup:config-import`
  * `sci`

Imports configuration from the config directory.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

setup:config:update
-------------------

* Description: Update current database to reflect the state of the Drupal file system.
* Usage:

  * `setup:config:update`
  * `su`

Update current database to reflect the state of the Drupal file system.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

setup:git-hooks
---------------

* Description: Installs RD8 git hooks to local .git/hooks directory.
* Usage:

  * `setup:git-hooks`

Installs RD8 git hooks to local .git/hooks directory.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

setup:import:import
-------------------

* Description: Imports a .sql file into the Drupal database.
* Usage:

  * `setup:import:import <dump_file>`

Imports a .sql file into the Drupal database.

### Arguments:

**dump_file:**

* Name: dump_file
* Is required: yes
* Is array: no
* Description: <none>
* Default: `NULL`

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

tests:security-updates
----------------------

* Description: Check local Drupal installation for security updates.
* Usage:

  * `tests:security-updates`

Check local Drupal installation for security updates.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

validate:composer
-----------------

* Description: Validates root composer.json and composer.lock files.
* Usage:

  * `validate:composer`

Validates root composer.json and composer.lock files.

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

validate:phpcs
--------------

* Description: Executes PHP Code Sniffer against all phpcs.filesets files.
* Usage:

  * `validate:phpcs [<directory>]`

By default, these include custom themes, modules, and tests.

### Arguments:

**directory:**

* Name: directory
* Is required: no
* Is array: no
* Description: <none>
* Default: `''`

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`

validate:phpcs:files
--------------------

* Description: Executes PHP Code Sniffer against a list of files, if in phpcs.filesets.
* Usage:

  * `validate:phpcs:files <file_list>`

This command will execute PHP Codesniffer against a list of files if those
files are a subset of the phpcs.filesets filesets.

### Arguments:

**file_list:**

* Name: file_list
* Is required: yes
* Is array: no
* Description: A list of files to scan, separated by \n.
* Default: `NULL`

### Options:

**help:**

* Name: `--help`
* Shortcut: `-h`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this help message
* Default: `false`

**quiet:**

* Name: `--quiet`
* Shortcut: `-q`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not output any message
* Default: `false`

**verbose:**

* Name: `--verbose`
* Shortcut: `-v|-vv|-vvv`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
* Default: `false`

**version:**

* Name: `--version`
* Shortcut: `-V`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Display this application version
* Default: `false`

**ansi:**

* Name: `--ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Force ANSI output
* Default: `false`

**no-ansi:**

* Name: `--no-ansi`
* Shortcut: <none>
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Disable ANSI output
* Default: `false`

**no-interaction:**

* Name: `--no-interaction`
* Shortcut: `-n`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Do not ask any interactive question
* Default: `false`

**yes:**

* Name: `--yes`
* Shortcut: `-y`
* Accept value: no
* Is value required: no
* Is multiple: no
* Description: Answer all confirmations with "yes"
* Default: `false`

**define:**

* Name: `--define`
* Shortcut: `-D`
* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Description: Define a configuration item value.
* Default: `array ()`

**site:**

* Name: `--site`
* Shortcut: `-s`
* Accept value: yes
* Is value required: no
* Is multiple: no
* Description: URI of the drupal site to use (only needed in multisite environments).
* Default: `'default'`
