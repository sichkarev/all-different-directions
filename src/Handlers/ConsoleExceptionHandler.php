<?php

namespace Sichkarev\Task\Handlers;

use Throwable;

/**
 * Class ConsoleExceptionHandler
 *
 * @package Sichkarev\Task\Handlers
 */
class ConsoleExceptionHandler implements ExceptionHandlerInterface
{
    /**
     * {@inheritDoc}
     */
    public function handle(Throwable $e): void
    {
        echo implode(PHP_EOL, [
            $e->getMessage(),
            $e->getTraceAsString(),
            $e->getPrevious() ? $e->getPrevious()->getMessage() : '',
        ]);
    }
}
