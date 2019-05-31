<?php

use Bdd\Infrastructure\Database\Connection;

require_once '../bootstrap.php';

$connection = new Connection();
$connection->getPdo()->exec('
  CREATE TABLE product ( 
    id VARCHAR NOT NULL PRIMARY KEY, 
    sku VARCHAR NOT NULL, 
    price DOUBLE(5, 2),
    created_at DATETIME NOT NULL
  );
');