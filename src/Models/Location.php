<?php

namespace Sichkarev\Task\Models;

/**
 * Class Location
 *
 * @package Sichkarev\Task\Models
 */
class Location
{
    private float $x;

    private float $y;

    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX(): float
    {
        return $this->x;
    }

    public function getY(): float
    {
        return $this->y;
    }
}
