<?php

namespace Sichkarev\Task\Validators\TaskLogicValidator;

use Sichkarev\Task\Validators\BaseValidator;
use Traversable;

/**
 * Class TaskLogicValidator
 *
 * @package Sichkarev\Task\Validators\TaskLogicValidator
 */
class TaskLogicValidator extends BaseValidator
{
    /**
     * {@inheritDoc}
     */
    public function isValid(Traversable $data): bool
    {
        foreach ($this->rules as $rule) {
            if (!$this->validateRule($rule, $data)) {
                return false;
            }
        }

        return true;
    }
}
