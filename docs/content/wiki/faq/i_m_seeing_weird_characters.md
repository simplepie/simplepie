+++
title = "I'm seeing weird characters"
+++

This happens when you have a character set (aka “character encoding”) mismatch between SimplePie's output and the settings for your page.

By default, SimplePie outputs everything as UTF-8. To avoid display issues, you should also ensure that your web page is set to display as UTF-8. We chose UTF-8 as a default because it is a character set that contains a large number of characters from a variety of writing systems (Roman, Japanese, Chinese, Korean, Arabic, Hebrew, etc.)

## How to fix it {#how_to_fix_it}

### Change your page to UTF-8 {#change_your_page_to_utf-8}

It's important that your page and SimplePie's content have the same settings, regardless of what they are. It is preferred and highly recommended that you ensure that your page is set to use UTF-8. There are three ways to fix this issue:

1.  Set a `<meta>` tag inside the `<head>` section of your page that looks like the following:

    ```html
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    ```

2.  Use SimplePie's [handle_content_type()](@/wiki/reference/simplepie/handle_content_type.md) method to set the correct <abbr title="Hyper Text Transfer Protocol">HTTP</abbr> headers for you. This will also obey any [set_output_encoding()](@/wiki/reference/simplepie/set_output_encoding.md) setting you may have. This method only works if certain rules are followed so check out the [handle_content_type()](@/wiki/reference/simplepie/handle_content_type.md) documentation page for more details.

3.  Use <abbr title="Hypertext Preprocessor">PHP</abbr>'s built-in [header()](http://php.net/header) function to set the correct <abbr title="Hyper Text Transfer Protocol">HTTP</abbr> headers.

    ```php
    header('Content-type:text/html; charset=utf-8');
    ```

### Change SimplePie's output to match your page {#change_simplepie_s_output_to_match_your_page}

This should only be used by people who understand the potential drawbacks of not using a Unicode-based character set. If this sounds like gibberish to you, don't use this method. This is not the recommended solution because of potential complexities.

1.  Change SimplePie's output settings to match those of your page using [set_output_encoding()](@/wiki/reference/simplepie/set_output_encoding.md) in conjunction with [handle_content_type()](@/wiki/reference/simplepie/handle_content_type.md). For example, if your page is set to use `Windows-1252` and you want to maintain that, you can set SimplePie to output content as `Windows-1252` as well. See the [set_output_encoding()](@/wiki/reference/simplepie/set_output_encoding.md) documentation page for usage details.
