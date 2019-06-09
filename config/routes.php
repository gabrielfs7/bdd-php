<?php

use Bdd\Application\Action\CreateProductAction;
use Bdd\Application\Action\UpdateProductAction;
use Bdd\Infrastructure\Slim\App;

/** @var $app App */
$app->post('/products', CreateProductAction::class);
$app->patch('/products/{id}', UpdateProductAction::class);