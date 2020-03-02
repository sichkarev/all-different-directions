<?php

namespace Sichkarev\Task\Validators\TaskLogicValidator\Rules;

use Sichkarev\Task\Helpers\RegexpHelper;
use Sichkarev\Task\Validators\BaseRule;
use Sichkarev\Task\Validators\TaskLogicValidator\Traits\CoordinatesRulesTrait;

/**
 * Class RowStartWithFloatRule
 *
 * @package Sichkarev\Task\Validators\TaskLogicValidators\Rules
 */
class RowStartWithFloatRule extends BaseRule
{
    use CoordinatesRulesTrait;

    /**
     * {@inheritDoc}
     */
    public function isValid(): bool
    {
        while ($this->valid()) {
            if (!$this->isCorrectRowValues()) {
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
        return 'Check row data is correct';
    }

    private function isCorrectRowValues(): bool
    {
        $matches = [];
        $pattern = sprintf(
            '/^%s/',
            RegexpHelper::ALL_FLOAT
        );

        preg_match($pattern, $this->getRowValue(), $matches);

        if (!count($matches)) {
            return false;
        }

        return true;
    }
}
