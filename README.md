# PHP 7.4 Slim 4 Boilerplate

Everything is installed and configure to start a simple Web project using PHP 7.4 :

* PHP 7.4
* Slim 4.x micro-framework
* Dependency-injection
* PSR7
* Twig templating system

## Installation

```
git clone https://github.com/yannlr37/php-slim-boilerplate.git myproject
cd myproject/
composer install
php -S localhost:8000
```

## Organisation

* Le dossier **db/** est nécessaires aux migrations/seeds PHINX.
* le docciser **logs/** contient les fichiers de log journaliers
* le dossier **cache/** contient le sfichiers cachés (twig et autres)
* le dossier **resources/** contient les vues et autres resources Front
* le dossier **public/** est le point d'entrée de l'application. Il contient les éléments accessibles depuis l'extérieur. [A VENIR]
* le dossier **api/** ets l'équivalent du dossier public/ mais pour l'API [A VENIR]
* le dossier **src/** contient les sources, le coeur de l'application
* la configuration se trouve dans le dossier **config/** [A VENIR]

Les entités (Entity) sont de sclasses ayant un pendant en base de données.
Les modèles (Model) sont des classes n'ayant pas d'équivalent en base de données.
Seuls les dossiers **Entity**, **COntrollers**, **Repository** et **Services** devraient être touchés.

Dans le dossier **config/** : 
* **definitions.php** permet de définir les classes et leurs dépendances
* **settings.php** contient la configuration générale de l'application (path, constantes, paramètres généraux). Tout ce qui ne bougera pas d'un environnement à un autre.
* **routes.php** contient la déclaration des routes
* **helpers.php** définit les fonctions générales utilisées à travers l'application

## Outils

### PHINX

Phinx permet de gérer les migrations et les seeds en base de données.

```
# Create new migration
php vendor/bin/phinx create MyMigrationName

# Play migrations
php vendor/bin/phinx migrate (--dry-run) (-e development)

# Play one migration in particular (one from 2031-01-31 14:08:32)
php vendor/bin/phinx migrate -t 20230131140832 (--dry-run) (-e development)

# Rollback last migration
php vendor/bin/phinx rollback (-e development)

# Rollback all migrations
php vendor/bin/phinx rollback -t 0 (-e development)

# Rollback on migration in particular
php vendor/bin/phinx rollback -t 20230131140832 (-e development)

# Test rollbacks
php vendor/bin/phinx rollback (options) --dry-run
```


Utiliser les seeds pour alimenter les données.

```
# Create new seeds
php vendor/bin/phinx seed:create MySeeder

# Run seeds
php vendor/bin/phinx seed:run (-e development)

# Run on see din particular
php vendor/bin/phinx seed:run -s MySeeder (-e development)
```