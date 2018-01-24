# Commands

### List

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