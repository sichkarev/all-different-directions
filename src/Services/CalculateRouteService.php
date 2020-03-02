<?php

namespace Sichkarev\Task\Services;

use Sichkarev\Task\Models\ResultData;
use Sichkarev\Task\Models\TestCase;

/**
 * Class CalculateRouteService
 *
 * @package Sichkarev\Task\Services
 */
class CalculateRouteService extends BaseService
{
    /**
     * @param \Sichkarev\Task\Models\TestCase $testCase
     * @return \Sichkarev\Task\Models\ResultData
     * @throws \Exception
     */
    protected function getResultData(TestCase $testCase): ResultData
    {
        $avgDestination = $testCase->getAvgDestination();
        $distance = $testCase->getWorstDestinationsDistance($avgDestination);

        return new ResultData($avgDestination->getX(), $avgDestination->getY(), $distance);
    }
}
