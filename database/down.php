<?php

use Bdd\Infrastructure\Database\ConnectionInterface;
use Bdd\Infrastructure\Slim\App;

/** @var App $app */
$connection = $app->getContainer()->get(ConnectionInterface::class);
$connection->connect();
$connection->getPdo()->exec('DROP TABLE product;');
