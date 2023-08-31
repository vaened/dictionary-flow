<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\DictionaryParser\Specifications;

use Vaened\DictionaryParser\Specification;
use Vaened\DictionaryParser\Value;

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
