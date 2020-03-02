<?php

namespace Sichkarev\Task\Models;

/**
 * Class Point
 *
 * @package Sichkarev\Task\Models
 */
class Point
{
    private float $x;

    private float $y;

    /**
     * Point constructor.
     */
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
