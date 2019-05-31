<?php

namespace Bdd\Infrastructure\Database;

use PDO;

class Connection implements ConnectionInterface
{
    /** @var PDO */
    private $pdo;

    public function connect(): bool
    {
        $this->pdo = new PDO(sprintf('sqlite:%s', APP_ROOT . '/database/product.db'));
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}
