Robo 1.2.1
==========

* [`fix-code`](#fix-code)
* [`help`](#help)
* [`list`](#list)
* [`sniff-code`](#sniff-code)
* [`update`](#selfupdate)

**create:**

* [`create:from-rd8-project`](#createfrom-rd8-project)
* [`create:from-scratch`](#createfrom-scratch)
* [`create:from-symlink`](#createfrom-symlink)

**self:**

* [`self:update`](#selfupdate)

`fix-code`
----------

Fixes RD8 internal code via PHPCBF.

### Usage

* `fix-code`

Fixes RD8 internal code via PHPCBF.

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

#### `--simulate`

Run in simulated mode (show what would have happened).

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--progress-delay`

Number of seconds before progress bar is displayed in long-running task collections. Default: 2s.

* Accept value: yes
* Is value required: yes
* Is multiple: no
* Default: `2`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

`help`
------

Displays help for a command

### Usage

* `help [--format FORMAT] [--raw] [--] [<command_name>]`

The help command displays help for a given command:

  php vendor/bin/robo help list

You can also output the help in other formats by using the --format option:

  php vendor/bin/robo help --format=xml list

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

#### `--simulate`

Run in simulated mode (show what would have happened).

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--progress-delay`

Number of seconds before progress bar is displayed in long-running task collections. Default: 2s.

* Accept value: yes
* Is value required: yes
* Is multiple: no
* Default: `2`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

`list`
------

Lists commands

### Usage

* `list [--raw] [--format FORMAT] [-h|--help] [-q|--quiet] [-v|vv|vvv|--verbose] [-V|--version] [--ansi] [--no-ansi] [-n|--no-interaction] [--simulate] [--progress-delay PROGRESS-DELAY] [-D|--define DEFINE] [--] <command> [<namespace>]`

The list command lists all commands:

  php vendor/bin/robo list

You can also display the commands for a specific namespace:

  php vendor/bin/robo list test

You can also output the information in other formats by using the --format option:

  php vendor/bin/robo list --format=xml

It's also possible to get raw list of commands (useful for embedding command runner):

  php vendor/bin/robo list --raw

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

`sniff-code`
------------

Sniffs RD8 internal code via PHPCS.

### Usage

* `sniff-code`

Sniffs RD8 internal code via PHPCS.

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

#### `--simulate`

Run in simulated mode (show what would have happened).

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--progress-delay`

Number of seconds before progress bar is displayed in long-running task collections. Default: 2s.

* Accept value: yes
* Is value required: yes
* Is multiple: no
* Default: `2`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

`create:from-rd8-project`
-------------------------

Create a new project using `composer create-project lucacracco/robo-drupal8-project'.

### Usage

* `create:from-rd8-project [--project-dir [PROJECT-DIR]]`

Create a new project using `composer create-project lucacracco/robo-drupal8-project'.

### Options

#### `--project-dir`

The directory in which the test project will be created.

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'../test-rd8'`

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

#### `--simulate`

Run in simulated mode (show what would have happened).

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--progress-delay`

Number of seconds before progress bar is displayed in long-running task collections. Default: 2s.

* Accept value: yes
* Is value required: yes
* Is multiple: no
* Default: `2`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

`create:from-scratch`
---------------------

Create a new project using `composer require lucacracco/robo-drupal8'.

### Usage

* `create:from-scratch [--project-dir [PROJECT-DIR]]`

Create a new project using `composer require lucacracco/robo-drupal8'.

### Options

#### `--project-dir`

The directory in which the test project will be created.

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'../test-rd8'`

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

#### `--simulate`

Run in simulated mode (show what would have happened).

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--progress-delay`

Number of seconds before progress bar is displayed in long-running task collections. Default: 2s.

* Accept value: yes
* Is value required: yes
* Is multiple: no
* Default: `2`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

`create:from-symlink`
---------------------

Create a new project via symlink from current checkout of robo-drupal8.

### Usage

* `create:from-symlink [--project-dir [PROJECT-DIR]]`

Local RD8 will be symlinked to project.

### Options

#### `--project-dir`

The directory in which the test project will be created.

* Accept value: yes
* Is value required: no
* Is multiple: no
* Default: `'../test-rd8'`

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

#### `--simulate`

Run in simulated mode (show what would have happened).

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--progress-delay`

Number of seconds before progress bar is displayed in long-running task collections. Default: 2s.

* Accept value: yes
* Is value required: yes
* Is multiple: no
* Default: `2`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`

`self:update`
-------------

Updates the robo.phar to the latest version.

### Usage

* `self:update`
* `update`

The self-update command checks github for newer
versions of robo and if found, installs the latest.

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

#### `--simulate`

Run in simulated mode (show what would have happened).

* Accept value: no
* Is value required: no
* Is multiple: no
* Default: `false`

#### `--progress-delay`

Number of seconds before progress bar is displayed in long-running task collections. Default: 2s.

* Accept value: yes
* Is value required: yes
* Is multiple: no
* Default: `2`

#### `--define|-D`

Define a configuration item value.

* Accept value: yes
* Is value required: yes
* Is multiple: yes
* Default: `array ()`