# Collection Evaluator
Functionality to evaluate a collection of data and decide on its values.

```php
$parameters = new Parameters();
$attributes     = [
    'name'      => 'You',
    'birthdate' => '1996-01-01',
    'married'   => false,
    'skills'    => ['PHP', 'Js', 'Python'] 
];

each(
    fn(string $name) => $parameters->register($name, new Value($this->input($name))), 
    $attributes
);

$mediator = new Mediator($parameters);
```

```php
// with mediator
$mediator->when(new Matcher(fn(string $name) => var_dump($name)));

// without mediator
if (isset($attributes['name'])){
    var_dump($attributes['name'])
}
```
```php
// with mediator
$mediator->when(
    Has::value(
        Input::date('birthdate'),
        fn(DateTimeInterface $birthdate) => var_dump($birthdate) 
    )
);

// without mediator
if (isset($attributes['birthdate'])){
    var_dump(new DateTime($attributes['birthdate']));
}
```
```php
// with mediator
$mediator->when(
    new Matcher(fn(bool $married) => var_dump($married))
);

// without mediator
if (isset($attributes['married']) && is_bool($attributes['married'])){
    var_dump($attributes['married']);
}
```
```php
// with mediator
$mediator->when(
    new Matcher(fn(array $skills) => var_dump($skills))
);

// without mediator
if (isset($attributes['skills']) && is_array($attributes['skills'])){
    var_dump($attributes['skills']);
}
```