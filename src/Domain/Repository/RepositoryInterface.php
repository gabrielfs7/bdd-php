<?php

namespace Bdd\Domain\Repository;

use Bdd\Domain\Entity\Product;

interface RepositoryInterface
{
    public function find(string $id): ?Product;

    public function findAll(array $criteria): array;

    public function save(Product $product): void;

    public function remove(Product $product): void;
}
