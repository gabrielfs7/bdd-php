<?php

namespace Bdd\Domain\Repository;

use Bdd\Domain\Entity\Product;
use Bdd\Infrastructure\Database\ConnectionInterface;
use PDO;

class ProductRepository implements RepositoryInterface
{
    /** @var ConnectionInterface */
    private $connection;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function find(string $id): ?Product
    {
        $statement = $this->connection->getPdo()->prepare('SELECT * FROM product WHERE id = ?');
        $statement->execute([$id]);

        return $statement->fetchObject(Product::class);
    }

    public function findAll(array $criteria): array
    {
        $pdo = $this->connection->getPdo();

        $filters = [];
        $filterValues = [];

        if (isset($criteria['sku'])) {
            $filters[] = ' sku LIKE ? ';
            $filterValues[] = sprintf('%%s%', $criteria['sku']);
        }

        if (isset($criteria['id'])) {
            $filters[] = ' id LIKE ? ';
            $filterValues[] = sprintf('%%s%', $criteria['id']);
        }

        $statement = $pdo->prepare('SELECT * FROM product WHERE 1 ' . implode(' AND ', $filters));
        $statement->execute($filterValues);

        return $statement->fetchAll(PDO::FETCH_OBJ, Product::class);
    }

    public function save(Product $product): void
    {
        $statement = $this->connection->getPdo()->prepare(
            'INSERT INTO product(id, sku, price, created_at) VALUES (?, ?, ?, ?)'
        );

        $statement->execute(
            [
                $product->getId(),
                $product->getSku(),
                $product->getPrice(),
                $product->getCreatedAt()->format(DATE_ATOM),
            ]
        );
    }

    public function remove(Product $product): void
    {
        $statement = $this->connection->getPdo()->prepare('DELETE FROM product WHERE id = ?');
        $statement->execute($product->getId());
    }
}
