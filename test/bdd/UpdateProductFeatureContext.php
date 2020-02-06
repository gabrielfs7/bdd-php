<?php

namespace Bdd\Test;

use Bdd\Domain\Entity\Product;

class UpdateProductFeatureContext extends AbstractFeatureContext
{
    /** @var string */
    protected $sku;

    /** @var float */
    protected $price;

    /** @var Product */
    protected $product;

    /**
     * @Given there is an existent product
     */
    public function thereIsAnExistentProduct()
    {
        $this->productRepository->save(new Product('test', 15.7));
        $this->product = current($this->productRepository->findAll([]));
    }

    /**
     * @When I update the product with invalid sku :arg1 or price :arg2
     */
    public function iUpdateTheProductWithInvalidSku($arg1, $arg2)
    {
        $this->response = $this->request(
            'PUT',
            '/v1/products/' . $this->product->getId(),
            null,
            [
                'sku' => $arg1,
                'price' => $arg2,
            ]
        );
    }

    /**
     * @Then a JSON with product the error :arg1 is returned
     */
    public function aJsonWithProductTheErrorIsReturned($arg1)
    {
        $this->assertJsonResponseContains(
            $this->response, [
                'code' => 0,
                'message' => $arg1,
            ]
        );
    }

    /**
     * @Then status code :arg1 for update is returned
     */
    public function statusCodeIsReturned($arg1)
    {
        $this->assertResponseStatusCode($this->response, (int)$arg1);
    }

    /**
     * @Then a JSON with the updated product sku :arg1 and price :arg2 is returned
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
     * @Given there is a product with sku :arg1 and price :arg2
     */
    public function thereIsAProductWithSkuAndPrice($arg1, $arg2)
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
            '/v1/products/' . $this->product->getId(),
            null,
            [
                'sku' => $arg1,
                'price' => $arg2,
            ]
        );
    }
}
