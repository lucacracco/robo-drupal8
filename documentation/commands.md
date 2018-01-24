# Commands

## List

### Composer

**composer:install**
- install composer dependecies

**composer:update**
- update composer dependecies

**composer:require**
- require library

### Git

### Alias

Installa alias for use tool RoboDrupal8.

### Docker (for 3.x version?)

Initialization, update or stop docker containers.

### Setup

**setup:build**

Build the project.

- install Drupal from configuration
- install git hooks

### Fix code

**fix:phpcbf**

Fix the coding standard in the code changed.

### Frontend

Commands to build, test the front-end theme.

**frontend:setup**

Initialization the theme.

**frontend:build**

Build or rebuild the theme.

**frontend:validate**

Validate the theme.

### Test (for version 3.x?)

Run test for code changed.

### Drupal

**drupal:install-scratch**

Validate:
- @validateMySqlAvailable
- @validateDocrootIsPresent

Interact:
- @interactMySqlConnection

Process:
- @composer:install
- @drupal:install-scratch
- @drupal:settings
- @drupal:update
- @drupal:protect-site
- @drupal:core-cron
- @drupal:one-time-login

**drupal:install-from-config**

Validate:
- @validateMySqlAvailable
- @validateMySqlConnection
- @validateDocrootIsPresent

Interact:
- @interactMySqlConnection

Process:
- @composer:install
- @drupal:settings
- @drupal:config-installer
- @drupal:update
- @drupal:protect-site
- @drupal:core-cron
- @drupal:one-time-login

**drupal:deploy**

Validate:
- @validateMySqlAvailable
- @validateMySqlConnection
- @validateDrupalIsInstalled
- @validateConfigSyncDirIsPresent

Process:
- @composer:install
- @drupal:update
- @drupal:configuration-import
- @drupal:entity-updates
- @drupal:core-cron

**drupal:configuration-import**

Validate:
- @validateConfigSyncDirIsPresent
- @validateDrupalIsInstalled

Process:
- import configuration from sync dir
- @drupal:cache-rebuild

**drupal:configuration-export**

Validate:
- @validateConfigSyncDirIsPresent
- @validateDrupalIsInstalled

Process:
- export configuration from to sync dir
- @drupal:cache-rebuild

**drupal:update**

TODO.

**drupal:protect-site**

TODO.

**drupal:one-time-login**

Validate:
- @validateDrupalIsInstalled

Process:
- recovery onetime-login for user

