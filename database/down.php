<?php

use Bdd\Infrastructure\Database\ConnectionInterface;
use Slim\App;

/** @var App $app */
$connection = $app->getContainer()->get(ConnectionInterface::class);
$connection->connect();
$connection->getPdo()->exec('DROP TABLE IF EXISTS product;');
