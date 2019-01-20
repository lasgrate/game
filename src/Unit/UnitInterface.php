<?php

namespace Game\Unit;

use Game\Location;

interface UnitInterface
{
    public static function getUnitType();

    public function getUnitIdentifier(): string;

    public function move(Location $location): void;

    public function getLocation(): ?Location;
}
