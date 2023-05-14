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

## Lancer un test particulier

Plutôt que de nacer la totalité des tests, il est possible d'en préciser un avec l'option --filter :

```bash
$ php bin/phpunit --filter=testcomputeTVAFoodProduct
```

## Utiliser un dataProvider

Pour tester une même méthode avec des valeurs en entrée différentes, sans avoir à créer une méthode de test différente, on peut utiliser un dataProvider.
Celui-ci doit être déclaré comme annotation de la méthode de test et défini dans une méthode propre qui retourne un tableau de tableaux.
Les valeurs de ces derniers seront transmises comme paramètres de la méthode recevant le dataProvider.

## Test d'une méthode contenant un appel à une méthode statique

Ceci est un cas utile, sachant que si le test d'une méthode statique n'est pas en soit impossible, celui du résultat d'un tel appel n'est pas si simple.
Pour surmonter la difficulté, j'utilise ici la librairie Mockery. Celle-ci crée des alias de la classe contenant les méthodes statiques pour les transformer en classe une Standard (\Std_class).
Le test est fait sur la classe PaymentController, qui a été ajoutée dans ce seul but et n'est qu'une ébauche et un prétexte pour le test.