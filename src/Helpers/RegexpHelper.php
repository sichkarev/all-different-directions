<?php

namespace Sichkarev\Task\Helpers;

/**
 * Class RegexpHelper
 *
 * @package Sichkarev\Task\Helpers
 */
abstract class RegexpHelper
{
    /**
     * All numeric inputs are real numbers in the range [−1000,1000]
     */
    public const NUMBER = '(?<number>[+-]?(0|[123456789]|[123456789]\d|[123456789]\d\d|1000))';

    /**
     * with at most four digits past the decimal
     */
    public const CORRECT_FLOAT = self::NUMBER .
                                 '(?<float>\.([0123456789]|[0123456789]\d|[0123456789]\d\d|[0123456789]\d\d\d))?\b';

    /**
     * Check any floats values
     */
    public const ALL_FLOAT = '([+-]?([0-9]*[.])?[0-9]+)';

    public const TYPE = '(?<type>([a-z]+))';
}
