<?php

use Bdd\Infrastructure\Database\InMemoryConnection;

return [
    'settings.displayErrorDetails' => true,
    'settings.connectionClass' => InMemoryConnection::class,
];