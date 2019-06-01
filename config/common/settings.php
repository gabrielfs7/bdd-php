<?php

use Bdd\Infrastructure\Database\Connection;

return [
    'settings.displayErrorDetails' => false,
    'settings.responseChunkSize' => 4096,
    'settings.outputBuffering' => 'append',
    'settings.determineRouteBeforeAppMiddleware' => false,
    'settings.httpVersion' => '2.0',
    'settings.connectionClass' => Connection::class,
];