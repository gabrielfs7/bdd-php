<?php

namespace Bdd\Infrastructure\Database;

use PDO;

class InMemoryConnection implements ConnectionInterface
{
    /** @var PDO */
    private $pdo;

    public function connect(): bool
    {
        $this->pdo = new PDO('sqlite::memory');
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}
