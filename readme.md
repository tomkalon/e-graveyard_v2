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

...and adjust the settings to your needs.

### 4) Prepare your Docker environment.

```
docker-compose -f docker-compose.yml -f docker-compose.override.yml --env-file .env.dist up --build
```

### 5) Once completed, navigate to the 'php-apache' container and execute the following commands:
```
composer install
symfony console app:project:check-files
```

### 6) To run project initialization and make new administrator account, run:
```
symfony console app:project:init
```

### 7) In the "node" container, execute the following commands in the terminal:
```
yarn install
yarn run dev
```

In case of problems, remove yarn.lock and repeat the procedure.

### 8) The PHP server is configured on the default port 80. Launch your browser and enter the address:
```
http://localhost/
```

or login at:
```
http://localhost/admin/login
```

MAILCATCHER - for developers applications is available at:
```
http://localhost:8025/
```


### 9) Basic editable files directories:

For ROUTES:
* /config/routes/custom/api/*
* /config/routes/custom/web/*

For TRANSLATIONS:
* /translations/settings.*
* /translations/custom.*

For SOURCE FILES:
* /src/Custom/

For TWIG TEMPLATES:
* /templates/custom/

For ASSETS:
* /assets/images/custom/*
* /assets/styles/custom.scss

#### '/custom/menu/top_menu.html.twig' -> create file to extend top menu.
#### '/custom/_frontpage_content.html.twig' -> create to extend front page content (example template in example folder).
