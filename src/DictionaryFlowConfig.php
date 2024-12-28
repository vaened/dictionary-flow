<?php
/**
 * @author enea dhack <contact@vaened.dev>
 * @link https://vaened.dev DevFolio
 */

declare(strict_types=1);

namespace Vaened\DictionaryFlow;

use Vaened\DictionaryFlow\NameNormalizers\InputNameNormalizer;
use Vaened\DictionaryFlow\NameNormalizers\PassthroughNameNormalizer;

final class DictionaryFlowConfig
{
    private static ?InputNameNormalizer $normalizer = null;

    public static function setDefaultInputNameNormalizer(InputNameNormalizer $normalizer): void
    {
        self::$normalizer = $normalizer;
    }

    public static function defaultInputNameNormalizer(): InputNameNormalizer
    {
        return self::$normalizer ??= new PassthroughNameNormalizer();
    }
}