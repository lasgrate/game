<?php

include 'autoloader.php';

$container = new \Game\Container([
    \Game\Game::class => \Game\Factory\GameFactory::class,
    \Game\Logger::class => \Game\Factory\InvokableFactory::class,
    \Game\Rule::class => \Game\Factory\InvokableFactory::class,
    \Game\UnitLocator::class => \Game\Factory\UnitLocatorFactory::class,
    \Game\Map::class => \Game\Factory\MapFactory::class,
]);

$container->get(\Game\Game::class)->run();
