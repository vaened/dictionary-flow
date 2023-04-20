<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CollectionEvaluator;

use Vaened\CollectionEvaluator\Specifications\Datify;
use Vaened\CollectionEvaluator\Specifications\Enumerator;
use Vaened\CollectionEvaluator\Specifications\Integrify;
use Vaened\CollectionEvaluator\Specifications\Jsonify;
use Vaened\CollectionEvaluator\Specifications\Listify;
use Vaened\CollectionEvaluator\Specifications\Stringify;

final class Input implements Argument
{
    private mixed $defaultValue = null;

    public function __construct(
        private readonly string        $name,
        private readonly Specification $specification,
        private readonly bool          $optional,
    ) {
    }

    public static function optional(string $name, Specification $specification): self
    {
        return new self($name, $specification, optional: true,);
    }

    public static function required(string $name, Specification $specification): self
    {
        return new self($name, $specification, optional: false);
    }

    public static function integer(string $name, bool $optional = false): self
    {
        return new self($name, new Integrify(), $optional);
    }

    public static function decimal(string $name, bool $optional = false): self
    {
        return new self($name, new Integrify(), $optional);
    }

    public static function collection(string $name, bool $optional = false): self
    {
        return new self($name, new Listify(), $optional);
    }

    public static function json(string $name, bool $optional = false): self
    {
        return new self($name, new Jsonify(), $optional);
    }

    public static function text(string $name, bool $optional = false): self
    {
        return new self($name, new Stringify(), $optional);
    }

    public static function date(string $name, string $dateFormat = null, bool $optional = false): self
    {
        return new self($name, new Datify($dateFormat), $optional);
    }

    public static function enum(string $name, string $enumClassName, bool $optional = false)
    {
        return new self($name, new Enumerator($enumClassName), $optional);
    }

    public function withDefault(mixed $value): self
    {
        $this->defaultValue = $value;
        return $this;
    }

    public function specification(): Specification
    {
        return $this->specification;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function defaultValue(): mixed
    {
        return $this->defaultValue;
    }

    public function isOptional(): bool
    {
        return $this->optional;
    }
}
