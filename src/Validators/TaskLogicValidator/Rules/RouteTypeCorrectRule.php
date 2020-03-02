<?php

namespace Sichkarev\Task\Validators\TaskLogicValidator\Rules;

use Sichkarev\Task\Enums\RouteTypeEnum;
use Sichkarev\Task\Validators\BaseRule;
use Sichkarev\Task\Validators\TaskLogicValidator\Traits\CoordinatesRulesTrait;

/**
 * Class RouteTypeCorrectRule
 *
 * @package Sichkarev\Task\Validators\TaskLogicValidators\Rules
 */
class RouteTypeCorrectRule extends BaseRule
{
    use CoordinatesRulesTrait;

    /**
     * {@inheritDoc}
     */
    public function isValid(): bool
    {
        while ($this->valid()) {
            if ($this->currentRowIsContainCoordinates() && !$this->isCorrectRoutes()) {
                return false;
            }

            $this->nextRow();
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function getErrorMessage(): string
    {
        return 'Check instructions for correct action name';
    }

    /**
     * @return bool
     */
    private function isCorrectRoutes(): bool
    {
        $matches = [];
        preg_match_all('/[a-z]+/', $this->getRowValue(), $matches);

        return !$matches || array_filter(current($matches), function ($route) {
            return !in_array($route, [RouteTypeEnum::START, RouteTypeEnum::TURN, RouteTypeEnum::WALK], true);
        }) === [];
    }
}
