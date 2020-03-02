<?php

namespace Sichkarev\Task\Handlers;

use Throwable;

/**
 * Interface ExceptionHandlerInterface
 *
 * @package Sichkarev\Task\Handlers
 */
interface ExceptionHandlerInterface
{
    public function handle(Throwable $e): void;
}
