# Calculator

## Why?

This repository is designed as an example of how you can implement a 
calculator based on abstract syntax tree generated by the LL(k) recurrence 
recursive descent parser.

As a grammar used the basic implementation with operators associativity, and 
not vulnerable to left recursion:

```bnf
<expr> ::= <term> "+" <expr>
        | <term> "-" <expr>
        |  <term>

<term> ::= <factor> "*" <term>
        | <factor> "/" <term>
        |  <factor>

<factor> ::= "(" <expr> ")"
          | <value>

<value> ::= T_FLOAT | T_INT
```

Where 
- `T_INT` is a PCRE `[0-9]+` 
- `T_FLOAT` is a PCRE `[0-9]+\.[0-9]+`

## Example

Command Line Interface

```bash
$ php ./bin/cc
```

![](https://habrastorage.org/webt/vq/pc/-x/vqpc-xc-eaevhca5-ba4ipfd2ay.png)

## Usage

**Global:**

```bash
$ composer global require serafim/calc
$ cc
```

**Local:**

```bash
$ composer require serafim/calc
$ ./vendor/bin/cc 
```

