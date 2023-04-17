<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CollectionEvaluator\Specifications;

use Vaened\CollectionEvaluator\Specification;
use Vaened\CollectionEvaluator\Value;

final class Decimalizer implements Specification
{
    public function isSatisfiedBy(Value $value): bool
    {
        return !$value->isEmpty() && ($value->isInteger() || $value->isFloat());
    }

    public function parse(Value $value): float
    {
        return (float)$value->primitive();
    }
}
