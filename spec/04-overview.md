# Overview

DT is a declarative type system description language, therefore it does not 
contain imperative instructions and does not return the execution result.

For example, this code describes an already existing 
[iterable type](https://www.php.net/manual/en/language.types.iterable.php),
defined in PHP:

```php
/**
 * Iterable is a pseudo-type introduced in PHP 7.1. It accepts any array or
 * object implementing the Traversable interface. Both of these types are
 * iterable using foreach and can be used with yield from within a generator.
 */
#[Link('https://www.php.net/manual/en/language.types.iterable.php')]
#[Since('7.1', package: 'php')]
type iterable<out TKey: mixed, out TValue: mixed> = (
    array<TKey, TValue> | Traversable<TKey, TValue>
);
```

DT is not a programming language capable of arbitrary computations, it is a 
language used to describe the type system of existing PHP code, the capabilities
of which are defined in this specification. DT is an independent auxiliary 
language designed to provide a high-quality description of the behavior of the 
language with the help of constructions that cannot be reproduced in the PHP 
language itself (including docblock).

In addition, the result of the execution of the language can be the source code
of already existing static analysis and autocomplete systems (such as phpdoc, 
psalm, PhpStorm meta, etc.), which allows you to unify and bring many different
specifications into a single language.

The following formal specification serves as a reference for developers. It 
describes the language and its grammar, the type system, and execution and 
validation mechanisms with algorithms for their operation. The purpose of this 
specification is to provide a framework and structure for an ecosystem of DT 
tools and final compilation units (e.g. stub files) covering both organizations 
and platforms that have yet to be built. We look forward to working with the 
community for this.
