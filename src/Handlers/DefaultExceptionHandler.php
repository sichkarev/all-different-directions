<?php

namespace Sichkarev\Task\Handlers;

use Sichkarev\Task\Exceptions\ApplicationException;
use Throwable;

/**
 * Class DefaultExceptionHandler
 *
 * @package Sichkarev\Task\Handlers
 */
class DefaultExceptionHandler implements ExceptionHandlerInterface
{
    /**
     * @return mixed
     * @throws \Sichkarev\Task\Exceptions\ApplicationException
     */
    public function handle(Throwable $e): void
    {
        throw new ApplicationException($e);
    }
}
