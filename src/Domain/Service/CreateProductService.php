<?php

namespace Bdd\Domain\Service;

use Bdd\Domain\Entity\Product;
use Bdd\Domain\Repository\ProductRepository;

class CreateProductService
{
    /** @var ProductRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function create(string $sku, float $price): Product
    {
        $product = new Product($sku, $price);

        $this->productRepository->save($product);

        return $this->productRepository->find($product->getId());
    }
}
