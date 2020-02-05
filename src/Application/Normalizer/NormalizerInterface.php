<?php

namespace Bdd\Application\Normalizer;

interface NormalizerInterface
{
    public function normalize($object): array;
}
