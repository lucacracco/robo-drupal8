## Developing RD8 locally

Clone project and also created a RD8-ed project for testing your changes.

Use the following commands to create a testable RD8-created project alongside RD8

```
composer install --working-dir=robo-drupal8
mkdir test
cp robo-drupal8/rd8-project/composer.json test/
cd test
git init
composer install
```

The new `rd8-project` directory will have a composer dependency on your local clone of RD8 via a `../rd8` symlink. 
You can therefore make changes to files in `rd8` and see them immediately reflected in `rd8-project/vendor/lucacracco/robo-drupal8`.
