<?php

namespace Bdd\Infrastructure\Database;

use PDO;

class Connection implements ConnectionInterface
{
    /** @var PDO */
    private $pdo;

    public function connect(): void
    {
        $this->pdo = new PDO(
            sprintf('sqlite:%s', APP_ROOT . '/database/product.db'),
            null,
            null,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]
        );
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}
