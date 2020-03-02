<?php

namespace Sichkarev\Task\Validators;

use Traversable;

/**
 * Class BaseValidator
 *
 * @package Sichkarev\Task\Validators
 */
abstract class BaseValidator implements ValidatorInterface
{
    /**
     * @var array
     */
    protected array $data = [];

    /**
     * @var \Sichkarev\Task\Validators\BaseRule[]
     */
    protected array $rules = [];

    private ?BaseRule $rule = null;

    /**
     * BaseValidator constructor.
     *
     * @param \Sichkarev\Task\Validators\BaseRule[] $rules
     */
    public function __construct(array $rules = [])
    {
        $this->rules = array_map(function (string $class) {
            return new $class;
        }, $rules);
    }

    abstract public function isValid(Traversable $data): bool;

    /**
     * {@inheritDoc}
     */
    final public function getErrorRule(): ?BaseRule
    {
        return $this->rule;
    }

    final protected function validateRule(BaseRule $rule, Traversable $data): bool
    {
        $this->rule = $rule;

        return $this->rule->setIterator($data)->isValid();
    }
}
