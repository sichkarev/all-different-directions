<?php

namespace Sichkarev\Task\Models;

use Sichkarev\Task\Commands\BaseCommand;

/**
 * Class Route
 *
 * @package Sichkarev\Task\Models
 */
final class Route
{
    private string $row;

    /**
     * @var \Sichkarev\Task\Commands\BaseCommand[]
     */
    private array $commands = [];

    private Location $currentLocation;

    private float $angle;

    /**
     * Route constructor.
     */
    public function __construct(string $row)
    {
        $this->row = $row;
    }

    public function getCurrentLocation(): Location
    {
        return $this->currentLocation;
    }

    public function setCurrentLocation(Location $currentLocation): void
    {
        $this->currentLocation = $currentLocation;
    }

    public function getRow(): string
    {
        return $this->row;
    }

    public function getAngle(): ?int
    {
        return $this->angle;
    }

    public function setAngle(?int $angle): void
    {
        $this->angle = $angle;
    }

    public function addCommand(BaseCommand $command): void
    {
        $this->commands[] = $command;
    }

    public function calculate(): void
    {
        /** @var BaseCommand $command */
        foreach ($this->commands as $command) {
            $command->executeRoute($this);
        }
    }
}
