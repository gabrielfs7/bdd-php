<?php

namespace Bdd\Infrastructure\Database;

use PDO;

interface ConnectionInterface
{
    public function connect(): void;

    public function getPdo(): PDO;
}
