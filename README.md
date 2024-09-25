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
`/api/users`
**Arguments :**
/

**Return :**
*Array* [
    "username" : *string*
    "class" : *string* or *null*
    "status" : *string*
]

### Show
`/api/users/show/{id}`
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


### Deconnexion
`/api/user/deconnexion`
**Arguments :**
"username" : *string*
"password" : *string*

**Return :**
"succes" : "Disconnected"

### Edit
`/api/user/Edit`
**Arguments :**
"token" : *string*
"mail" : *string*
"password" : *string*
"mail" : *string* - Option
"username" : *siring* - Option
"new_password" : *siring* - Option

**Return :**
"username" : *string*
"class" : *string*
"organization" : *string*
"mail" : *string*

## Event
### Index
`/api/events`
**Arguments :**
/

**Return :**
*Array* [
    "id" : *integer*
    "title" : *string*
    "validation" : *string* or *null*
    "creator_id" : *Array* [
                            "username" : *string*
                    ]
    "max_capacity" : *integer* or *null*
    "start_at" : *datetime AAAA-MM-JJThh-mm-ss+01:00*
    "end_at" : *datetime AAAA-MM-JJThh-mm-ss+01:00*
    "created_at" : *datetime AAAA-MM-JJThh-mm-ss+01:00*
    "countReservations": *Integer*
]

### Create
`/api/event/create`
**Arguments :**
    "token" : *string*
    "id" : *integer*
    "title" : *string*
    "description" : *string*
    "max_capacity" : *string* - optionnal
    "start_at" : *datetime Y-m-d H:i:s*
    "end_at" : *datetime Y-m-d H:i:s*

**Return :**
    "succes" => "Event created"

    
### Inscription (Reservation)
`/api/event/inscription`
**Arguments :**
    "token" : *string*
    "event_id" : *integer*

**Return :**
    "succes" => "Reservation complete"