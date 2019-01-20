<?php

namespace Game\Factory;

use Game\Container;
use Game\Map;

class MapFactory implements FactoryInterface
{
    const DEF_WIDTH = 100;
    const DEF_LENGTH = 100;

    public function __invoke(Container $container, $serviceName): Map
    {
        $width = $container->get('config')['map']['width'] ?? self::DEF_WIDTH;
        $length = $container->get('config')['map']['length'] ?? self::DEF_LENGTH;
        $map = new Map($width, $length);

        foreach ($map as $location) {
            $randomRelief = array_rand(array_flip([Map::DOWNCOUNTRY, Map::MOUNTAIN, Map::WATER, Map::SWAMP]));
            $map->setRelief($location, $randomRelief);
        }

        return $map;
    }
}
