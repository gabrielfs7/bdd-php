<?php

namespace Bdd\Test;

use Bdd\Domain\Entity\Product;
use PHPUnit\Framework\Assert;

class CreateProductFeatureContext extends AbstractFeatureContext
{
    /** @var string */
    protected $sku;

    /** @var float */
    protected $price;

    /** @var Product */
    protected $product;

    /**
     * @Then status code :arg1 is returned
     */
    public function statusCodeIsReturned($arg1)
    {
        $this->assertResponseStatusCode($this->response, (int)$arg1);
    }

    /**
     * @Then a JSON with product sku :arg1 and price :arg2 is returned
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

    /**
     * @Given product sku :arg1 and price :arg2
     */
    public function productSkuAbcAndPrice($arg1, $arg2)
    {
        $this->sku = $arg1;
        $this->price = $arg2;
    }

    /**
     * @When user submits request
     */
    public function userSubmitsRequest()
    {
        $this->response = $this->request(
            'POST',
            '/v1/products',
            null,
            [
                'sku' => $this->sku,
                'price' => $this->price,
            ]

        );
    }

    /**
     * @Then a new product is created
     */
    public function aNewProductIsCreated()
    {
        $product = $this->productRepository->find($this->getParsedJsonResponse($this->response)['id']);

        Assert::assertNotNull($product);
    }
}
