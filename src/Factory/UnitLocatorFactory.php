<?php

namespace Game\Factory;

use Game\Container;
use Game\Unit\Base;
use Game\Unit\CombatVehicle;
use Game\Unit\Human;
use Game\Unit\Plane;
use Game\UnitLocator;

class UnitLocatorFactory implements FactoryInterface
{
    const DEF_HUMANS = 40;
    const DEF_PLANES = 20;
    const DEF_COMBAT_VEHICLE = 10;
    const DEF_BASES = 2;

    public function __invoke(Container $container, $serviceName): UnitLocator
    {
        $humanCount = $container->get('config')['map']['humans'] ?? self::DEF_HUMANS;
        $planeCount = $container->get('config')['map']['planes'] ?? self::DEF_PLANES;
        $combatVehicleCount = $container->get('config')['map']['combatVehicles'] ?? self::DEF_COMBAT_VEHICLE;
        $baseCount = $container->get('config')['map']['bases'] ?? self::DEF_BASES;

        $unitLocator = new UnitLocator();

        for ($i = 0; $i < $humanCount; $i++) {
            $unitLocator->set(new Human());
        }

        for ($i = 0; $i < $planeCount; $i++) {
            $unitLocator->set(new Plane());
        }

        for ($i = 0; $i < $combatVehicleCount; $i++) {
            $unitLocator->set(new CombatVehicle());
        }

        for ($i = 0; $i < $baseCount; $i++) {
            $unitLocator->set(new Base());
        }

        return $unitLocator;
    }
}
