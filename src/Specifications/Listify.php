<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\DictionaryParser\Specifications;

use Vaened\DictionaryParser\Specification;
use Vaened\DictionaryParser\Value;

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
