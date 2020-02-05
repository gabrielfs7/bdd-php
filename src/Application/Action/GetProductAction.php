<?php

namespace Bdd\Application\Action;

use Bdd\Application\Normalizer\ProductNormalizer;
use Bdd\Domain\Service\GetProductService;
use Bdd\Infrastructure\Http\JsonResponseAdapter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetProductAction
{
    /** @var ProductNormalizer */
    private $productNormalizer;

    /** @var GetProductService */
    private $getProductService;

    public function __construct(GetProductService $getProductService, ProductNormalizer $productNormalizer)
    {
        $this->productNormalizer = $productNormalizer;
        $this->getProductService = $getProductService;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $uriParams): ResponseInterface
    {
        $product = $this->getProductService->get($uriParams['id']);

        return (new JsonResponseAdapter(
            $response,
            200,
            $this->productNormalizer->normalize($product)
        ))->getResponse();
    }
}
