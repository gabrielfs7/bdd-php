<?php

use Bdd\Application\Action\CreateProductAction;
use Bdd\Application\Action\UpdateProductAction;
use Bdd\Application\Middleware\ParseRequestMiddleware;

/** @var $app \Slim\App */

$container = $app->getContainer();

$app->add($container->get(ParseRequestMiddleware::class));
$app->post('/products', CreateProductAction::class);
$app->patch('/products/{id}', UpdateProductAction::class);