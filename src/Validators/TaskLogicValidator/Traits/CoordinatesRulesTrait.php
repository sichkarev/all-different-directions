<?php

namespace Sichkarev\Task\Validators\TaskLogicValidator\Traits;

use Sichkarev\Task\Helpers\RegexpHelper;

/**
 * Trait CoordinatesRulesTrait
 *
 * @package Sichkarev\Task\Validators\TaskLogicValidator\Traits
 */
trait CoordinatesRulesTrait
{
    /**
     * @return bool
     */
    private function currentRowIsContainCoordinates(): bool
    {
        return preg_match(
            '/^' . RegexpHelper::ALL_FLOAT . ' ' . RegexpHelper::ALL_FLOAT . '/',
            $this->getRowValue()
        ) === 1;
    }
}
