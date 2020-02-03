<?php

use Bdd\Infrastructure\Slim\AppFactory;
use Bdd\Infrastructure\DI\ContainerProvider;

return (new AppFactory(new ContainerProvider()))->create();