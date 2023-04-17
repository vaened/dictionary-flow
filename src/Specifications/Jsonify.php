<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CollectionEvaluator\Specifications;

use Vaened\CollectionEvaluator\Specification;
use Vaened\CollectionEvaluator\Value;

use function json_decode;

final class Jsonify implements Specification
{
    public function isSatisfiedBy(Value $value): bool
    {
        return (!$value->isEmpty() && $value->isString()) || $value->isArray();
    }

    public function parse(Value $value): array
    {
        if ($value->isArray()) {
            return $value->primitive();
        }

        return json_decode((string)$value->primitive());
    }
}
