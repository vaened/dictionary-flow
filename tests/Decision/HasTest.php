<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\DictionaryFlow\Tests\Decision;

use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use Vaened\DictionaryFlow\By\Has;
use Vaened\DictionaryFlow\Input;
use Vaened\DictionaryFlow\Tests\TestCase;
use Vaened\DictionaryFlow\Tests\Utils\Gender;

final class HasTest extends TestCase
{
    #[Test]
    public function can_check_if_the_dictionary_has_a_datetime_value(): void
    {
        $birthdate = Has::value(
            Input::date('birthdate'),
            function ($value) {
                $this->assertInstanceOf(DateTimeImmutable::class, $value);
                $this->assertEquals(new DateTimeImmutable('1996-01-01'), $value);
            }
        );

        $this->mediator()->on($birthdate);
    }

    #[Test]
    public function can_check_if_the_dictionary_has_a_string_key(): void
    {
        $name = Has::value(
            Input::text('name'),
            function ($value) {
                $this->assertIsString($value);
                $this->assertEquals('Me', $value);
            }
        );

        $this->mediator()->on($name);
    }

    #[Test]
    public function test_can_check_if_the_dictionary_has_a_float_key(): void
    {
        $weight = Has::value(
            Input::decimal('weight'),
            function ($value) {
                $this->assertIsFloat($value);
                $this->assertEquals(63.5, $value);
            }
        );

        $this->mediator()->on($weight);
    }

    #[Test]
    public function can_check_if_the_dictionary_has_a_integer_key(): void
    {
        $age = Has::value(
            Input::integer('age'),
            function ($value) {
                $this->assertIsInt($value);
                $this->assertEquals(28, $value);
            }
        );

        $this->mediator()->on($age);
    }

    #[Test]
    public function can_check_if_the_dictionary_has_a_boolean_key(): void
    {
        $married = Has::value(
            Input::boolean('married'),
            function ($value) {
                $this->assertIsBool($value);
                $this->assertFalse($value);
            }
        );

        $this->mediator()->on($married);
    }

    #[Test]
    public function can_check_if_the_dictionary_has_an_array_key(): void
    {
        $skills = Has::value(
            Input::collection('skills'),
            function ($value) {
                $this->assertIsArray($value);
                $this->assertEquals(['PHP', 'Js', 'Python'], $value);
            }
        );

        $this->mediator()->on($skills);
    }

    #[Test]
    public function can_check_if_the_dictionary_has_an_enum_key(): void
    {
        $gender = Has::value(
            Input::enum('gender', Gender::class),
            function ($value) {
                $this->assertInstanceOf(Gender::class, $value);
                $this->assertEquals(Gender::MALE, $value);
            }
        );

        $this->mediator()->on($gender);
    }

    #[Test]
    public function can_check_if_the_dictionary_has_a_json_key(): void
    {
        $contact = Has::value(
            Input::json('contact'),
            function ($value) {
                $this->assertIsArray($value);
                $this->assertEquals([
                    'email' => 'enea.so@live.com',
                    'phone' => '+51-123456789',
                ], $value);
            }
        );

        $this->mediator()->on($contact);
    }
}