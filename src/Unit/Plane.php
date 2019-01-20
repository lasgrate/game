<?php

namespace Game\Unit;

use Game\Location;

class Plane extends Unit
{
    protected $availableStatuses = [
        'destroyed',
        'operative',
    ];

    public function __construct(Location $location = null)
    {
        parent::__construct(uniqid('aircraft'), $location);
    }

    public function kill(): void
    {
        $this->setStatus('destroyed');
    }

    public function killCombatVehicle(CombatVehicle $combatVehicle): void
    {
        $combatVehicle->kill();
    }
}
