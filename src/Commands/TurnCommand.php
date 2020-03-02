<?php

namespace Sichkarev\Task\Commands;

use Sichkarev\Task\Enums\RouteTypeEnum;
use Sichkarev\Task\Models\Route;

/**
 * Class TurnCommand
 *
 * @package Sichkarev\Task\Commands
 */
class TurnCommand extends BaseCommand
{
    public static function getCommandName(): string
    {
        return RouteTypeEnum::TURN;
    }

    public function execute(Route $route): void
    {
        $route->setAngle($route->getAngle() + $this->getValue());
    }
}
