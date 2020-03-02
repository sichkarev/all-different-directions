<?php

namespace Sichkarev\Task\Validators\TaskLogicValidator\Rules;

use Sichkarev\Task\Helpers\RegexpHelper;
use Sichkarev\Task\Validators\BaseRule;
use Sichkarev\Task\Validators\TaskLogicValidator\Traits\CoordinatesRulesTrait;

/**
 * Class NumericInputValidRule
 *
 * @package Sichkarev\Task\Validators\TaskLogicValidators\Rules
 */
class NumericInputValidRule extends BaseRule
{
    use CoordinatesRulesTrait;

    /**
     * {@inheritDoc}
     */
    public function isValid(): bool
    {
        while ($this->valid()) {
            if ($this->currentRowIsContainCoordinates() && !$this->isCorrectRowValues()) {
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
        return 'All numeric inputs are real numbers in the range [−1000,1000] with at most four digits past the decimal';
    }

    private function isCorrectRowValues(): bool
    {
        $matches = [];
        $pattern = sprintf('/%s/', RegexpHelper::ALL_FLOAT);

        preg_match_all($pattern, $this->getRowValue(), $matches);

        if (!count($matches)) {
            return false;
        }

        foreach (current($matches) as $value) {
            if (preg_match(sprintf('/^%s$/', RegexpHelper::CORRECT_FLOAT), $value) !== 1) {
                return false;
            }
        }

        return true;
    }
}
