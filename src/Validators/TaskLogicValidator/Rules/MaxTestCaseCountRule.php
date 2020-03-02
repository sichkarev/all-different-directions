<?php


namespace Sichkarev\Task\Validators\TaskLogicValidator\Rules;

use Sichkarev\Task\Validators\BaseRule;
use Sichkarev\Task\Validators\TaskLogicValidator\Traits\PeopleRulesTrait;

/**
 * Class MaxTestCaseCountRule
 *
 * @package Sichkarev\Task\Validators\TaskLogicValidators\Rules
 */
class MaxTestCaseCountRule extends BaseRule
{
    use PeopleRulesTrait;

    private int $count = 0;

    private int $maxCount = 100;

    /**
     * {@inheritDoc}
     */
    public function isValid(): bool
    {
        while ($this->valid()) {
            if ($this->currentRowIsNumberPeople()) {
                $this->count++;
            }

            $this->nextRow();
        }

        return $this->count <= $this->maxCount;
    }

    /**
     * {@inheritDoc}
     */
    public function getErrorMessage(): string
    {
        return 'Input consists of up to 100 test cases';
    }
}
