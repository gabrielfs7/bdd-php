<?php

namespace Bdd\Domain\Entity;

use DateTimeInterface;

class Product implements EntityInterface
{
    /** @var string */
    private $id;

    /** @var string */
    private $sku;

    /** @var float */
    private $price;

    /** @var DateTimeInterface */
    private $createdAt;

    public function __construct(string $sku, float $price)
    {
        $this->id = uniqid();
        $this->sku = $sku;
        $this->price = $price;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }
}
