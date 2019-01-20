<?php

namespace Game;

class Location
{
    protected $x;

    protected $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function isEqual(Location $location): bool
    {
        return $location->getX() == $this->getX()
            && $location->getY() == $this->getY();
    }

    public function __toString(): string
    {
        return "x - {$this->getX()}, y - {$this->getY()}";
    }
}
