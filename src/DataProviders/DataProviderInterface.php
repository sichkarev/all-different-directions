<?php

namespace Sichkarev\Task\DataProviders;

use Traversable;

/**
 * Interface DataProviderInterface
 *
 * @package Sichkarev\Task\DataProviders
 */
interface DataProviderInterface
{
    public function getData(): Traversable;
}
