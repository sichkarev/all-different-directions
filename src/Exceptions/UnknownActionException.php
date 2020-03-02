<?php

namespace Sichkarev\Task\Exceptions;

use Exception;

/**
 * Class UnknownActionException
 *
 * @package Sichkarev\Task\Exceptions
 */
class UnknownActionException extends Exception implements TaskExceptionInterface
{
    /**
     * ValidatorException constructor.
     */
    public function __construct(string $action)
    {
        $text = sprintf('Unknown action: %s', $action);

        parent::__construct($text, 0, $this->getPrevious());
    }
}
