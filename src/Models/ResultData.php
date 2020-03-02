<?php

namespace Sichkarev\Task\Models;

/**
 * Class ResultData
 *
 * @package Sichkarev\Task\Models
 */
class ResultData
{
    private float $x;

    private float $y;

    private float $distance;

    /**
     * ResultData constructor.
     */
    public function __construct(float $x, float $y, float $distance)
    {
        $this->x = $x;
        $this->y = $y;
        $this->distance = $distance;
    }

    public function getX(): float
    {
        return $this->x;
    }

    public function getY(): float
    {
        return $this->y;
    }

    public function getDistance(): float
    {
        return $this->distance;
    }
}
