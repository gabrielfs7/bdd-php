<?php

namespace Bdd\Domain\Repository;

use Bdd\Domain\Entity\EntityCollection;
use Bdd\Domain\Entity\EntityInterface;

interface RepositoryInterface
{
    public function find(string $id): ?EntityInterface;

    public function findAll(array $criteria = []): EntityCollection;

    public function save(EntityInterface $product): void;

    public function remove(EntityInterface $product): void;
}
