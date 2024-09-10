<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\DictionaryFlow;

use function implode;

final class ValueStringify
{
    public static function stringify(Value $value): ?string
    {
        $primitive = $value->primitive();

        return match (true) {
            $value->isNull() => null,
            $value->isBoolean() => $primitive ? 'true' : 'false',
            $value->isArray() => implode(',', $primitive),
            default => (string)$primitive
        };
    }
}
