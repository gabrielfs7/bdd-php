<?php

namespace Bdd\Application\Action;

use Bdd\Application\Normalizer\ProductListNormalizer;
use Bdd\Domain\Service\ListProductService;
use Bdd\Infrastructure\Http\JsonResponseAdapter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ListProductAction
{
    /** @var ProductListNormalizer */
    private $productListNormalizer;

    /** @var ListProductService */
    private $listProductService;

    public function __construct(ListProductService $listProductService, ProductListNormalizer $productNormalizer)
    {
        $this->productListNormalizer = $productNormalizer;
        $this->listProductService = $listProductService;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $uriParams): ResponseInterface
    {
        $products = $this->listProductService->find($uriParams);

        return (new JsonResponseAdapter(
            $response,
            200,
            $this->productListNormalizer->normalize($products)
        ))->getResponse();
    }
}
