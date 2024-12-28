<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\DictionaryFlow\By;

use ReflectionFunction;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionType;
use Vaened\DictionaryFlow\Argument;
use Vaened\DictionaryFlow\ArgumentBag;
use Vaened\DictionaryFlow\Decision;
use Vaened\DictionaryFlow\Exceptions\{InvalidType, UnsupportedMultiTyped};
use Vaened\DictionaryFlow\Input;
use Vaened\DictionaryFlow\NameNormalizers\{InputNameNormalizer, SnakeCaseNameNormalizer};
use Vaened\DictionaryFlow\Specification;
use Vaened\DictionaryFlow\Specifications\{Decimalizer, Integrify, Listify, Logical, Stringify};

use function Lambdish\Phunctional\map;
use function sprintf;

final class Matches implements Decision
{
    private readonly mixed       $action;

    private readonly ArgumentBag $arguments;

    public function __construct(
        callable                             $action,
        private readonly InputNameNormalizer $nameNormalizer = new SnakeCaseNameNormalizer()
    )
    {
        $this->action = $action;
        $this->fillInputBag((new ReflectionFunction($action))->getParameters());
    }

    public static function signature(callable $action): self
    {
        return new self($action);
    }

    public function argumentBag(): ArgumentBag
    {
        return $this->arguments;
    }

    public function action(): callable
    {
        return $this->action;
    }

    private function fillInputBag(array $parameters): void
    {
        $this->arguments = ArgumentBag::from(
            map(
                fn(ReflectionParameter $parameter) => $this->createInput($parameter),
                $parameters
            )
        );
    }

    private function createInput(ReflectionParameter $parameter): Argument
    {
        return (new Input(
            $this->nameNormalizer->normalize($parameter->getName()),
            $this->createSpecBy($parameter),
            $parameter->isOptional(),
        ))->withDefault($parameter->isDefaultValueAvailable() ? $parameter->getDefaultValue() : null);
    }

    private function createSpecBy(ReflectionParameter $parameter): Specification
    {
        $type = $parameter->getType();
        $this->ensureTypeFor($type, $parameter->getName());

        return match ($type?->getName()) {
            'string' => new Stringify(),
            'int'    => new Integrify(),
            'bool'   => new Logical(),
            'float'  => new Decimalizer(),
            'array'  => new Listify(),
            default  => throw new InvalidType(
                sprintf(
                    'Supported arguments are string|int|bool|float|array, %s given for <%s>',
                    $type?->getName() ?? 'Unknown',
                    $parameter->getName(),
                )
            ),
        };
    }

    private function ensureTypeFor(?ReflectionType $type, string $parameterName): void
    {
        if ($type === null) {
            throw new InvalidType(sprintf('Argument <%s> must be typed', $parameterName));
        }

        if (!$type instanceof ReflectionNamedType) {
            throw new UnsupportedMultiTyped(sprintf('Argument <%s> must be uniquely typed', $parameterName));
        }
    }
}
