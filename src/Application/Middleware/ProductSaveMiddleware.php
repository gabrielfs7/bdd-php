<?php

namespace Bdd\Application\Middleware;

use Bdd\Application\Request\Validator\ProductRequestValidator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ProductSaveMiddleware
{
    /** @var ProductRequestValidator */
    private $productRequestValidator;

    public function __construct(ProductRequestValidator $productRequestValidator)
    {
        $this->productRequestValidator = $productRequestValidator;
    }

    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->productRequestValidator->validate($request);

        return $handler->handle($request);
    }
}
