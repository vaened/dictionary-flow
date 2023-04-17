<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CollectionEvaluator\NameNormalizers;

final class SnakeCase implements InputNameNormalizer
{
    public function normalize(string $name): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $name));
    }
}
