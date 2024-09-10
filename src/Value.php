<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\DictionaryFlow;

use Stringable;

use function is_array;
use function is_bool;
use function is_float;
use function is_int;
use function is_string;

final class Value implements Stringable
{
    public function __construct(
        private readonly mixed $value,
    )
    {
    }

    public function isArray(): bool
    {
        return is_array($this->primitive());
    }

    public function isString(): bool
    {
        return is_string($this->primitive());
    }

    public function isInteger(): bool
    {
        return is_int($this->primitive());
    }

    public function isFloat(): bool
    {
        return is_float($this->primitive());
    }

    public function isBoolean(): bool
    {
        return is_bool($this->primitive());
    }

    public function primitive(): mixed
    {
        return $this->value;
    }

    public function equals(mixed $value): bool
    {
        return $this->value == $value;
    }

    public function isEmptyOrNull(): bool
    {
        return $this->isNull() || $this->isEmpty();
    }

    public function isNull(): bool
    {
        return $this->value === null;
    }

    public function isEmpty(): bool
    {
        return $this->value === '';
    }

    public function __toString(): string
    {
        return ValueStringify::stringify($this);
    }
}
