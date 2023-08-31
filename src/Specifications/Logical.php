<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\DictionaryParser\Specifications;

use Vaened\DictionaryParser\Specification;
use Vaened\DictionaryParser\Value;

use function in_array;
use function strtolower;

final class Logical implements Specification
{
    public function isSatisfiedBy(Value $value): bool
    {
        return $value->isNull() ||
            $value->isBoolean() ||
            in_array($value->primitive(), ['true', 'false', 1, 0]);
    }

    public function parse(Value $value): bool
    {
        if ($value->isNull()) {
            return false;
        }

        if ($value->isString()) {
            return strtolower((string)$value->primitive()) === 'true';
        }

        if ($value->isInteger() || $value->isFloat()) {
            return 1 == $value->primitive();
        }

        return $value->isBoolean() ? $value->primitive() : false;
    }
}
