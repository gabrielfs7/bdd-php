<?php

use Bdd\Infrastructure\Slim\App;

include __DIR__ . '/../bootstrap.php';

$app = new App();

include __DIR__ . '/../config/routes.php';

$app->run();
