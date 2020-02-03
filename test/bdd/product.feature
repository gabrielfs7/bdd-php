Feature: CRUD of product

  Scenario Outline: Create a product with sku <sku> and price <price>
    Given product sku <sku> and price <price>
    When user submits request
    Then a new product is created
    And a JSON with product sku <sku> and price <price> is returned
    And status code <statusCode> is returned

    Examples:
      | sku    | price | statusCode |
      | abc123 | 23.35 | 201        |

  Scenario Outline: Update a product with sku <sku> and price <price>
    Given there is a product with sku <sku> and price <price>
    When I update product sku <newSku> and price <newPrice>
    Then a JSON with product sku <newSku> and price <newPrice> is returned
    And status code <statusCode> is returned

    Examples:
      | sku    | price | newSku | newPrice | statusCode |
      | abc123 | 23.35 | abc321 | 35.23    | 200        |