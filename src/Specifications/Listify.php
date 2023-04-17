<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CollectionEvaluator\Specifications;

use Vaened\CollectionEvaluator\Specification;
use Vaened\CollectionEvaluator\Value;

final class Listify implements Specification
{
    public function isSatisfiedBy(Value $value): bool
    {
        return $value->isArray();
    }

    public function parse(Value $value): array
    {
        return $value->primitive();
    }
}
