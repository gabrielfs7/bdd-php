<?php

namespace Bdd\Application\Request\Validator;

use Bdd\Application\Middleware\ParseRequestMiddleware;
use Bdd\Application\Request\Error\InvalidRequestException;
use InvalidArgumentException;
use Psr\Http\Message\ServerRequestInterface;
use Webmozart\Assert\Assert;

class ProductRequestValidator implements RequestValidatorInterface
{
    public function validate(ServerRequestInterface $request): void
    {
        $params = $request->getAttribute(ParseRequestMiddleware::JSON_REQUEST_BODY);

        try {
            Assert::stringNotEmpty($params['sku'] ?? null, 'Product sku must be a string. %s given');
            Assert::numeric($params['price'] ?? null, 'Product price must be a number. %s given');
        } catch (InvalidArgumentException $exception) {
            throw new InvalidRequestException($exception->getMessage());
        }
    }
}
