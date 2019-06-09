Feature: Update a product

  Scenario Outline: Update a product with sku <sku> and price <price>
    Given there is a product with sku <sku> and price <price>
    When I update product sku <newSku> and price <newPrice>
    Then status code <statusCode> is returned
    And a JSON with updated product sku <newSku> and price <newPrice> is returned

    Examples:
      | sku    | price | newSku | newPrice | statusCode |
      | abc123 | 23.35 | abc321 | 35.23    | 200        |