<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\DictionaryParser\By;

use Vaened\DictionaryParser\Argument;
use Vaened\DictionaryParser\ArgumentBag;
use Vaened\DictionaryParser\Decision;

final class Has implements Decision
{
    private readonly mixed $action;

    public function __construct(
        private readonly ArgumentBag $arguments,
        callable                     $action,
    )
    {
        $this->action = $action;
    }

    public static function values(array $arguments, callable $action): self
    {
        return new self(ArgumentBag::from($arguments), $action);
    }

    public static function value(Argument $argument, callable $action): self
    {
        return new self(ArgumentBag::from([$argument]), $action);
    }

    public function argumentBag(): ArgumentBag
    {
        return $this->arguments;
    }

    public function action(): callable
    {
        return $this->action;
    }
}