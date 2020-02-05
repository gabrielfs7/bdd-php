<?php

namespace Bdd\Domain\Entity;

use ArrayIterator;

class EntityCollection extends ArrayIterator
{
    public function __construct(EntityInterface ...$entities)
    {
        parent::__construct($entities);
    }
}
