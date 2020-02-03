<?php

namespace Bdd\Infrastructure\DI;

interface ContainerProviderInterface
{
    public function register(): array;
}
