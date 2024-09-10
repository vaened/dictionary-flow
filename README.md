# Dictionary Flow

[![Tests](https://github.com/vaened/dictionary-parser/actions/workflows/tests.yml/badge.svg)](https://github.com/vaened/dictionary-parser/actions/workflows/tests.yml) [![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](license)


The **Dictionary Flow** library is designed to streamline decision-making and action handling based on key-value data dictionaries. It aims to simplify the process by removing the need for repetitive conditions and checks, offering a more structured and flexible approach to managing parameters and executing actions.

By using this tool, you can easily define rules to process data and perform corresponding actions, reducing the reliance on multiple if statements and manual validations. This results in improved code readability and maintainability, making it easier to integrate with systems that handle dynamic data.

## Installation

You can install the library using composer.

```shell
composer require vaened/dictionary-flow
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

Features

• **Code Simplification**: Replaces numerous if checks with a clear, declarative structure for managing conditions and actions.

• **Flexible Evaluation**: Allows for defining rules and actions for various data types and scenarios through a simple and extensible interface.

• **Structured Data Handling**: Facilitates parameter processing based on a key-value dictionary, organizing logic more efficiently.

• **Seamless Integration**: Easily integrates into applications, enabling quick and straightforward configuration.

• **Extensibility**: Allows developers to create their own rule and condition implementations to fit specific needs.

## License

This library is licensed under the MIT License. For more information, please see the [`license`](./license) file.