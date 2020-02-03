<?php

namespace Bdd\Application\Normalizer;

use Bdd\Domain\Entity\Product;

class ProductNormalizer implements NormalizerInterface
{
    /**
     * @param Product $product
     * @return array
     */
    public function normalize($product): array
    {
        return [
            'id' => $product->getId(),
            'sku' => $product->getSku(),
            'price' => $product->getPrice(),
            'createdAt' => $product->getCreatedAt()->format(DATE_ATOM),
        ];
    }
}