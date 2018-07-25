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

### Commands

Use `vendor/bin/rd8 list` for see all commands.

### Developing RD8 locally

Clone project and download the dependencies library with composer.

After use Robo Commands for create a environment to develop project.

| Command                               | Description                                                                           |
| ------------------------------------- | ------------------------------------------------------------------------------------- |
| `create:with-drupal-composer-project` | Create a new project using `drupal-composer/drupal-project:8.x-dev'.                  |
| `create:from-symlink`                 | Create a new project via symlink from current checkout of robo-drupal8.               |
