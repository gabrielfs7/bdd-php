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

        return $this->hydrated((array)$statement->fetchObject());
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

        $items = [];

        foreach ($statement->fetchAll(PDO::FETCH_OBJ) as $item) {
            $items[] = $this->hydrated((array)$item);
        }

        return $items;
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

    private function hydrated(array $data): Product
    {
        $product = new Product($data['sku'], $data['price']);

        $ref = new \ReflectionClass($product);

        $id = $ref->getProperty('id');
        $id->setAccessible(true);
        $id->setValue($product, $data['id']);
        $id->setAccessible(false);

        $createdAt = $ref->getProperty('createdAt');
        $createdAt->setAccessible(true);
        $createdAt->setValue($product, new \DateTimeImmutable($data['created_at']));
        $createdAt->setAccessible(false);

        return $product;
    }
}
