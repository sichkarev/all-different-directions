<?php

namespace Sichkarev\Task\Validators\TaskLogicValidator\Traits;

/**
 * Trait PeopleRulesTrait
 *
 * @package Sichkarev\Task\Validators\TaskLogicValidator\Traits
 */
trait PeopleRulesTrait
{
    /**
     * @return bool
     */
    private function currentRowIsNumberPeople(): bool
    {
        return preg_match('/^\d+$/m', $this->getRowValue()) === 1;
    }

    /**
     * @return bool
     */
    private function currentRowIsZeroPeople(): bool
    {
        return $this->getRowValue() === '0';
    }
}
