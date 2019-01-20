<?php

namespace Game\Factory;

use Game\Container;

class InvokableFactory implements FactoryInterface
{
    public function __invoke(Container $container, string $serviceName)
    {
        return new $serviceName();
    }
}
