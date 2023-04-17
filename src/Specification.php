<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CollectionEvaluator;

interface Specification
{
    public function isSatisfiedBy(Value $value): bool;

    public function parse(Value $value): mixed;
}