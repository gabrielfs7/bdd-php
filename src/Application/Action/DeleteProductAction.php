<?php

namespace Bdd\Application\Action;

use Bdd\Domain\Service\DeleteProductService;
use Bdd\Infrastructure\Http\JsonResponseAdapter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DeleteProductAction
{
    /** @var DeleteProductService */
    private $deleteProductService;

    public function __construct(DeleteProductService $deleteProductService)
    {
        $this->deleteProductService = $deleteProductService;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $uriParams): ResponseInterface
    {
        $this->deleteProductService->delete($uriParams['id']);

        return (new JsonResponseAdapter(
            $response,
            204,
            []
        ))->getResponse();
    }
}
