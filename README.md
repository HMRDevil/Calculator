# Calculator

## Why?

This repository is designed as an example of how you can implement a 
calculator based on abstract syntax tree generated by the LL(k) recurrence 
recursive descent parser.

As a grammar used the basic implementation with operators associativity, and 
not vulnerable to left recursion:

```bnf
{
  tokens = [
    T_FLOAT = "regexp:\d+\.\d+"
    T_INT   = "regexp:\d+"
  ]
}

<expr>           ::= <addition> | <subtraction> | <term>

<term>           ::= <multiplication> | <division> | <factor>
<factor>         ::= "(" <expr> ")" | <value>

<subtraction>    ::= <term> "-" <expr>
<addition>       ::= <term> "+" <expr>
<multiplication> ::= <factor> "*" <term> | <factor> <term>
<division>       ::= <factor> ("/" | "÷") <term>

<value>          ::= T_FLOAT | T_INT
```

## Example

Command Line Interface

```bash
$ php ./bin/cc run
```

![](https://habrastorage.org/webt/mp/d7/ps/mpd7pstl7eda-3ntjsvuz6aho_o.png)

## Usage

**Global:**

```bash
$ composer global require serafim/calc
$ cc run
```

**Local:**

```bash
$ composer require serafim/calc
$ ./vendor/bin/cc run
```

