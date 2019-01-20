<?php

namespace Game;

use Game\Unit\Base;
use Game\Unit\CombatVehicle;
use Game\Unit\Human;
use Game\Unit\Plane;
use Game\Unit\UnitInterface;
use InvalidArgumentException;

class Rule
{
    protected function getUnitReliefs(): array
    {
        return [
            Human::getUnitType() => [
                Map::WATER,
                Map::MOUNTAIN,
                Map::DOWNCOUNTRY,
            ],
            Plane::getUnitType() => [
                Map::WATER,
                Map::MOUNTAIN,
                Map::DOWNCOUNTRY,
                Map::SWAMP,
            ],
            CombatVehicle::getUnitType() => [
                Map::DOWNCOUNTRY,
                Map::SWAMP,
            ],
            Base::getUnitType() => [
                Map::DOWNCOUNTRY,
            ]
        ];
    }

    public function canMoveUnitOnRelief(UnitInterface $unit, $relief): bool
    {
        if (!Map::isReliefExist($relief)) {
            throw new InvalidArgumentException("Undefined relief $relief");
        }

        $availableReliefs = $this->getUnitReliefs();
        $unitType = $unit::getUnitType();

        if (!isset($availableReliefs[$unitType])) {
            throw new InvalidArgumentException("No rules found for unit {$unitType}");
        }

        return in_array($relief, $availableReliefs[$unitType]);
    }
}
