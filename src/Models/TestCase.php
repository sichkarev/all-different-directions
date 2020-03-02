<?php

namespace Sichkarev\Task\Models;


/**
 * Class TestCase
 *
 * @package Sichkarev\Task\Models
 */
class TestCase
{
    /**
     * @var Route[]
     */
    private array $routes = [];

    public function addRoute(Route $route): void
    {
        $this->routes[] = $route;
    }

    /**
     * @return \Sichkarev\Task\Models\Route[]
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function getAvgDestination(): Location
    {
        $x = [];
        $y = [];

        /** @var Route $route */
        foreach ($this->routes as $route) {
            $route->calculate();

            $destination = $route->getCurrentLocation();
            $x[] = $destination->getX();
            $y[] = $destination->getY();
        }

        $count = count($this->routes);

        $avgX = array_sum($x) / $count;
        $avgY = array_sum($y) / $count;

        return new Location($avgX, $avgY);
    }

    public function getWorstDestinationsDistance(Location $avgDestination): float
    {
        $distance = 0;

        /** @var Route $route */
        foreach ($this->routes as $route) {
            $destination = $route->getCurrentLocation();
            $x = $avgDestination->getX() - $destination->getX();
            $y = $avgDestination->getY() - $destination->getY();

            $hypotenuse = hypot($x, $y);
            $distance = max($distance, $hypotenuse);
        }

        return floatval($distance);
    }
}