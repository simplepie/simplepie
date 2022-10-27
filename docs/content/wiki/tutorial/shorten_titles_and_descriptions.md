+++
title = "Shorten titles and descriptions"
+++

**There have been approximately 100 Jillion-Kabillion-Bazillion support questions asked about shortening titles and descriptions.**

- Some people want to break at a certain number of characters.
- Some people want to break at a certain number of characters, but don't want to break words.
- Some people want to break after a certain number of words.
- Some people want to break after a certain number of sentences.
- Some people want to do all of these things and maintain <abbr title="HyperText Markup Language">HTML</abbr> and entities.
- Some people want 100 Jillion-Kabillion-Bazillion dollars/pounds/euros/yen/pesos/whatever.

We had made some good progress on on this back in Summer 2006 while we were working on what would eventually become SimplePie Beta 3. We were trying to shorten descriptions by character, word, or sentence, with the ability to preserve <abbr title="HyperText Markup Language">HTML</abbr> and entities. We had something that kinda worked, but it was very buggy and unreliable so we scrapped it in its then-current form. We decided to push that feature off until we moved to the much more reliable <abbr title="Hypertext Preprocessor">PHP</abbr> <abbr title="Document Object Model">DOM</abbr> extension, which is currently slated for our SimplePie 2.0 release (which we plan to build from the ground-up to be <abbr title="Hypertext Preprocessor">PHP</abbr> 5/6 compatible, ridiculously fast, and more extensible than WordPress – things which are unrealistically challenging with our current PHP4-friendly codebase).

The solution is not as simple as you might think it would be, so here's the SIMPLEST solution.

## Compatibility {#compatibility}

- Supported in SimplePie 1.0.
- Code in this tutorial should be compatible with <abbr title="Hypertext Preprocessor">PHP</abbr> 4.3 or newer, and should not use <abbr title="Hypertext Preprocessor">PHP</abbr> short tags, in order to support the largest number of <abbr title="Hypertext Preprocessor">PHP</abbr> installations.

## Code source {#code_source}

This solution does the following things:

- Strips ALL <abbr title="HyperText Markup Language">HTML</abbr> (to get an accurate character count)
- Shortens the text by NUMBER OF CHARACTERS; Not by word, sentence, or anything else.
- Looks at where the text breaks, and makes an attempt to append the correct ending punctuation (an ellipsis, unless we broke where a sentence was already ending).
- It does NOT take <abbr title="HyperText Markup Language">HTML</abbr> entities into account.
- This code is NOT SimplePie-specific and can be used in any <abbr title="Hypertext Preprocessor">PHP</abbr> context.
- If you're looking for variations on this script, you can do a forum search for “shorten” or “truncate”, or look at the comments posted at <http://php.net/substr>.

```php
<?php
function shorten($string, $length)
{
    // By default, an ellipsis will be appended to the end of the text.
    $suffix = '&hellip;';

    // Convert 'smart' punctuation to 'dumb' punctuation, strip the HTML tags,
    // and convert all tabs and line-break characters to single spaces.
    $short_desc = trim(str_replace(array("\r","\n", "\t"), ' ', strip_tags($string)));

    // Cut the string to the requested length, and strip any extraneous spaces
    // from the beginning and end.
    $desc = trim(substr($short_desc, 0, $length));

    // Find out what the last displayed character is in the shortened string
    $lastchar = substr($desc, -1, 1);

    // If the last character is a period, an exclamation point, or a question
    // mark, clear out the appended text.
    if ($lastchar == '.' || $lastchar == '!' || $lastchar == '?') $suffix='';

    // Append the text.
    $desc .= $suffix;

    // Send the new description back to the page.
    return $desc;
}
?>
```

## Example Usage {#example_usage}

```php
<?php

// Shorten the text to 150 characters.
echo shorten($item->get_description(), 150);

?>
```
