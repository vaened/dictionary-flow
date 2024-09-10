<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\DictionaryParser\Tests\Decision;

use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use Vaened\DictionaryParser\By\Has;
use Vaened\DictionaryParser\Input;
use Vaened\DictionaryParser\Tests\TestCase;
use Vaened\DictionaryParser\Tests\Utils\Gender;

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

        $this->mediator()->when($birthdate);
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

        $this->mediator()->when($name);
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

        $this->mediator()->when($weight);
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

        $this->mediator()->when($age);
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

        $this->mediator()->when($married);
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

        $this->mediator()->when($skills);
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

        $this->mediator()->when($gender);
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

        $this->mediator()->when($contact);
    }
}