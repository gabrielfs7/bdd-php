<?php

use Bdd\Infrastructure\Database\Connection;

include __DIR__ . '/../bootstrap.php';

$connection = new Connection();
$connection->connect();
$connection->getPdo()->exec('
  CREATE TABLE product ( 
    id VARCHAR NOT NULL PRIMARY KEY, 
    sku VARCHAR NOT NULL, 
    price DOUBLE(5, 2),
    created_at DATETIME NOT NULL
  );
');

if ($connection->getPdo()->errorCode()) {
    echo PHP_EOL;
    echo 'ERROR ' . $connection->getPdo()->errorCode();
    echo PHP_EOL;
    echo var_export($connection->getPdo()->errorInfo());
    echo PHP_EOL;
}