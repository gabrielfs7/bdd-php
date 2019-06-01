<?php

namespace Bdd\Infrastructure\Slim;

use Bdd\Infrastructure\Database\ConnectionInterface;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

class App extends \DI\Bridge\Slim\App
{
    protected function configureContainer(ContainerBuilder $builder)
    {
        $defaultConfigs = glob(APP_ROOT . '/config/common/*.php');

        $finalConfigs = [
            ConnectionInterface::class => function(ContainerInterface $container): ConnectionInterface {
                /** @var ConnectionInterface $connection */
                $connection = $container->get($container->get('settings.connectionClass'));
                $connection->connect();

                return $connection;
            }
        ];

        foreach ($defaultConfigs as $defaultConfig) {
            $finalConfigs += include $defaultConfig;
        }

        foreach (glob(APP_ROOT . '/config/' . APP_ENV . '/*.php') as $envConfig) {
            $finalConfigs = array_replace_recursive($finalConfigs, include $envConfig);
        }

        $builder->addDefinitions($finalConfigs);
    }
}
