<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\DictionaryFlow\Specifications;

use Vaened\DictionaryFlow\Specification;
use Vaened\DictionaryFlow\Value;

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
