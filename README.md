# Partie Front 

## Installation
```shell
cd front
npm install
```

## Lancement du projet
```shell
npm start
```

#  Partie Back

## Set up l'app
### Mis en place de symfony et la DB:
(Au besoin, modifier le .env pour votre environnement, de base il a pour username root sans mot de passe)
```shell
cd back
composer install
php bin/console doctrine:database:create  
```

### Migrations
```shell
php bin/console doctrine:migrations:migrate
```

## Démarrer l'app
### Démarrrage
```shell
symfony local:server:start
```
### Shutdown
```shell
symfony local:server:start
```

# Requêtes API
## User
### Index
`/users`
**Arguments :**
/

**Return :**
*Array* [
    "username" : *string*
    "class" : *string* or *null*
    "status" : *string*
]

### Show
`/users/show/{id}`
**Arguments :**
/

**Return :**
"id" : *integer*
"username" : *string*
"class" : *string* or *null*
"status" : *string*

### Create user (inscription)
`/api/user/inscription`
**Arguments :**
"username" : *string*
"mail" : *string*
"password" : *string*
"class" : *string*

**Return :**
"succes" : "User created" 

### Connexion
`/api/user/connexion`
**Arguments :**
"username" : *string*
"password" : *string*

**Return :**
"token" : *string*


### Connexion
`/api/user/deconnexion`
**Arguments :**
"username" : *string*
"password" : *string*

**Return :**
"succes" : "Disconnected"
