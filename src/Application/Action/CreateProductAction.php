<?php

namespace Bdd\Application\Action;

use Bdd\Domain\Service\CreateProductService;
use Slim\Http\Request;
use Slim\Http\Response;

class CreateProductAction
{
    /** @var CreateProductService */
    private $createProductService;

    public function __construct(CreateProductService $createProductService)
    {
        $this->createProductService = $createProductService;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        $params = $request->getParsedBody();

        $product = $this->createProductService->create($params['sku'], $params['price']);

        return $response->withJson(
            [
                'id' => $product->getId(),
                'sku' => $product->getSku(),
                'price' => $product->getPrice(),
                'createdAt' => $product->getCreatedAt()->format(DATE_ATOM),
            ],
            201
        );
    }
}
