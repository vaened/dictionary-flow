<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\DictionaryFlow\Specifications;

use DateTimeImmutable;
use DateTimeInterface;
use Vaened\DictionaryFlow\Specification;
use Vaened\DictionaryFlow\Value;

final class Datify implements Specification
{
    public function __construct(private readonly ?string $format = null)
    {
    }

    public function isSatisfiedBy(Value $value): bool
    {
        return !$value->isEmpty();
    }

    public function parse(Value $value): DateTimeInterface
    {
        $datetime = (string)$value->primitive();

        return null === $this->format ?
            new DateTimeImmutable($datetime) :
            DateTimeImmutable::createFromFormat($this->format, $datetime);
    }
}
