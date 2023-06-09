<?php
declare(strict_types=1);

use Coroq\CallableReflector\CallableReflector;
use PHPUnit\Framework\TestCase;

/**
 * @covers Coroq\CallableReflector\CallableReflector
 */
class CallableReflectorTest extends TestCase {
  public function testReflectionFromFunction(): void {
    $reflection = CallableReflector::createFromCallable('strlen');
    $this->assertInstanceOf(ReflectionFunction::class, $reflection);
    $this->assertEquals('strlen', $reflection->getName());
  }

  public function testReflectionFromClosure(): void {
    $closure = function($x) {
      return $x * 2;
    };
    $reflection = CallableReflector::createFromCallable($closure);
    $this->assertInstanceOf(ReflectionFunction::class, $reflection);
  }

  public function testReflectionFromStaticMethod(): void {
    $reflection = CallableReflector::createFromCallable([ExampleClass::class, 'staticMethod']);
    $this->assertInstanceOf(ReflectionMethod::class, $reflection);
    $this->assertEquals('staticMethod', $reflection->getName());
  }

  public function testReflectionFromObjectMethod(): void {
    $object = new ExampleClass();
    $reflection = CallableReflector::createFromCallable([$object, 'instanceMethod']);
    $this->assertInstanceOf(ReflectionMethod::class, $reflection);
    $this->assertEquals('instanceMethod', $reflection->getName());
  }

  public function testReflectionFromInvokableObject(): void {
    $object = new InvokableClass();
    $reflection = CallableReflector::createFromCallable($object);
    $this->assertInstanceOf(ReflectionMethod::class, $reflection);
    $this->assertEquals('__invoke', $reflection->getName());
  }

  public function testReflectionFromStringStaticMethod(): void {
    $reflection = CallableReflector::createFromCallable(ExampleClass::class . '::staticMethod');
    $this->assertInstanceOf(ReflectionMethod::class, $reflection);
    $this->assertEquals('staticMethod', $reflection->getName());
  }
}

class ExampleClass {
  public static function staticMethod(): string {
    return 'Hello, static!';
  }

  public function instanceMethod(): string {
    return 'Hello, instance!';
  }
}

class InvokableClass {
  public function __invoke(): string {
    return 'Hello, invokable!';
  }
}
