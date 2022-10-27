+++
title = "Coding Standards"
+++

If you want to contribute a patch to SimplePie, please follow these coding guidelines.

## Quotes {#quotes}

Understand the [difference between single and double quotes](http://www.php.net/manual/en/language.types.string.php#language.types.string.syntax.single). Use whichever is more appropriate.

## Indentation {#indentation}

Indentation should follow the logical structure of the code. Use real tabs not spaces.

## Brace Style {#brace_style}

If there are 2 or more actions for the condition, brace style should be as follows:

```php
if ((condition1) || (condition2))
{
    action1;
    action2;
}
elseif ((condition3) && (condition4))
{
    action3;
    action4;
}
else
{
    defaultaction1;
    defaultaction2;
}
```

## Regular Expressions {#regular_expressions}

[Perl compatible regular expressions (PCRE)](http://php.net/pcre) should be used instead of their POSIX counterparts.

## No Shorthand PHP {#no_shorthand_php}

Never, ever, use shorthand <abbr title="Hypertext Preprocessor">PHP</abbr> start tags. The world will come to an end if you do. Always use `<?php … ?>`

## Ternary operators {#ternary_operators}

Don't test if the statement is false. That becomes confusing fast. Also, don't put functions on either side of the semi-colon.
