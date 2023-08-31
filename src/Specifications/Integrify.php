<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\DictionaryParser\Specifications;

use Vaened\DictionaryParser\Specification;
use Vaened\DictionaryParser\Value;

final class Integrify implements Specification
{
    public function isSatisfiedBy(Value $value): bool
    {
        return !$value->isEmpty() && ($value->isInteger() || $value->isFloat());
    }

    public function parse(Value $value): int
    {
        return (int)$value->primitive();
    }
}
