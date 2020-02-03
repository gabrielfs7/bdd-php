<?php

namespace Bdd\Infrastructure\DI;

use Bdd\Infrastructure\Database\ConnectionInterface;
use Psr\Container\ContainerInterface;

class ContainerProvider implements ContainerProviderInterface
{
    public function register(): array
    {
        $container = [];
        $container[ConnectionInterface::class] = static function (ContainerInterface $container): ConnectionInterface {
            /** @var ConnectionInterface $connection */
            $connection = $container->get($container->get('settings.connectionClass'));
            $connection->connect();

            return $connection;
        };

        return $container;
    }
}
