<?php

namespace Sichkarev\Task\Commands;

use Sichkarev\Task\Enums\RouteTypeEnum;
use Sichkarev\Task\Models\Location;
use Sichkarev\Task\Models\Route;

/**
 * Class WalkCommand
 *
 * @package Sichkarev\Task\Commands
 */
class WalkCommand extends BaseCommand
{
    public static function getCommandName(): string
    {
        return RouteTypeEnum::WALK;
    }

    /**
     * {@inheritDoc}
     */
    public function execute(Route $route): void
    {
        $location = $this->getNewLocation($route);

        $route->setCurrentLocation($location);
    }

    private function getNewLocation(Route $route): Location
    {
        $currentLocation = $route->getCurrentLocation();

        $angle = $route->getAngle();
        $radians = deg2rad($angle);

        $x = $currentLocation->getX();
        $shift = $this->getValue() * cos($radians);
        $x += $shift;

        $y = $currentLocation->getY();
        $shift = $this->getValue() * sin($radians);
        $y += $shift;

        return new Location($x, $y);
    }
}
