# E-GRAVEYARD

## Table of contents
* [General info](#general-info)
* [Technologies](#technologies)
* [Setup](#setup)

## General info
A simple application for cataloging and searching for graves in graveyards made for parishes.

## Technologies
Project is created with:
* PHP 8.3
* Symfony 6.4
* Stimulus JS
* MySQL / MariaDB
* Tailwind 2
* SASS
* JQuery
* Docker

## Setup
To run this project, follow the commands below:

### 1) Install Docker on your computer if you don't already have it.

### 2) Download the repository and navigate to the directory you created.

```
git clone https://github.com/tomkalon/e-graveyard.git graveyard

cd graveyard
```


### 3) In the .env.dist file you can adjust the project settings. 

Here you can change the container name suffix.
```
PROJECT_NAME=graveyard
```

```
Change file -> .env.example to .env
```

### 4) Prepare your Docker environment.

```
docker-compose -f docker-compose.yml -f docker-compose.override.yml --env-file .env.dist up --build
```

### 5) Once completed, navigate to the 'php-apache' container and execute the following commands:
```
composer install
symfony console d:m:m
symfony console fos:js-routing:dump --format=json --target=public/js/routes.json
```

### 6) In the "node" container, execute the following commands in the terminal:
```
yarn install
yarn run dev
```

### 7) To run project initialization and make new administrator account, run:
```
symfony console app:project:init
```


### 8) The PHP server is configured on the default port 80. Launch your browser and enter the address:
```
http://localhost/
```

or login at:
```
http://localhost/admin/login
```

### 9) Basic editable files directories:
* /config/routes/custom/api/*
* /config/routes/custom/web/*

* /translations/settings.*
* /translations/custom.*

* /src/Main/UI/Custom/
* /templates/main/custom/
