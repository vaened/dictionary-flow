<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\DictionaryParser;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

use function count;
use function Lambdish\Phunctional\each;

final class Parameters implements Countable, IteratorAggregate
{
    private array $values = [];

    public static function from(array $dictionary): self
    {
        $parameters = new self();
        each(self::registerIn($parameters), $dictionary);

        return $parameters;
    }

    public function register(string $name, ?Value $value): void
    {
        $this->values[$name] = $value ?? new Value(null);
    }

    public function get(string $name): Value
    {
        return $this->values[$name] ?? new Value(null);
    }

    public function has(string $name): bool
    {
        return isset($this->values[$name]);
    }

    public function all(): array
    {
        return $this->values;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->values);
    }

    public function count(): int
    {
        return count($this->all());
    }

    private static function registerIn(self $parameters): callable
    {
        return static fn(string $value, string $name) => $parameters->register($name, new Value($value));
    }
}
