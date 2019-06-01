<?php

namespace Bdd\Infrastructure\Database;

use PDO;

class InMemoryConnection implements ConnectionInterface
{
    /** @var PDO */
    private $pdo;

    public function connect(): void
    {
        $this->pdo = new PDO(
            'sqlite::memory',
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
