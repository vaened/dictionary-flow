# Dictionary Parser

[![Tests](https://github.com/vaened/dictionary-parser/actions/workflows/tests.yml/badge.svg)](https://github.com/vaened/dictionary-parser/actions/workflows/tests.yml) [![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](license)

The Dictionary Parser library empowers developers to conduct comprehensive evaluations within a data dictionary structure comprising
key-value pairs. This versatile tool streamlines the process of interpreting andanalyzing values within the collection. By enabling users
to define precise evaluation conditions and corresponding actions, it facilitates data-driven decision-making.

## Installation

You can install the library using composer.

```shell
composer require vaened/dictionary-parser
```

## Usage

```php
$mediator = new Mediator($parameters);

// Utilize reflection to dynamically evaluate the data dictionary
// based on the specified function signature.
$mediator->on(
    Matches::signature(
        fn(array $skills) => /* Perform appropriate action for skills */
    )
);

// Manually check if the 'birthdate' key has a value and process
// it accordingly.
$mediator->on(
    Has::value(
        Input::date('birthdate'),
        fn(DateTimeInterface $birthdate) => /* Perform relevant action based on birthdate */
    )
);
```

### Initialize

To start utilizing the library, follow these steps to set up the essential components:

```php
// Define your input data as an associative array.
$dictionary = [
    'name' => 'You',
    'birthdate' => '1996-01-01',
    'married' => false,
    'skills' => ['PHP', 'Js', 'Python']
];

// Create a Parameters instance from the defined dictionary.
$parameters = Parameters::from($dictionary);

// Initialize the Mediator using the prepared Parameters instance.
$mediator = new Mediator($parameters);
```
