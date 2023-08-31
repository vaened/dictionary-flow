<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\DictionaryParser;

use Vaened\Support\Types\SecureList;

final class ArgumentBag extends SecureList
{
    public static function from(iterable $arguments): self
    {
        return new self($arguments);
    }

    protected static function type(): string
    {
        return Argument::class;
    }
}
