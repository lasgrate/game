<?php

namespace Game;

use InvalidArgumentException;
use IteratorAggregate;

class Map implements IteratorAggregate
{
    const DOWNCOUNTRY = 'downcountry';
    const MOUNTAIN = 'mountain';
    const WATER = 'water';
    const SWAMP = 'swamp';

    protected $map;

    private $width;

    private $length;

    public function __construct(int $width, int $length)
    {
        $this->width = $width;
        $this->length = $length;
        $this->makeMapBlank();
    }

    protected function makeMapBlank()
    {
        for ($x = 0; $x < $this->width; $x++) {
            for ($y = 0; $y < $this->length; $y++) {
                $this->map[$x][$y] = -1;
            }
        }
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function isLocationExist(Location $location): bool
    {
        return isset($this->map[$location->getX()][$location->getY()]);
    }

    public function isLocationBlank(Location $location): bool
    {
        return $this->map[$location->getX()][$location->getY()] == -1;
    }

    public static function isReliefExist($relief)
    {
        return in_array($relief, [
            self::DOWNCOUNTRY,
            self::MOUNTAIN,
            self::WATER,
            self::SWAMP
        ]);
    }

    public function getRelief(Location $location)
    {
        if (!$this->isLocationExist($location)) {
            throw new InvalidArgumentException("Undefined location: $location");
        }

        return $this->map[$location->getX()][$location->getY()];
    }

    public function setRelief(Location $location, string $relief, $overwriteLocation = true): void
    {
        if (!self::isReliefExist($relief)) {
            throw new InvalidArgumentException("Undefined relief $relief");
        }

        if (!$this->isLocationExist($location)) {
            throw new InvalidArgumentException("Undefined location: $location");
        }

        if (!$this->isLocationBlank($location) && !$overwriteLocation) {
            throw new InvalidArgumentException("Location not blank: $location");
        }

        $this->map[$location->getX()][$location->getY()] = $relief;
    }

    public function getIterator()
    {
        for ($x = 0; $x < $this->width; $x++) {
            for ($y = 0; $y < $this->length; $y++) {
                yield new Location($x, $y);
            }
        }
    }

    public function getRandomLocation(): Location
    {
        return new Location(rand(0, $this->width - 1), rand(0, $this->length - 1));
    }
}
