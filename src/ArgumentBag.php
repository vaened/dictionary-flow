<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CollectionEvaluator;

use Vaened\Support\Types\ArrayObject;

final class ArgumentBag extends ArrayObject
{
    protected function type(): string
    {
        return Argument::class;
    }
}
