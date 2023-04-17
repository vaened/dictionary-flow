<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CollectionEvaluator\Specifications;

use Vaened\CollectionEvaluator\Specification;
use Vaened\CollectionEvaluator\Value;

final class Stringify implements Specification
{
    public function isSatisfiedBy(Value $value): bool
    {
        return !$value->isEmpty();
    }

    public function parse(Value $value): string
    {
        return (string)$value->primitive();
    }
}
