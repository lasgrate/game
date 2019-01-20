<?php

namespace Game\Factory;

use Game\Container;

interface FactoryInterface
{
    public function __invoke(Container $container, string $serviceName);
}
