<?php

namespace Bdd\Test;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

class CreateProductFeatureContext implements Context
{
    public function __construct()
    {
    }

    /**
     * @Given product sku :arg1 and price :arg2
     */
    public function productSkuAbcAndPrice($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @When user submits request
     */
    public function userSubmitsRequest()
    {
        throw new PendingException();
    }

    /**
     * @Then I a new product is created
     */
    public function aNewProductIsCreated()
    {
        throw new PendingException();
    }

    /**
     * @Then status code :arg1 is returned
     */
    public function statusCodeIsReturned($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then a JSON with product sku :arg1 and price :arg2 is returned
     */
    public function aJsonWithProductSkuAbcAndPriceIsReturned($arg1, $arg2)
    {
        throw new PendingException();
    }
}
