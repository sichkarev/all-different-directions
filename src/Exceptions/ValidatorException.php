<?php

namespace Sichkarev\Task\Exceptions;

use Exception;
use Sichkarev\Task\Validators\BaseRule;

/**
 * Class ValidatorException
 *
 * @package Sichkarev\Task\Exceptions
 */
class ValidatorException extends Exception implements TaskExceptionInterface
{
    /**
     * ValidatorException constructor.
     */
    public function __construct(BaseRule $rule)
    {
        $text = sprintf('Error validate row: %s', implode(PHP_EOL, [$rule->getErrorMessage(), $rule->getRowValue()]));

        parent::__construct($text, 0, $this->getPrevious());
    }
}
