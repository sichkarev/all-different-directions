<?php

namespace Sichkarev\Task\Parsers;

use Sichkarev\Task\Models\BaseRow;

/**
 * Abstract class BaseParser
 *
 * @package Sichkarev\Task\Parsers
 */
abstract class BaseParser implements ParserInterface
{
    /**
     * @param mixed|null $row
     * @return \Sichkarev\Task\Models\BaseRow
     */
    abstract public function parseRow($row): BaseRow;
}
