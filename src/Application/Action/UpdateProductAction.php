<?php

namespace Bdd\Application\Action;

use Bdd\Domain\Service\UpdateProductService;
use Slim\Http\Request;
use Slim\Http\Response;

class UpdateProductAction
{
    /** @var UpdateProductService */
    private $updateProductService;

    public function __construct(UpdateProductService $updateProductService)
    {
        $this->updateProductService = $updateProductService;
    }

    public function __invoke(Request $request, Response $response, string $id): Response
    {
        $params = json_decode($request->getBody()->getContents(), true);

        $product = $this->updateProductService->update($id, $params['sku'], $params['price']);

        return $response->withJson(
            [
                'id' => $product->getId(),
                'sku' => $product->getSku(),
                'price' => $product->getPrice(),
                'createdAt' => $product->getCreatedAt()->format(DATE_ATOM),
            ],
            200
        );
    }
}
