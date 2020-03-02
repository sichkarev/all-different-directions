<?php

namespace Sichkarev\Task\Validators\TaskLogicValidator\Rules;

use Sichkarev\Task\Validators\BaseRule;
use Sichkarev\Task\Validators\TaskLogicValidator\Traits\PeopleRulesTrait;

/**
 * Class TestCaseCountPeopleRule
 *
 * @package Sichkarev\Task\Validators\TaskLogicValidators\Rules
 */
class TestCaseCountPeopleRule extends BaseRule
{
    use PeopleRulesTrait;

    private int $realPeopleCount = 0;

    private int $peopleCount = 0;

    private int $min = 1;

    private int $max = 20;

    /**
     * {@inheritDoc}
     */
    public function isValid(): bool
    {
        while ($this->valid()) {
            /**
             * @var \Sichkarev\Task\Models\BaseRow $row
             */
            $value = $this->getRowValue();

            if (!$value) {
                return false;
            }

            if ($this->currentRowIsNumberPeople() && !$this->currentRowIsZeroPeople()) {
                $this->realPeopleCount = 0;
                $this->peopleCount = intval($value);

                if ($value < $this->min || $value > $this->max) {
                    return false;
                }
            } elseif (!$this->checkCompletePeopleCount()) {
                return false;
            } elseif (!$this->currentRowIsZeroPeople()) {
                $this->realPeopleCount++;
            }

            $this->nextRow();

            //Input must ends when n is zero. Check last item in input file.
            if ($this->getRowValue() === '0') {
                return true;
            }

            //если начался новый блок, но количество указанных людей не равно фактически указанному количеству
            if ($this->valid() && $this->currentRowIsNumberPeople() && $this->realPeopleCount !== $this->peopleCount) {
                return false;
            }
        }

        return $this->realPeopleCount <= $this->peopleCount && $this->checkCompletePeopleCount();
    }

    private function checkCompletePeopleCount(): bool
    {
        return $this->peopleCount && $this->realPeopleCount <= $this->peopleCount;
    }

    /**
     * {@inheritDoc}
     */
    public function getErrorMessage(): string
    {
        return 'Each test case starts with an integer 1≤n≤20, which is the number of people you ask for directions';
    }
}
