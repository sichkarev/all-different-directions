<?php

namespace Sichkarev\Task\Parsers;

use Sichkarev\Task\Models\BaseRow;
use Sichkarev\Task\Models\TextRow;

/**
 * Class TextParser
 *
 * @package Sichkarev\Task\Parsers
 */
final class TextParser extends BaseParser
{
    /**
     * @param mixed|null $row
     * @return \Sichkarev\Task\Models\BaseRow
     */
    public function parseRow($row): BaseRow
    {
        $row = trim($row);

        return new TextRow($row);
    }
}
