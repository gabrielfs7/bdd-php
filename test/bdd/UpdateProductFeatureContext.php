<?php

namespace Bdd\Test;

use Bdd\Domain\Entity\Product;
use Bdd\Domain\Repository\ProductRepository;
use Behat\Behat\Context\Context;
use Slim\Http\Response;

class UpdateProductFeatureContext implements Context
{
    use AppTestTrait;

    /** @var Product */
    private $product;

    /** @var Response */
    private $response;

    /** @var ProductRepository */
    private $productRepository;

    public function __construct()
    {
        $this->initDatabase();

        $this->productRepository = $this->getContainer()->get(ProductRepository::class);
    }

    /**
     * @Given there is a product with sku :arg2 and price :arg2
     */
    public function thereIsAProductWithSkuAbcAndPrice($arg1, $arg2)
    {
        $this->productRepository->save(new Product($arg1, $arg2));
        $this->product = current($this->productRepository->findAll([]));
    }

    /**
     * @When I update product sku :arg1 and price :arg2
     */
    public function IUpdateProductSkuAndPrice($arg1, $arg2)
    {
        $this->response = $this->request(
            'PUT',
            '/products/' . $this->product->getId(),
            null,
            [
                'sku' => $arg1,
                'price' => $arg2,
            ]

        );
    }

    /**
     * @Then status code :arg1 is returned
     */
    public function statusCodeIsReturned($arg1)
    {
        $this->assertResponseStatusCode($this->response, (int)$arg1);
    }

    /**
     * @Then a JSON with updated product sku :arg1 and price :arg2 is returned
     */
    public function aJsonWithProductSkuAbcAndPriceIsReturned($arg1, $arg2)
    {
        $this->assertJsonResponseContains(
            $this->response,
            [
                'sku' => $arg1,
                'price' => $arg2,
            ]
        );
    }
}
