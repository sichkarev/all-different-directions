<?php

namespace Sichkarev\Task\Validators\TaskLogicValidator\Rules;

use Sichkarev\Task\Validators\BaseRule;
use Sichkarev\Task\Validators\TaskLogicValidator\Traits\CoordinatesRulesTrait;

/**
 * Class EndLineRule
 *
 * @package Sichkarev\Task\Validators\TaskLogicValidators\Rules
 */
class EndLineRule extends BaseRule
{
    use CoordinatesRulesTrait;

    /**
     * {@inheritDoc}
     */
    public function isValid(): bool
    {
        $this->end();

        return $this->isCorrectValue();
    }

    /**
     * {@inheritDoc}
     */
    public function getErrorMessage(): string
    {
        return 'Input must ends when n is zero. Check last item in input file.';
    }

    /**
     * @return bool
     */
    private function isCorrectValue(): bool
    {
        return $this->getRowValue() === '0';
    }
}
