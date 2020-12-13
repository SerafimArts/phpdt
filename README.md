# DT Language for PHP

> Please note that this is just an experiment for now

DT (DataType) language for PHP autocompetition and static analysis tools.

- See also: [DT Specification](spec/00-specification-for-dt.md)

The task of the language is to implement a full-fledged strictly typed language
for the implementation of autocomplete, static analysis rules and similar tasks.

Target platforms:

- Static Analysis
    - `psalm`
    - `phpstan`
- Autocomplete
    - `.phpstorm.meta.php`
    - `phpdoc`
- Marshalling
    - `FFI`

Problems of the native PHP language that prevent the implementation of 
full-fledged static analysis:

## Custom Types

PHP already contains a set of algebraic types, but does not allow you to 
create your own. The DT language allows you to bypass these restrictions.

Examples of the implementation of existing PHP types using the DT type system:

```php
/**
 * Iterable is a pseudo-type introduced in PHP 7.1. It accepts any array or
 * object implementing the Traversable interface. Both of these types are
 * iterable using foreach and can be used with yield from within a generator.
 *
 * @link https://www.php.net/manual/en/language.types.iterable.php
 */
#[Since('7.1', package: 'php')]
type iterable<out TKey: mixed, out TValue: mixed> = (
    array<TKey, TValue> | Traversable<TKey, TValue>
);

// Psalm Analogue:
//  - Absent
```

An example of implementing custom types:

```php
virtual type scalar = int | float | bool | string;

// Psalm Analogue:
//  - @psalm-type scalar = int | float | bool | string
```

> The `virtual` keyword will be discussed later.

## Anonymous Functions

PHP does not allow to declare signatures for anonymous functions. The DT system 
allows you to bypass these restrictions:

```php
virtual function array-filter-callback(mixed, array-key): bool;

function array_filter(
    $array: array,
    $callback: array-filter-callback | null = null,
    $mode: int = 0
): array;

// Psalm Analogue:
//  - @psalm-type array-filter-callback = callable(mixed, array-key): bool
```

## Generics

The PHP does not allow declaring generics and implementing an autocomplete 
based on passed generic parameters.

Typical case:

```php
class Collection<TKey: array-key, TValue: mixed>: 
    IteratorAggregate<TKey, TValue>, 
    ArrayAccess<TKey, TValue>, 
    Countable
{
    type filter-callback = callable(TValue, TKey): bool;
    public function filter($fn: filter-callback): Collection<TKey, TValue>;
    
    type map-callback<T: mixed> = callable(TValue, TKey): T;
    public function map<T: mixed>($fn: map-callback): Collection<TKey, T>;
    
    // etc
}
```

## Virtual Types

There is no way to create virtual classes that will be part of the autocomplete,
but they cannot be used in the code.

In the PHP language, the `CData` class is polymorphic and can be of any type: 
C pointer, scalar (float, int, char, etc...), structure or callback.

PHP does not allow implementing autocomplete and static analysis for such 
types without their explicit implementation.

Typical case:

```php
// Physical class
class CData;

// Virtual classes
virtual class CScalar<T: scalar>: CData
{
    public T $cdata;
}

virtual class CInt8: CScalar<int>;
virtual class CUInt8: CScalar<int>;
virtual class CInt16: CScalar<int>;
virtual class CUInt16: CScalar<int>;
// ...etc

virtual class CPointer<out T: CData>: CData, ArrayAccess<0, T>;
virtual class CArray<out T: CData>: CData, ArrayAccess<positive-int, T>;
```

## Overriding

Some classes, including the system ones, contain several implementations 
of the same method with different signatures.

```php
// Laravel Database QueryBuilder example

class QueryBuilder
{
    virtual type operator = '=' | '>' | '<' | '>=' | '<=' | '!=' | 'like' | 'not like';

    public function where($key: string, $value: mixed): static;
    public function where($key: string, $operator: operator, $value: mixed): static;
}
```

In PHP, a similar construction can be used as follows:

```php
$builder->where('key', 42);
$builder->where('key', '>', 42);
```

## Optional Static

Some methods in PHP can be called both as an object method and as a static 
method. However, no existing type system allows you to describe this behavior 
of methods.

```php
class FFI
{
    public static? function new($type: string|CData, $owned: bool = true, $persistent: bool = false): CData;
}
```

Or like this:

```php
// Laravel Eloquent example
abstract class Model
{
    public static? function where($key: string, $value: mixed): static;
    public static? function where($key: string, $operator: string, $value: mixed): static;
}
```

In PHP, a similar construction can be used as follows:

```php
    // static method
User::where('key', 42)
    // instance method
    ->where('key', 42)
;
```

## Named Arguments

It is not possible in PHP to specify that a method or function may or may not 
accept named arguments. In the DT type system, to indicate that a function 
cannot accept named arguments, it is sufficient to remove their name, leaving 
only their type.

```php
function with_named_argument($arg: mixed): void;

function without_named_argument(mixed): void;
```

## Requirements

- PHP >= 7.4

## Installation

TBD

## Example
