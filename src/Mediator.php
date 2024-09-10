<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\DictionaryParser;

use Countable;

use function count;
use function Lambdish\Phunctional\apply;

final class Mediator
{
    public function __construct(private readonly Parameters $parameters)
    {
    }

    public function on(Decision $decision): self
    {
        $values = $decision->argumentBag()
                           ->filter($this->satisfiedOrOptionalValues())
                           ->map($this->transformSpecificationValues());

        if ($this->isSatisfied($decision->argumentBag(), $values)) {
            apply($decision->action(), $values);
        }

        return $this;
    }

    private function satisfiedOrOptionalValues(): callable
    {
        return function (Argument $argument): bool {
            $value = $this->parameters->get($argument->name());
            return ($value->isNull() && $argument->isOptional()) ||
                (!$value->isNull() && $argument->specification()->isSatisfiedBy($value));
        };
    }

    private function transformSpecificationValues(): callable
    {
        return function (Argument $argument): mixed {
            $value = $this->parameters->get($argument->name());
            return $value->isNull() ? $argument->defaultValue() : $argument->specification()->parse($value);
        };
    }

    private function isSatisfied(ArgumentBag $requiredArguments, Countable $satisfiedValues): bool
    {
        return $requiredArguments->count() === count($satisfiedValues);
    }
}
