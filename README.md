# Symfony Redis OM Demo

Projet de démonstration pour la librairie [php-redis-om](https://github.com/clementtalleu/php-redis-om), un Object Mapper Redis pour PHP.

## ✨ Demo Features

- **Full CRUD** : Management of Books, Users, and Categories
- **Advanced Search** : Filters and sort data
- **Nesting & Relations** : Handing complew object and relations via RedisJSON
- **Admin Interface** : Complete back-office under /adùin using Symfony Forms
- **Developer Experience** : Seamless integratrion with the RedisObjectManager

## Stack technique

- **PHP 8.4** (FrankenPHP)
- **Symfony 7.4**
- **Redis Stack** (Redis + RediSearch + RedisJSON)
- **php-redis-om** (talleu/php-redis-om)

## Installation & Setup

### 1. Spin up the infrastructure

The demo uses docker to streamline the PHP and Redis Stack installation

```bash
docker compose up -d --build
```

### 2. Access the services

- Web-App : https://localhost (certificat auto-signé)
- RedisInsight : http://localhost:8001

### 3. Library Initialization

If you are starting fresh or updating the library : 

```bash
#If you are outside of the container

# Install the development version
docker compose exec php composer require talleu/php-redis-om:dev-main

# Generate Redis indexes (Migration)
docker compose exec php bin/console redis-om:migrate

#----------------------------------------------------#

# If you are inside of the container

# Install the development version
composer require talleu/php-redis-om:dev-main

# Generate Redis indexes (Migration)
bin/console redis-om:migrate
```
Depending on your configuration, use phpredis or Predis

### Setup initial

- [X] Installer `talleu/php-redis-om` via Composer
- [X] Installer Twig (`symfony/twig-bundle`)
- [X] Installer le formulaire Symfony (`symfony/form`, `symfony/validator`)
- [X] Enregistrer le bundle dans `config/bundles.php` : `Talleu\RedisOm\Bundle\TalleuRedisOmBundle::class => ['all' => true]`
- [X] Configurer la connexion Redis (env `REDIS_URL`)

### Entités Redis

- [X] Créer une entité `Book` (id, title, author (qui est un User), enabled, category, description, publishedAt, price)
- [X] Créer une entité `Category` (id, title)
- [X] Créer une entité `User` (id, name, email, age, createdAt)
- [X] Créer une entité `Comment` (id, author, book, content, createdAt)
- [X] Vérifier le mapping avec les attributs `#[RedisOm\Entity]`, `#[RedisOm\Id]`, `#[RedisOm\Property]`
- [X] Indexer les champs pertinents pour la recherche (`index: true`)
- [X] Lancer la migration : `bin/console redis-om:migrate`

### Formulaires & Controllers

- [X] Créer un `BookController` avec CRUD complet (list, create, show, edit, delete)
- [X] Créer un `UserController` avec CRUD complet
- [X] Créer un `CategoryController` avec CRUD complet
- [X] Créer les `FormType` associés (BookType, UserType, CategoryType)
- [X] Toute la partie CRUD préfixée par /admin
- [X] Créer une page "vue des ouvrages" qui affiche les livres activés
- [X] Créer des filters
- [X] Faire la page "détail d'un ouvrage"
- [X] Afficher les commentaires
- [X] Permettre de poster un nouveau commentaire
- [X] Gérer la validation des formulaires

### Templates & UI

- [X] Créer un layout de base (`base.html.twig`) avec navigation
- [X] Templates de listing pour chaque entité
- [X] Templates de formulaire (create/edit)
- [X] Template de détail (show)
- [X] Messages flash pour les actions (create, update, delete)

### Fonctionnalités de recherche

- [X] Implémenter `findAll()` pour chaque entité
- [X] Implémenter `findBy()` avec critères de recherche
- [X] Implémenter `findOneBy()` 
- [X] Ajouter un formulaire de recherche/filtre sur lesw listings
- [X] Tester le tri (`orderBy`) sur les collections

### Fonctionnalités avancées

- [X] Tester le support RedisJSON (stocker des objets imbriqués)
- [X] Tester l'auto-expiration (TTL sur les entités)
- [X] Tester les types avancés (DateTimeImmutable, arrays, nested objects)
- [X] Créer une page dashboard avec des stats (nombre d'objets par entité)

### Tests & Validation

- [X] Vérifier que les objets sont bien persistés dans Redis
- [X] Vérifier la recherche par critères
- [X] Vérifier le tri et la pagination
- [X] Vérifier la suppression
- [X] Vérifier via RedisInsight que les données sont correctes

### Préparation V1

- [ ] Documenter les fonctionnalités testées et leur statut
- [ ] Identifier les éventuels bugs ou limitations
- [ ] Mettre à jour `php-redis-om` vers la V1 quand disponible
- [ ] Relancer les tests pour vérifier la rétrocompatibilité
- [ ] Documenter les breaking changes éventuels
