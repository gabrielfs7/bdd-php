<?php

use Bdd\Application\Action\CreateProductAction;
use Bdd\Application\Action\GetProductAction;
use Bdd\Application\Action\ListProductAction;
use Bdd\Application\Action\UpdateProductAction;
use Bdd\Application\Middleware\ParseRequestMiddleware;

/** @var $app \Slim\App */

$container = $app->getContainer();

$app->add($container->get(ParseRequestMiddleware::class));

$app->get('/v1/products/{id}', GetProductAction::class);
$app->get('/v1/products', ListProductAction::class);
$app->post('/v1/products', CreateProductAction::class);
$app->put('/v1/products/{id}', UpdateProductAction::class);