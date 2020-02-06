Feature: Create a product

  Scenario Outline: Create a product with sku <sku> and price <price>
    Given product sku <sku> and price <price>
    When user submits request
    Then a new product is created
    And a JSON with product sku <sku> and price <price> is returned
    And status code <statusCode> is returned

    Examples:
      | sku    | price | statusCode |
      | abc123 | 23.35 | 201        |