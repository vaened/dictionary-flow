<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CollectionEvaluator\Specifications;

use DateTime;
use DateTimeInterface;
use Vaened\CollectionEvaluator\Specification;
use Vaened\CollectionEvaluator\Value;

final class Datify implements Specification
{
    public function __construct(private readonly ?string $format)
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
            new DateTime($datetime) :
            DateTime::createFromFormat($this->format, $datetime);
    }
}
