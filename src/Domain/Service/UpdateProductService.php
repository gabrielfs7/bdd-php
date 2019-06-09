<?php

namespace Bdd\Domain\Service;

use Bdd\Domain\Entity\Product;
use Bdd\Domain\Repository\ProductRepository;

class UpdateProductService
{
    /** @var ProductRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function update(string $id, string $sku, float $price): Product
    {
        $product = $this->productRepository->find($id);
        $product->setSku($sku);
        $product->setPrice($price);

        $this->productRepository->save($product);

        return $product;
    }
}
