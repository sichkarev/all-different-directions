<?php

namespace Sichkarev\Task\Models;

/**
 * Class TextRow
 *
 * @package Sichkarev\Task\Models
 */
class TextRow extends BaseRow
{
    /**
     * {@inheritDoc}
     */
    public function getStringValue(): string
    {
        return $this->row;
    }
}
