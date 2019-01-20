<?php

namespace Game\Unit;

use Game\Location;

class Human extends Unit
{
    protected $availableStatuses = [
        'alive',
        'killed',
    ];

    public function __construct(Location $location = null)
    {
        parent::__construct(uniqid('human'), $location);
    }

    public function kill(): void
    {
        $this->setStatus('killed');
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
