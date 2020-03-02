<?php

namespace Sichkarev\Task\Services;

use ArrayIterator;
use Sichkarev\Task\Commands\BaseCommand;
use Sichkarev\Task\Exceptions\UnknownActionException;
use Sichkarev\Task\Helpers\RegexpHelper;
use Sichkarev\Task\Models\BaseRow;
use Sichkarev\Task\Models\Location;
use Sichkarev\Task\Models\ResultData;
use Sichkarev\Task\Models\Route;
use Sichkarev\Task\Models\TestCase;

/**
 * Abstract class BaseService
 *
 * @package Sichkarev\Task\Services
 */
abstract class BaseService
{
    /**
     * @var \Sichkarev\Task\Models\TestCase[]
     */
    private array $testCases;

    /**
     * @var \Sichkarev\Task\Commands\BaseCommand[]
     */
    private array $commands;

    /**
     * BaseService constructor.
     *
     * @param array|\Sichkarev\Task\Commands\BaseCommand[] $commands
     */
    public function __construct(array $commands)
    {
        $this->commands = $commands;
    }

    /**
     * @return array|ResultData[]
     * @throws \Exception
     */
    public function calculate(ArrayIterator $data): array
    {
        $this->addTestCases($data);

        $results = [];

        foreach ($this->testCases as $testCase) {
            $this->fillCommandsToRoute($testCase);
            $results[] = $this->getResultData($testCase);
        }

        return $results;
    }

    private function addTestCases(ArrayIterator $data): void
    {
        $data->rewind();

        while ($data->valid()) {
            /**
             * @var BaseRow $row
             */
            $row = $data->current();
            if ($this->currentRowIsNumberPeople($row)) {
                $testCase = new TestCase();
                $data->next();

                for ($i = 0; $i < $row->getStringValue(); $i++) {
                    $testCase->addRoute(new Route($data->current()->getStringValue()));
                    $data->next();
                }

                if ($testCase->getRoutes()) {
                    $this->addTestCase($testCase);
                }
            }
        }
    }

    private function currentRowIsNumberPeople(BaseRow $row): bool
    {
        return preg_match('/^\d+$/m', $row->getStringValue()) === 1;
    }

    final private function addTestCase(TestCase $testCase): void
    {
        $this->testCases[] = $testCase;
    }

    /**
     * @throws \Exception
     */
    protected function fillCommandsToRoute(TestCase $testCase): void
    {
        foreach ($testCase->getRoutes() as $route) {
            $point = $this->getCurrentLocationFromLine($route->getRow());
            $route->setCurrentLocation($point);

            $matches = [];
            $pattern = sprintf("/%s %s/", RegexpHelper::TYPE, RegexpHelper::ALL_FLOAT);
            preg_match_all($pattern, $route->getRow(), $matches);

            foreach ($matches[1] as $key => $nameCommand) {
                $command = $this->getCommandByName($nameCommand);
                $command->parse($matches[0][$key]);
                $route->addCommand($command);
            }
        }
    }

    protected function getCurrentLocationFromLine(string $row): Location
    {
        $pattern = sprintf("/^%s %s %s/", RegexpHelper::ALL_FLOAT, RegexpHelper::ALL_FLOAT, RegexpHelper::TYPE);

        preg_match($pattern, $row, $matches);

        return new Location($matches[1], $matches[3]);
    }

    /**
     * @return mixed
     * @throws \Sichkarev\Task\Exceptions\UnknownActionException
     */
    protected function getCommandByName(string $nameCommand): BaseCommand
    {
        if ($array = array_filter($this->getCommands(), function (BaseCommand $command) use ($nameCommand) {
            return $command->getCommandName() === $nameCommand;
        })) {
            /**
             * @var BaseCommand $command
             */
            return current($array);
        }

        throw new UnknownActionException($nameCommand);
    }

    /**
     * @return \Sichkarev\Task\Commands\BaseCommand[]
     */
    public function getCommands(): array
    {
        return array_map(function ($command) {
            return new $command;
        }, $this->commands);
    }

    abstract protected function getResultData(TestCase $testCase): ResultData;
}
