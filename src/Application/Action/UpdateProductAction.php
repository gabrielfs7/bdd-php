<?php

namespace Bdd\Application\Action;

use Bdd\Application\Middleware\ParseRequestMiddleware;
use Bdd\Application\Normalizer\ProductNormalizer;
use Bdd\Domain\Service\UpdateProductService;
use Bdd\Infrastructure\Http\JsonResponseAdapter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class UpdateProductAction
{
    /** @var UpdateProductService */
    private $updateProductService;

    /** @var ProductNormalizer */
    private $productNormalizer;

    public function __construct(UpdateProductService $updateProductService, ProductNormalizer $productNormalizer)
    {
        $this->updateProductService = $updateProductService;
        $this->productNormalizer = $productNormalizer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $uriParams): ResponseInterface
    {
        $params = $request->getAttribute(ParseRequestMiddleware::JSON_REQUEST_BODY);

        $product = $this->updateProductService->update($uriParams['id'], $params['sku'], $params['price']);

        return (new JsonResponseAdapter(
            $response,
            200,
            $this->productNormalizer->normalize($product)
        ))->getResponse();
    }
}
