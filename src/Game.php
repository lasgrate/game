<?php

namespace Game;

use Game\Unit\UnitInterface;

class Game
{
    protected $map;

    protected $unitLocator;

    protected $rule;

    protected $logger;

    public function __construct(Map $map, UnitLocator $unitLocator, Rule $rule, Logger $logger)
    {
        $this->map = $map;
        $this->unitLocator = $unitLocator;
        $this->rule = $rule;
        $this->logger = $logger;
    }

    public function run(): bool
    {
        /** @var UnitInterface $unit */
        foreach ($this->unitLocator as $unit) {
            if ($this->isMapFullWithUnit($unit)) {
                $this->logger->log("Too many units with type {$unit} for map", E_NOTICE);
                return false;
            }

            do {
                $location = $this->map->getRandomLocation();
            } while ($this->unitLocator->has($location) || !$this->canMoveUnit($unit, $location));

            $this->logger->log("Move unit {$unit->getUnitIdentifier()} to $location", E_USER_NOTICE);
            $unit->move($location);
        }

        return true;
    }

    protected function isMapFullWithUnit(UnitInterface $unit): bool
    {
        foreach ($this->map as $location) {
            $isLocationFree = !$this->unitLocator->has($location);
            $canMoveUnit = $this->canMoveUnit($unit, $location);

            if ($isLocationFree && $canMoveUnit) {
                return false;
            }
        }

        return true;
    }

    protected function canMoveUnit($unit, $location): bool
    {
        return $this->rule->canMoveUnitOnRelief($unit, $this->map->getRelief($location));
    }
}
