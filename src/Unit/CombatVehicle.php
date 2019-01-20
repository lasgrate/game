<?php

namespace Game\Unit;

use Game\Location;

class CombatVehicle extends Unit
{
    protected $availableStatuses = [
        'destroyed',
        'operative',
    ];

    public function __construct(Location $location = null)
    {
        parent::__construct(uniqid('combat-vehicle'), $location);
    }

    public function kill(): void
    {
        $this->setStatus('destroyed');
    }

    public function killHuman(Human $human): void
    {
        $human->kill();
    }

    public function killCombatVehicle(CombatVehicle $combatVehicle): void
    {
        $combatVehicle->kill();
    }
}
