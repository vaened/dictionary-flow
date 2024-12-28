<?php
/**
 * @author enea dhack <contact@vaened.dev>
 * @link https://vaened.dev DevFolio
 */

declare(strict_types=1);

namespace Vaened\DictionaryFlow\NameNormalizers;

final class PassthroughNameNormalizer implements InputNameNormalizer
{
    public function normalize(string $name): string
    {
        return $name;
    }
}