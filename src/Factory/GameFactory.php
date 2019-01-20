<?php

namespace Game\Factory;

use Game\Container;
use Game\Game;
use Game\Logger;
use Game\Map;
use Game\Rule;
use Game\UnitLocator;

class GameFactory implements FactoryInterface
{
    public function __invoke(Container $container, string $serviceName)
    {
        return new Game(
            $container->get(Map::class),
            $container->get(UnitLocator::class),
            $container->get(Rule::class),
            $container->get(Logger::class)
        );
    }
}
