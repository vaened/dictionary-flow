<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CollectionEvaluator\By;

use ReflectionFunction;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionType;
use Vaened\CollectionEvaluator\Argument;
use Vaened\CollectionEvaluator\ArgumentBag;
use Vaened\CollectionEvaluator\Decision;
use Vaened\CollectionEvaluator\Exceptions\InvalidType;
use Vaened\CollectionEvaluator\Exceptions\UnsupportedMultiTyped;
use Vaened\CollectionEvaluator\Input;
use Vaened\CollectionEvaluator\NameNormalizers\InputNameNormalizer;
use Vaened\CollectionEvaluator\NameNormalizers\SnakeCase;
use Vaened\CollectionEvaluator\Specification;
use Vaened\CollectionEvaluator\Specifications\Decimalizer;
use Vaened\CollectionEvaluator\Specifications\Integrify;
use Vaened\CollectionEvaluator\Specifications\Listify;
use Vaened\CollectionEvaluator\Specifications\Logical;
use Vaened\CollectionEvaluator\Specifications\Stringify;

use function Lambdish\Phunctional\map;
use function sprintf;

final class Matcher implements Decision
{
    private readonly mixed $action;

    private readonly ArgumentBag $arguments;

    public function __construct(
        callable                             $action,
        private readonly InputNameNormalizer $nameNormalizer = new SnakeCase()
    ) {
        $this->action = $action;
        $this->fillInputBag((new ReflectionFunction($action))->getParameters());
    }

    public static function do(callable $action): self
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
