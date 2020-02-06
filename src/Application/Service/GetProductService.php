<?php

namespace Bdd\Application\Service;

use Bdd\Application\Request\Error\ResourceNotFoundException;
use Bdd\Domain\Entity\Product;
use Bdd\Domain\Repository\ProductRepository;

class GetProductService
{
    /** @var ProductRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function get(string $id): Product
    {
        $product = $this->productRepository->find($id);

        if (!$product) {
            throw new ResourceNotFoundException('Product not found');
        }

        return $product;
    }
}
