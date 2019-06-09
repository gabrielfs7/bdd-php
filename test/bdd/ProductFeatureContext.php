<?php

namespace Bdd\Test;

use Bdd\Domain\Entity\Product;
use Bdd\Domain\Repository\ProductRepository;
use Behat\Behat\Context\Context;
use PHPUnit\Framework\Assert;
use Slim\Http\Response;

class ProductFeatureContext implements Context
{
    use AppTestTrait;

    /** @var string */
    protected $sku;

    /** @var float */
    protected $price;

    /** @var Product */
    protected $product;

    /** @var Response */
    protected $response;

    /** @var ProductRepository */
    protected $productRepository;

    public function __construct()
    {
        $this->initDatabase();

        $this->productRepository = $this->getContainer()->get(ProductRepository::class);
    }

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
            'PATCH',
            '/products/' . $this->product->getId(),
            null,
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
            '/products',
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
