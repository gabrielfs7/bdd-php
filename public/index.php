<?php

use Slim\App;

$app = new App();

include '../bootstrap.php';
include '../config/routes.php';

$app->run();
