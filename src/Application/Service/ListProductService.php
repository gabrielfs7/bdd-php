<?php

namespace Bdd\Application\Service;

use Bdd\Domain\Entity\EntityCollection;
use Bdd\Domain\Repository\ProductRepository;

class ListProductService
{
    /** @var ProductRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function find(array $criteria): EntityCollection
    {
        return $this->productRepository->findAll($criteria);
    }
}
