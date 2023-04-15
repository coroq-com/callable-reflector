# Callable Reflector

Easily create reflections of callables in PHP.

## Requirements

- PHP >= 7.2

## Installation

```sh
composer require coroq/callable-reflector
```

## Usage

```php
use Coroq\CallableReflector\CallableReflector;

$reflection = CallableReflector::createFromCallable($callable);
```

`$callable` can be a closure, a function, a static method, an instance method, or an invokable object.

The returned reflection object is an instance of ReflectionFunctionAbstract, which can be either ReflectionFunction or ReflectionMethod depending on the callable type.

Here's an example for each type of callable:

```php
// Function
$reflection = CallableReflector:createFromCallable('strlen');

// Closure
$closure = function($x) { return $x * 2; };
$reflection = CallableReflector::createFromCallable($closure);

// Static method
$reflection = CallableReflector::createFromCallable('ExampleClass::staticMethod');
$reflection = CallableReflector::createFromCallable([ExampleClass::class, 'staticMethod']);

// Instance method
$object = new ExampleClass();
$reflection = CallableReflector::createFromCallable([$object, 'instanceMethod']);

// Invokable object
$object = new InvokableClass(); // InvokableClass has __invoke()
$reflection = CallableReflector::createFromCallable($object);
```

## License

This project is licensed under the MIT License.
