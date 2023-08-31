<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\DictionaryParser;

interface Argument
{
    public function specification(): Specification;

    public function name(): string;

    public function defaultValue(): mixed;

    public function isOptional(): bool;
}