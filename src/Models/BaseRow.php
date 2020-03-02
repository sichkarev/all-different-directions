<?php

namespace Sichkarev\Task\Models;

/**
 * Abstract class BaseRow
 *
 * @package Sichkarev\Task\Models
 */
abstract class BaseRow
{
    /**
     * @var mixed|null
     */
    protected $row;

    /**
     * BaseRow constructor.
     *
     * @param mixed|null $row
     */
    public function __construct($row)
    {
        $this->row = $row;
    }

    abstract public function getStringValue(): string;
}
