<?php

namespace Bdd\Test;

use Bdd\Domain\Repository\ProductRepository;
use Behat\Behat\Context\Context;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractFeatureContext implements Context
{
    use AppTestTrait;

    /** @var ResponseInterface */
    protected $response;

    /** @var ProductRepository */
    protected $productRepository;

    public function __construct()
    {
        $this->initDatabase();

        $this->productRepository = $this->getContainer()->get(ProductRepository::class);
    }
}
