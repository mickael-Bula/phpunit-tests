# Suivi d'un tuto Openclassrooms consacré aux tests dans Symfony

Pour suivre ce tutoriel, j'ai installé un projet Symfony vierge comme ceci :

```bash
$ symfony new unit_test_project --webapp  # installation d'un projet Symfony complet
$ cd unit_test_project\
$ composer require --dev symfony/test-pack  # ajoute la librairie phpunit
$ php bin/phpunit # pour vérifier que phpunit est bien installé et lancer les tests
$ php vendor/bin/phpunit  # une autre manière de lancer les tests
$ phpstorm64.exe .  # ouverture du projet dans PhpStorm
```

## Couverture de test

Pour faire de la couverture de test, il est nécessaire d'ajouter une ligne au php.ini utilisé.
Pour connaître la version utilisée :

```bash
$ php --ini
```

Dans ce fichier, il faut ajouter la ligne suivante, sous xdebug :

```ìni
xdebug.mode=coverage
```

Ensuite, pour générer un rapport, il faut lancer les tests avec cette commande :

```bash
$ php bin/phpunit --coverage-html public/test-coverage
```

Le rapport est alors disponible sous `public/test-coverage` et consultable dans le navigateur à l'adresse http://localhost/phpunit/unit_test_project/public/test-coverage/
Depuis cette page, il est ensuite possible de naviguer pour découvrir le taux de couverture des différentes classes et méthodes.

