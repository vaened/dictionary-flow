<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CollectionEvaluator\NameNormalizers;

interface InputNameNormalizer
{
    public function normalize(string $name): string;
}
