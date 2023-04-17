<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CollectionEvaluator\By;

use Vaened\CollectionEvaluator\ArgumentBag;
use Vaened\CollectionEvaluator\Decision;
use Vaened\CollectionEvaluator\Input;
use Vaened\CollectionEvaluator\Specifications\Datify;

final class Dater implements Decision
{
    private readonly mixed $action;

    public function __construct(private readonly string $attribute, callable $action)
    {
        $this->action = $action;
    }

    public function argumentBag(): ArgumentBag
    {
        return ArgumentBag::from([
            Input::required($this->attribute, new Datify())
        ]);
    }

    public function action(): callable
    {
        return $this->action;
    }
}
