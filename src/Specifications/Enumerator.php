<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CollectionEvaluator\Specifications;


use BackedEnum;
use Vaened\CollectionEvaluator\Exceptions\InvalidValue;
use Vaened\CollectionEvaluator\Specification;

use Vaened\CollectionEvaluator\Value;

use ValueError;

use function call_user_func;

final class Enumerator implements Specification
{
    public function __construct(private readonly string $enumQualifyClassName)
    {
    }

    public function isSatisfiedBy(Value $value): bool
    {
        return !$value->isEmptyOrNull() && ($value->isInteger() || $value->isString());
    }

    public function parse(Value $value): BackedEnum
    {
        try {
            return call_user_func([$this->enumQualifyClassName, 'from'], $value->primitive());
        } catch (ValueError) {
            throw new InvalidValue($value->primitive(), $this->enumQualifyClassName);
        }
    }
}