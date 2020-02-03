<?php

namespace Bdd\Infrastructure\Http;

use JsonException;
use Psr\Http\Message\ServerRequestInterface;

class JsonRequestParser
{
    public function parse(ServerRequestInterface $request): array
    {
        $params = json_decode((string)$request->getBody(), true);

        if (json_last_error()) {
            throw new JsonException(sprintf('Invalid JSON: %s', json_last_error_msg()));
        }

        return $params;
    }
}
