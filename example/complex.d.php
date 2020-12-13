
// virtual attr Since
// {
//     public string $version;
//     public string $package;
// }

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

/**
 * Interface for external iterators or objects that can be iterated
 * themselves internally.
 *
 * @link http://php.net/manual/en/class.iterator.php
 */
#[Since('5.1', package: 'php')]
interface Iterator<out TKey, out TValue>: Traversable<TKey, TValue>
{
    /**
     * Return the current element.
     *
     * @link http://php.net/manual/en/iterator.current.php
     */
    #[Since('5.1', package: 'php')]
    public function current(): TValue;

    /**
     * Move forward to next element.
     *
     * @link http://php.net/manual/en/iterator.next.php
     */
    #[Since('5.1', package: 'php')]
    public function next(): void;

    /**
     * Return the key of the current element.
     *
     * @link http://php.net/manual/en/iterator.key.php
     */
    #[Since('5.1', package: 'php')]
    public function key(): TKey;

    /**
     * Checks if current position is valid
     *
     * @link http://php.net/manual/en/iterator.valid.php
     */
    #[Since('5.1', package: 'php')]
    public function valid(): bool;

    /**
     * Rewind the Iterator to the first element
     *
     * @link http://php.net/manual/en/iterator.rewind.php
     */
    #[Since('5.1', package: 'php')]
    public function rewind(): void;
}

/**
 * @link https://www.php.net/manual/en/class.outeriterator.php
 */
#[Since('5.1', package: 'php')]
interface OuterIterator<out TKey, out TValue>: Iterator<TKey, TValue>
{
    /**
     * Returns the inner iterator for the current entry.
     *
     * @link https://www.php.net/manual/en/outeriterator.getinneriterator.php
     */
    #[Since('5.1', package: 'php')]
    public function getInnerIterator(): Iterator<TKey, TValue>;
}

/**
 * This iterator wrapper allows the conversion of anything that
 * is {@see Traversable} into an Iterator. It is important to understand that
 * most classes that do not implement Iterators have reasons as most likely
 * they do not allow the full Iterator feature set. If so, techniques should be
 * provided to prevent misuse, otherwise expect exceptions or fatal errors.
 *
 * @link https://www.php.net/manual/en/class.iteratoriterator.php
 */
#[Since('5.1', package: 'php')]
class IteratorIterator<out TKey, out TValue>: OuterIterator<TKey, TValue>
{
    /**
     * Create an iterator from anything that is traversable.
     *
     * @link https://www.php.net/manual/en/iteratoriterator.construct.php
     */
    #[Since('5.1', package: 'php')]
    public function __construct($iterator: Traversable<TKey, TValue>): void;

    /**
     * Get the inner iterator.
     *
     * @link https://www.php.net/manual/en/iteratoriterator.getinneriterator.php
     */
    #[Since('5.1', package: 'php')]
    public function getInnerIterator(): Traversable<TKey, TValue>;

    /**
     * Return the current element.
     *
     * @link http://php.net/manual/en/iterator.current.php
     */
    #[Since('5.1', package: 'php')]
    public function current(): TValue;

    /**
     * Move forward to next element.
     *
     * @link http://php.net/manual/en/iterator.next.php
     */
    #[Since('5.1', package: 'php')]
    public function next(): void;

    /**
     * Return the key of the current element.
     *
     * @link http://php.net/manual/en/iterator.key.php
     */
    #[Since('5.1', package: 'php')]
    public function key(): TKey;

    /**
     * Checks if current position is valid.
     *
     * @link http://php.net/manual/en/iterator.valid.php
     */
    #[Since('5.1', package: 'php')]
    public function valid(): bool;

    /**
     * Rewind the Iterator to the first element.
     *
     * @link http://php.net/manual/en/iterator.rewind.php
     */
    #[Since('5.1', package: 'php')]
    public function rewind(): void;
}
