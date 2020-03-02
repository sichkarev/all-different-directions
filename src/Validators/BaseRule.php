<?php

namespace Sichkarev\Task\Validators;

use Sichkarev\Task\Models\BaseRow;
use Traversable;

/**
 * Class BaseRule
 *
 * @package Sichkarev\Task\Validators
 */
abstract class BaseRule
{
    private Traversable $iterator;

    /**
     * @return \Sichkarev\Task\Validators\BaseRule
     */
    final public function setIterator(Traversable $iterator): self
    {
        $this->iterator = $iterator;

        $this->iterator->rewind();

        return $this;
    }

    public function getRowValue(): ?string
    {
        return $this->getCurrentRow() ? $this->getCurrentRow()->getStringValue() : null;
    }

    protected function getCurrentRow(): ?BaseRow
    {
        return $this->iterator->current();
    }

    abstract public function isValid(): bool;

    abstract public function getErrorMessage(): string;

    final protected function valid(): bool
    {
        return $this->iterator->valid();
    }

    final protected function end(): void
    {
        $this->iterator->seek($this->iterator->count() - 1);
    }

    protected function nextRow(): void
    {
        $this->iterator->next();
    }
}
