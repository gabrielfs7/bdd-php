<?php

namespace Bdd\Application\Request\Validator;

use Psr\Http\Message\ServerRequestInterface;

interface RequestValidatorInterface
{
    public function validate(ServerRequestInterface $request): void;
}
