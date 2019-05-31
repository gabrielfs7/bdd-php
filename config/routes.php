<?php

use Bdd\Domain\Service\CreateProductService;
use Slim\App;

/** @var $app App */
$app->post('/products', CreateProductService::class);