<?php

namespace Bdd\Application\Service;

use Bdd\Application\Request\Error\ResourceNotFoundException;
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

        if (!$product) {
            throw new ResourceNotFoundException('Product not found');
        }

        $this->productRepository->remove($product);
    }
}
