<?php

namespace Sichkarev\Task\Commands;

use Sichkarev\Task\Enums\RouteTypeEnum;
use Sichkarev\Task\Models\Route;

/**
 * Class StartCommand
 *
 * @package Sichkarev\Task\Commands
 */
class StartCommand extends BaseCommand
{
    public static function getCommandName(): string
    {
        return RouteTypeEnum::START;
    }

    public function execute(Route $route): void
    {
        $route->setAngle($this->getValue());
    }
}
