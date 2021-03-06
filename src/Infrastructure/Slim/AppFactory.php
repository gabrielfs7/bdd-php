<?php

namespace Bdd\Infrastructure\Slim;

use Bdd\Application\Handler\ErrorHandler;
use Bdd\Infrastructure\DI\ContainerProviderInterface;
use DI\ContainerBuilder;
use Slim\App;
use Slim\Factory\AppFactory as SlimAppFactory;

class AppFactory
{
    /** @var ContainerProviderInterface */
    private $containerProvider;

    public function __construct(ContainerProviderInterface ...$containerProvider)
    {
        $this->containerProvider = $containerProvider;
    }

    public function create(): App
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions($this->loadContainerConfig());

        foreach ($this->containerProvider as $containerProvider) {
            $builder->addDefinitions($containerProvider->register());
        };

        $container = $builder->build();

        SlimAppFactory::setContainer($container);

        $app = SlimAppFactory::create();
        $app->addRoutingMiddleware();

        $errorHandler = $app->addErrorMiddleware($container->get('settings.displayErrorDetails'), false, false);
        $errorHandler->setDefaultErrorHandler(new ErrorHandler($app->getResponseFactory()));

        return $app;
    }

    private function loadContainerConfig(): array
    {
        $defaultConfigs = glob(APP_ROOT . '/config/common/*.php');

        $finalConfigs = [];

        foreach ($defaultConfigs as $defaultConfig) {
            $finalConfigs = array_merge_recursive($finalConfigs, include $defaultConfig);
        }

        foreach (glob(APP_ROOT . '/config/' . APP_ENV . '/*.php') as $envConfig) {
            $finalConfigs = array_replace_recursive($finalConfigs, include $envConfig);
        }

        return $finalConfigs;
    }
}
