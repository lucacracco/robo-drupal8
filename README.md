Robo Drupal8 Builder
====================

(@todo: translate text)

Questo repository contiene una libreria dedicata all'inizializzazione,
alla costruzione, gestione e mantenimento di progetti
[Drupal8](https://www.drupal.org/) attraverso l'utilizzo di
[Robo](http://robo.li/).

La libreria nasce dallo studio e analisi della libreria creata
da [Acquia BLT](https://github.com/acquia/blt) presa come riferimento
per la gestione base e l'interfacciamento con Robo e adattata e
ridimensionata per i progetti che utilizzo.

Se cercate una libreria completa, mantenuta e affidabile, possibilmente
con integrazione con provider quali Acquia Cloud o Pantheon vi invito
ad utilizzare [Acquia BLT](https://github.com/acquia/blt).


### Workflow & Commands

Usa `vendor/bin/rd8 list` per visualizzare tutti i commandi presenti e
caricati.

Se vuoi qualche dettaglio in più sui comandi, hooks, ecc.. implementati
puoi leggerti la documentazione sui [Commandi](./documentation/commands.md).


#### Validate

* **validateGitRootIsPresent**
    validate git root is present
* **@validateDrushConfig**
    validate drush configuration
* **@validateMySqlAvailable**
    validate mysql available
* **@validateMySqlConnection**
    validate mysql connection
* **@validateDocrootIsPresent**
    validate docroot is present
* **@validateDrupalIsInstalled**
    validate Drupal is installed
* **@validateConfigSyncDirIsPresent**
    validate config sync dir is present
* **@validateSettingsFilesPresent**
    validate settings file present
* **@validateSettingsFileIsValid**
    validate settings file is valid (required extension settings)
* **@validateModuleIsEnabled**
    validate if module is enabled


#### Interact

* **@interactInstallDrupal**
    install drupal
* **@interactGenerateSettingsFiles**
    generate settings files
* **@interactConfigIdentical**
    check the configuration is identical from database to filesystem
* **@interactInstallModuleRequired**
    install module required
* **@interactMySqlConnection**
    required the database connection


### Developing RD8 locally

Clone project and download the dependencies library with composer.

After use Robo Commands for create a environment to develop project.

| Command                   | Description                                                                           |
| ------------------------- | ------------------------------------------------------------------------------------- |
| `create:from-rd8-project` | Create a new project using `composer create-project lucacracco/robo-drupal8-project`. |
| `create:from-scratch`     | Create a new project using `composer require lucacracco/robo-drupal8`.                |
| `create:from-symlink`     | Create a new project via symlink from current checkout of robo-drupal8.               |


### ISSUES

* DrupalFinder not found the drupal root in
\Lucacracco\RoboDrupal8\Composer::createRequiredFiles() if not
found 'installer-paths' in 'composer.json'
