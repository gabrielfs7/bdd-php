<?php

use Bdd\Application\Action\CreateProductAction;
use Bdd\Infrastructure\Slim\App;

/** @var $app App */
$app->post('/products', CreateProductAction::class);