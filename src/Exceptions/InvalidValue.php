<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\DictionaryParser\Exceptions;

use InvalidArgumentException;

use function sprintf;

final class InvalidValue extends InvalidArgumentException
{
    public function __construct(string|int $value, string $targetQualifyClassName)
    {
        parent::__construct(sprintf("Entity <%s> does not allow value <%s>.", $value, $targetQualifyClassName));
    }
}