<?php

namespace Bdd\Application\Normalizer;

use Bdd\Domain\Entity\EntityCollection;

class ProductListNormalizer implements NormalizerInterface
{
    /** @var ProductNormalizer */
    private $productNormalizer;

    public function __construct(ProductNormalizer $productNormalizer)
    {
        $this->productNormalizer = $productNormalizer;
    }

    /**
     * @param EntityCollection $productList
     *
     * @return array
     */
    public function normalize($productList): array
    {
        $output = [];

        foreach ($productList as $product) {
            $output[] = $this->productNormalizer->normalize($product);
        }

        return $output;
    }
}
