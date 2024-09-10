<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\DictionaryParser\Specifications;

use Vaened\DictionaryParser\Specification;
use Vaened\DictionaryParser\Value;

use function json_decode;

final class Jsonify implements Specification
{
    public function __construct(private readonly bool $associative = true)
    {
    }

    public function isSatisfiedBy(Value $value): bool
    {
        return (!$value->isEmpty() && $value->isString()) || $value->isArray();
    }

    public function parse(Value $value): array
    {
        if ($value->isArray()) {
            return $value->primitive();
        }

        return json_decode((string)$value->primitive(), $this->associative);
    }
}
