<?php

namespace Sichkarev\Task\Validators;

use Traversable;

/**
 * Interface ValidatorInterface
 *
 * @package Sichkarev\Task\Validators
 */
interface ValidatorInterface
{
    /**
     * @param Traversable $data
     * @return bool
     */
    public function isValid(Traversable $data): bool;

    /**
     * @return \Sichkarev\Task\Validators\BaseRule|null
     */
    public function getErrorRule(): ?BaseRule;
}
