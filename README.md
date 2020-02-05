# bdd-php

Simple use case of BDD using Behat in PHP.

### Install

```
composer install
```

### Create database

```
php database/init.php
```

### Initialize application

```
php -S localhost:8888 -t public public/index.php
```

### OpenApi documentation

View it using [Swagger Editor](https://editor.swagger.io/?raw=https://raw.githubusercontent.com/gabrielfs7/bdd-php/master/doc/openapi.yaml).

### Run tests

```
bin/behat
```

### Code Standards

Run code fixer:

```
bin/php-cs-fixer fix --verbose src/
```