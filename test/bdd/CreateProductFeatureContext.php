<?php

namespace Bdd\Test;

use Bdd\Domain\Repository\ProductRepository;
use Behat\Behat\Context\Context;
use PHPUnit\Framework\Assert;
use Slim\Http\Response;

class CreateProductFeatureContext implements Context
{
    use AppTestTrait;

    /** @var string */
    private $sku;

    /** @var float */
    private $price;

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
}
