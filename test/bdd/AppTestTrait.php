<?php

namespace Bdd\Test;

use Bdd\Infrastructure\Slim\App;
use PHPUnit\Framework\Assert;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;

trait AppTestTrait
{
    /** @var App */
    private $app;

    protected function request(
        string $method,
        string $path,
        array $query = null,
        array $body = null,
        array $headers = []
    ): ResponseInterface {
        return $this->getApp()->subRequest(
            $method,
            $path,
            $query ? http_build_query($query) : '',
            $headers,
            [],
            $body ? json_encode($body) : ''
        );
    }

    protected function getContainer(): ContainerInterface
    {
        return $this->getApp()->getContainer();
    }

    protected function initDatabase(): void
    {
        $app = $this->getApp();

        include __DIR__ . '/../../database/down.php';
        include __DIR__ . '/../../database/up.php';
    }

    protected function assertJsonResponseContains(Response $response, array $expectedData): void
    {
        Assert::assertEmpty(array_diff_assoc($expectedData, $this->getParsedJsonResponse($response)));
    }

    protected function assertResponseStatusCode(Response $response, int $statusCode): void
    {
        Assert::assertSame($statusCode, $response->getStatusCode());
    }

    protected function getParsedJsonResponse(Response $response): array
    {
        return json_decode((string)$response->getBody(), true);
    }

    private function getApp(): App
    {
        if ($this->app) {
            return $this->app;
        }

        require_once __DIR__ . '/../bootstrap.php';

        $app = new App();

        include APP_ROOT . '/config/routes.php';

        return $this->app = $app;
    }
}
