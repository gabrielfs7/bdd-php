Feature: Update a product

  Scenario Outline: Update a product with sku <sku> and price <price>
    Given there is a product with sku <sku> and price <price>
    When I update product sku <newSku> and price <newPrice>
    Then a JSON with the updated product sku <newSku> and price <newPrice> is returned
    And status code <statusCode> for update is returned

    Examples:
      | sku    | price | newSku | newPrice | statusCode |
      | abc123 | 23.35 | abc321 | 35.23    | 200        |

  Scenario Outline: Update a product with invalid sku
    Given there is an existent product
    When I update the product with invalid sku <sku> or price <price>
    Then a JSON with product the error <errorMessage> is returned
    And status code <statusCode> for update is returned

    Examples:
      | errorMessage                                   | sku  | price | statusCode |
      | 'Product sku must be a string. "" given'       | ""   | 55.5  | 400        |
      | 'Product price must be a number. string given' | test | ""    | 400        |