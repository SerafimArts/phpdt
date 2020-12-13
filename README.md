# PHP Data Types

DataType language for PHP static analysis tools

## Requirements

- PHP >= 7.4

## Installation

TBD

## Example

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

/**
 * Interface to detect if a class is traversable using &foreach;.
 *
 * @link http://php.net/manual/en/class.traversable.php
 */
#[Since('5.1', package: 'php')]
interface Traversable<out TKey: mixed, out TValue: mixed>;

/**
 * Interface to create an external Iterator.
 *
 * @link http://php.net/manual/en/class.iteratoraggregate.php
 */
#[Since('5.1', package: 'php')]
interface IteratorAggregate<out TKey, out TValue>: Traversable<TKey, TValue>
{
    /**
     * Retrieve an external iterator
     *
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     */
    #[Since('5.1', package: 'php')]
    public function getIterator(): Traversable<TKey, TValue>;
}
```
