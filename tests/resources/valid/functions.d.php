
function example(): mixed;

// Generics
function example<X>(): mixed;
function example<X, Y>(): mixed;
function example<X: object, in Y: mixed, out Z>(): mixed;
function example(): Test<X>;
function example(): Test<X, Y>;

// Arguments
function example($x: mixed): mixed;
function example($x: Generic<T>): mixed;
function example($x: Generic<T>, $y: mixed): mixed;

// Modifiers
internal function example(): mixed;
virtual function example(): mixed;
