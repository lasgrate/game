<?php

namespace Game\Unit;

use Game\Location;

class Base extends Unit
{
    protected $availableStatuses = [
        'destroyed',
        'operative',
    ];

    protected $humans;

    protected $combatVehicles;

    protected $planes;

    public function __construct(Location $location = null)
    {
        parent::__construct(uniqid('base'), $location);
    }

    public function addHuman(Human $human): void
    {
        $this->humans[] = $human;
    }

    public function addCombatVehicle(CombatVehicle $combatVehicle): void
    {
        $this->combatVehicles[] = $combatVehicle;
    }

    public function addPlane(Plane $plane): void
    {
        $this->planes[] = $plane;
    }
}
