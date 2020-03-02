<?php

namespace Sichkarev\Task\Commands;

use Sichkarev\Task\Models\Location;
use Sichkarev\Task\Models\Route;

/**
 * Abstract class BaseCommand
 *
 * @package Sichkarev\Task\Commands
 */
abstract class BaseCommand
{
    private string $action;

    private float $value = 0.0;

    abstract public static function getCommandName(): string;

    public function parse(string $text): void
    {
        [$this->action, $this->value] = explode(' ', $text);
    }

    final public function executeRoute(Route $route): void
    {
        $this->execute($route);
    }

    abstract protected function execute(Route $route): void;

    public function getAction(): string
    {
        return $this->action;
    }

    public function getValue(): float
    {
        return $this->value;
    }
}
