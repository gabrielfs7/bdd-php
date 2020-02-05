<?php

namespace Bdd\Domain\Service;

use Bdd\Domain\Repository\ProductRepository;

class DeleteProductService
{
    /** @var ProductRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function delete(string $id): void
    {
        $product = $this->productRepository->find($id);

        $this->productRepository->remove($product);
    }
}
