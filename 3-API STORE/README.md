# Gestion de magasins (WSHOP)

WSHOP est un micro-framework PHP permettant de gérer des magasins via une API REST. Il utilise PHP 8.4 et s'appuie sur certains composants standalone de Symfony (variables d'environnement, gestion des requêtes HTTP, routing, injection de dépendances).


## Table des Matières

- [Prérequis](#pr%C3%A9requis)
- [Installation](#installation)
- [Architecture du Projet](#architecture-du-projet)
- [Utilisation](#utilisation)
- [Endpoints Disponibles](#endpoints-disponibles)
- [Technologies Utilisées](#technologies-utilis%C3%A9es)
- [Commandes Utiles](#commandes-utiles)

---

## Prérequis

- **Docker** et **Docker Compose** installés
- **Make** installé

## Installation

Clonez le dépôt et accédez au dossier du projet :

```sh
  git clone git@github.com:jobs-ashad-khan/wshop-test.git
  cd 3-API\ STORE/
```

Créez un fichier `.env.local` à la racine et surchargez-le avec vos variables d'environnement si nécessaire

Démarrez les services Docker :

```sh
  make up
```

Installez les dépendances du projet :

```sh
  make install
```

L'application est maintenant prête à l'emploi !

## Architecture du Projet

```
docker/
    apache/
        vhost.conf
    db/
        mysql/
            1-init_db.sql
            2-insert_store.sql
    php/
        php.ini
    Dockerfile
wshop-api-store/
    config/
        bootstrap.php
        services.php
    public/
        index.php
    src/
        Controller/
            StoreController.php
        Exception/
            ApiInvalidDataException.php
            ApiNotFoundException.php
        Infrastructure/
            Database/
                DatabaseConnectionManager.php
                DatabaseConnectionInterface.php
                PDODatabaseConnection.php
            Framework/
                Attribute/
                    Route.php
                DependencyInjection/
                    ContainerFactory.php
                Rooting/
                    AttributeRouteLoader.php
                    ControllerScanner.php
        Repository/
            StoreRepository.php
            StoreRepositoryInterface.php
        Service/
            StoreService.php
        Kernel.php
docker-compose.yml
.env
Makefile
```

## Utilisation

- **API Store** accessible sur `http://localhost:8000`

## Endpoints Disponibles

| Méthode | Endpoint        | Description                                  | Paramètres                                   |
|---------|-----------------|----------------------------------------------|----------------------------------------------|
| GET     | `/stores`        | Récupérer la liste des magasins             | Query params filters, sorts, limit et offset |
| GET     | `/stores/{id}`   | Récupérer un magasin par son ID             | id : identifiant du magasin                  |
| POST    | `/stores`        | Créer un nouveau magasin                    | Body JSON                                    |
| PUT     | `/stores/{id}`   | Mettre à jour un magasin (remplacement total)| id + Body JSON                               |
| PATCH   | `/stores/{id}`   | Mettre à jour partiellement un magasin      | id + Body JSON                               |
| DELETE  | `/stores/{id}`   | Supprimer un magasin                        | id                                           |

### Exemple de récupération de magasins avec filtre et tri

```
http://localhost:8000/stores?filters[city]=Paris&filters[name]=Auch&sorts[id]=DESC&limit=5&offset=1
```

## Technologies Utilisées

- **Backend** : PHP 8.4
- **Composants Symfony** : symfony/dotenv, symfony/routing, symfony/http-foundation, symfony/dependency-injection, symfony/config
- **Base de données** : MySQL
- **Serveur web** : Apache

## Commandes Utiles

Démarrer et arrêter les containers :

```sh
  make up       # Build et démarre les containers
  make down     # Stoppe les containers
  make restart  # Redémarre les services api
```

Accéder aux différents containers :

```sh
  make api   # Accès à l'API Store
```

Consulter les logs :

```sh
  make log-apache   # Logs du serveur Apache
```

---

## Auteur

Projet développé par Ashad Khan
