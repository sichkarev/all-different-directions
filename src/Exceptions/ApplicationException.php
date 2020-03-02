<?php

namespace Sichkarev\Task\Exceptions;

use Exception;
use Throwable;

/**
 * Class ApplicationException
 *
 * @package Sichkarev\Task\Exceptions
 */
class ApplicationException extends Exception implements TaskExceptionInterface
{
    public function __construct(?Throwable $previous = null)
    {
        parent::__construct('Error run application', 0, $previous);
    }
}
