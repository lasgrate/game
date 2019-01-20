<?php

namespace Game;

use ArrayIterator;
use Game\Unit\UnitInterface;
use InvalidArgumentException;
use IteratorAggregate;

class UnitLocator implements IteratorAggregate
{
    /**
     * @var UnitInterface[]
     */
    protected $units;

    public function set(UnitInterface $unit)
    {
        if ($unit->getLocation() && $this->has($unit->getLocation())) {
            throw new InvalidArgumentException("There is already unit on location: {$unit->getLocation()}");
        }

        $this->units[] = $unit;
    }

    public function get(Location $location): ?UnitInterface
    {
        /** @var UnitInterface $unit */
        foreach ($this as $unit) {
            if ($unit->getLocation()->isEqual($location)) {
                return $unit;
            }
        }

        throw new InvalidArgumentException("No unit found on location: $location");
    }

    public function has(Location $location)
    {
        foreach ($this->units as $unit) {
            if (!$unit->getLocation()) {
                continue;
            }

            if ($unit->getLocation()->isEqual($location)) {
                return true;
            }
        }

        return false;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->units);
    }
}
