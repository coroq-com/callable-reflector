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
use Coroq\CallableReflector\Reflector;

$reflection = Reflector::createFromCallable($callable);
```

`$callable` can be a closure, a function, a static method, an instance method, or an invokable object.

The returned reflection object is an instance of ReflectionFunctionAbstract, which can be either ReflectionFunction or ReflectionMethod depending on the callable type.

Here's an example for each type of callable:

```php
// Function
$reflection = Reflector::createFromCallable('strlen');

// Closure
$closure = function($x) { return $x * 2; };
$reflection = Reflector::createFromCallable($closure);

// Static method
$reflection = Reflector::createFromCallable('ExampleClass::staticMethod');
$reflection = Reflector::createFromCallable([ExampleClass::class, 'staticMethod']);

// Instance method
$object = new ExampleClass();
$reflection = Reflector::createFromCallable([$object, 'instanceMethod']);

// Invokable object
$object = new InvokableClass(); // InvokableClass has __invoke()
$reflection = Reflector::createFromCallable($object);
```

## License

This project is licensed under the MIT License.
