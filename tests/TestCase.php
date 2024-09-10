<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\DictionaryParser\Tests;

use PHPUnit\Framework\TestCase as PhpUnitTestCase;
use Vaened\DictionaryParser\Mediator;
use Vaened\DictionaryParser\Parameters;
use Vaened\DictionaryParser\Tests\Utils\Gender;

use function json_encode;

abstract class TestCase extends PhpUnitTestCase
{
    protected function mediator(): Mediator
    {
        $parameters = Parameters::from([
            'name'      => 'Me',
            'age'       => 28,
            'birthdate' => '1996-01-01',
            'gender'    => Gender::MALE->value,
            'weight'    => 63.5,
            'married'   => false,
            'skills'    => ['PHP', 'Js', 'Python'],
            'contact'   => json_encode([
                'email' => 'enea.so@live.com',
                'phone' => '+51-123456789',
            ]),
        ]);

        return new Mediator($parameters);
    }
}