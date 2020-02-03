<?php

use Bdd\Infrastructure\Database\ConnectionInterface;
use Slim\App;

/** @var App $app */
$connection = $app->getContainer()->get(ConnectionInterface::class);
$connection->connect();
$connection->getPdo()->exec('
  CREATE TABLE product ( 
    id VARCHAR NOT NULL PRIMARY KEY, 
    sku VARCHAR NOT NULL, 
    price DOUBLE(5, 2),
    created_at DATETIME NOT NULL
  );
');
