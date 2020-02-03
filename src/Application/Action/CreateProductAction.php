<?php

namespace Bdd\Application\Action;

use Bdd\Application\Middleware\ParseRequestMiddleware;
use Bdd\Application\Normalizer\ProductNormalizer;
use Bdd\Domain\Service\CreateProductService;
use Bdd\Infrastructure\Http\JsonResponseAdapter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CreateProductAction
{
    /** @var CreateProductService */
    private $createProductService;

    /** @var ProductNormalizer */
    private $productNormalizer;

    public function __construct(CreateProductService $createProductService, ProductNormalizer $productNormalizer)
    {
        $this->createProductService = $createProductService;
        $this->productNormalizer = $productNormalizer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = $request->getAttribute(ParseRequestMiddleware::JSON_REQUEST_BODY);

        $product = $this->createProductService->create($params['sku'], $params['price']);

        return (new JsonResponseAdapter(
            $response,
            201,
            $this->productNormalizer->normalize($product)
        ))->getResponse();
    }
}
