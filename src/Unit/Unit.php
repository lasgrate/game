<?php

namespace Game\Unit;

use InvalidArgumentException;
use Game\Location;

class Unit implements UnitInterface
{
    /**
     * Represent unit current status (alive, killed, destroyed, etc.)
     * @var string
     */
    private $status;

    private $location;

    protected $availableStatuses = [];

    protected $unitIdentifier;

    public function __construct(string $unitIdentifier, Location $location = null)
    {
        $this->unitIdentifier = $unitIdentifier;
        $this->location = $location;
    }

    public static function getUnitType(): string
    {
        return static::class;
    }

    public function move(Location $location): void
    {
        $this->location = $location;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    protected function setStatus(string $status): void
    {
        if (!isset($this->availableStatuses[$status])) {
            throw new InvalidArgumentException("Unavailable status $status");
        }

        $this->status = $status;
    }

    public function getUnitIdentifier(): string
    {
        return $this->unitIdentifier;
    }
}
