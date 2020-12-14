# Grammar

A DT program consists of one or more source files, known formally as 
compilation units (Compilation units). A source file is an ordered sequence of
Unicode characters. For maximal portability and compatibility with PHP PSR
specification, it is recommended that files in a file system be encoded with
the UTF-8 encoding.

Conceptually speaking, a program is compiled using four steps:

- Lexical analysis, which translates a stream of UTF input characters into
  a stream of tokens.
- Syntactic analysis, which translates the stream of tokens into abstract 
  syntax tree.
- Semantic analysis, which checks the AST for internal semantic correctness.
- Compilation: The final build step that allows the custom build to generate 
  the required code.

This specification presents the syntax of the DT programming language using two
grammars. The lexical grammar (Lexical grammar) defines how Unicode characters
are combined to form line terminators, white space, comments, tokens, and
pre-processing directives. The syntactic grammar (Syntactic grammar) defines
how the tokens resulting from the lexical grammar are combined to form DT AST.

The lexical and syntactic grammars are presented in Extended Backus-Naur form.

## Source Text

<pre>
<i id="grammar-source-character">source-character ::</i>
   <b>/[\u0009\u000A\u000D\u0020-\uFFFF]/</b>
</pre>

DT source files are expressed as a sequence of Unicode characters. 

### White Space

<pre>
<i id="grammar-white-space">white-space ::</i>
   <i><a href="#grammar-white-space-character">white-space-character</a></i>
   <i><a href="#grammar-white-space">white-space</a></i>   <i><a href="#grammar-white-space-character">white-space-character</a></i>

<i id="grammar-white-space-character">white-space-character ::</i>
   <i><a href="#grammar-new-line">new-line</a></i>
   Horizontal Tab (U+0009)
   Space (U+0020)
</pre>

White space is used to improve legibility of source text and act as separation 
between tokens, and any amount of white space may appear before or after any 
token. White space between tokens is not significant to the semantic meaning 
of a DT source file, however white space characters may appear within a 
String or Comment token.

> DT intentionally does not consider Unicode “Zs” category characters as 
white‐space, avoiding misinterpretation by text editors and source control
tools.

### Line Terminators

<pre>
<i id="grammar-new-line">new-line ::</i>
    EOL (U+000A)
    Carriage Return (U+000D)
    Carriage Return (U+000D) followed by EOL (U+000A)
</pre>

Like white space, line terminators are used to improve the legibility of 
source text, any amount may appear before or after any other token and have 
no significance to the semantic meaning of a DT source file. Line 
terminators are not found within any other token.

