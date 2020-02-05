<?php

namespace Bdd\Domain\Service;

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
        return $this->productRepository->find($id);
    }
}
