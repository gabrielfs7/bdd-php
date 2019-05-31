<?php

namespace Bdd\Infrastructure\Database;

use PDO;

interface ConnectionInterface
{
    public function connect(): bool;

    public function getPdo(): PDO;
}
