<?php

namespace Sichkarev\Task\Validators\TaskLogicValidator\Rules;

use Sichkarev\Task\Enums\RouteTypeEnum;
use Sichkarev\Task\Helpers\RegexpHelper;
use Sichkarev\Task\Validators\BaseRule;
use Sichkarev\Task\Validators\TaskLogicValidator\Traits\CoordinatesRulesTrait;

/**
 * Class FirstWordRule
 *
 * @package Sichkarev\Task\Validators\TaskLogicValidators\Rules
 */
class FirstWordRule extends BaseRule
{
    use CoordinatesRulesTrait;

    /**
     * {@inheritDoc}
     */
    public function isValid(): bool
    {
        while ($this->valid()) {
            if ($this->currentRowIsContainCoordinates() && !$this->isRowContainsStartAtBeginningOnly()) {
                return false;
            }

            $this->nextRow();
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function getErrorMessage(): string
    {
        return 'The ‘start’ instruction is always the first instruction, and only occurs at the beginning';
    }

    /**
     * @return bool
     */
    private function isRowContainsStartAtBeginningOnly(): bool
    {
        $matches = [];
        $pattern = sprintf("/^%s %s %s/", RegexpHelper::ALL_FLOAT, RegexpHelper::ALL_FLOAT, RegexpHelper::TYPE);

        preg_match($pattern, $this->getRowValue(), $matches);

        return ($matches['type'] ?? false) && $matches['type'] === RouteTypeEnum::START &&
               substr_count($this->getRowValue(), RouteTypeEnum::START) === 1;
    }
}
