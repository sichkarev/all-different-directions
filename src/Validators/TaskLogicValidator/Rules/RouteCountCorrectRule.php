<?php

namespace Sichkarev\Task\Validators\TaskLogicValidator\Rules;

use Sichkarev\Task\Validators\BaseRule;
use Sichkarev\Task\Validators\TaskLogicValidator\Traits\CoordinatesRulesTrait;

/**
 * Class RouteCountCorrectRule
 *
 * @package Sichkarev\Task\Validators\TaskLogicValidators\Rules
 */
class RouteCountCorrectRule extends BaseRule
{
    use CoordinatesRulesTrait;

    /**
     * {@inheritDoc}
     */
    public function isValid(): bool
    {
        while ($this->valid()) {
            if ($this->currentRowIsContainCoordinates() && !$this->isCorrectRoutes()) {
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
        return 'ach person’s directions contain at most 25 instructions';
    }

    /**
     * @return bool
     */
    private function isCorrectRoutes(): bool
    {
        $matches = [];
        preg_match_all('/[a-z]+/', $this->getRowValue(), $matches);
        $count = count(current($matches));

        return $count > 0 && $count <= 25;
    }
}
