+++
title = "embed()"
+++

## Description {#description}

```php
class SimplePie_Enclosure {
    embed ( [(array) $options] )
}
```

Embeds the enclosure into the webpage using JavaScript.

This will use `get_real_type()` to determine which handler should be used to embed the content into the page. SimplePie supports QuickTime, Windows Media, Flash, Flash Media, and the Odeo Player for Odeo feeds.

Because of the fallout from the [Eolas lawsuit against Microsoft](http://en.wikipedia.org/wiki/Eolas) and the [changes that were recently made to Internet Explorer](http://blogs.msdn.com/ie/archive/2006/04/11/573479.aspx) as a result, we generate and include a [JavaScript library containing functions](http://msdn.microsoft.com/library/default.asp?url=/workshop/author/dhtml/overview/activating_activex.asp) that allow us to embed the multimedia content.

This function is identical to `native_embed()` except that, whereas `native_embed()` writes the (invalid) embed code directly into the page, this function uses JavaScript so that your pages can [validate](http://validator.w3.org/) as <abbr title="HyperText Markup Language">HTML</abbr> or <abbr title="Extensible HyperText Markup Language">XHTML</abbr>. Also, _this function will only work properly if SimplePie is initialized at the very top of the page._

## Availability {#availability}

- Available since SimplePie Beta 2.

## Parameters {#parameters}

### options {#options}

`options` is an array of multiple options that can all be passed into the <span class="curid">[embed()](@/wiki/reference/simplepie_enclosure/embed.md)</span> method. They are as follows:

- `alt` (string)  
  Alternate content for when an end-user does not have the appropriate handler installed or when a file type is unsupported. Can be any text or <abbr title="HyperText Markup Language">HTML</abbr>. Defaults to blank.
- `altclass` (string)  
  If a file type is unsupported, the end-user will see the alt text (above) linked directly to the content. That link will have this value as its class name. Defaults to blank.
- `audio` (string)  
  This is an image that should be used as a placeholder for audio files before they're loaded (QuickTime-only). Can be any relative or absolute <abbr title="Uniform Resource Locator">URL</abbr>. Defaults to blank.
- `bgcolor` (string)  
  The background color for the media, if not already transparent. Defaults to `#ffffff`.
- `height` (integer)  
  The height of the embedded media. Accepts any numeric pixel value (such as `360`) or `auto`. Defaults to `auto`, and it is recommended that you use this default.
- `loop` (boolean)  
  Do you want the media to loop when its done? Defaults to `false`.
- `mediaplayer` (string)  
  The location of the included `mediaplayer.swf` file. This allows for the playback of Flash Video (`.flv`) files, and is the default handler for non-Odeo <abbr title="Motion Picture Experts Group Layer 3">MP3</abbr>'s. Defaults to blank.
- `video` (string)  
  This is an image that should be used as a placeholder for video files before they're loaded (QuickTime-only). Can be any relative or absolute <abbr title="Uniform Resource Locator">URL</abbr>. Defaults to blank.
- `width` (integer)  
  The width of the embedded media. Accepts any numeric pixel value (such as `480`) or `auto`. Defaults to `auto`, and it is recommended that you use this default.
- `widescreen` (boolean)  
  Is the enclosure widescreen or standard? This applies only to video enclosures, and will automatically resize the content appropriately. Defaults to `false`, implying 4:3 mode.

**NOTE:** Non-widescreen (4:3) mode with `width` and `height` set to `auto` will default to 480×360 video resolution. Widescreen (16:9) mode with `width` and `height` set to `auto` will default to 480×270 video resolution.

## Examples {#examples}

```php
$feed = new SimplePie();
$feed->set_feed_url('http://youtube.com/rss/global/top_favorites.rss');
$feed->init();
$feed->handle_content_type();

foreach ($feed->get_items() as $item)
{
    if ($enclosure = $item->get_enclosure())
    {
        echo $enclosure->embed(array(
            'alt' => 'Download this enclosure!',
            'audio' => './for_the_demo/place_audio.png',
            'video' => './for_the_demo/place_video.png',
            'mediaplayer' => './for_the_demo/mediaplayer.swf',
            'widescreen' => true
        ));
    }
}
```

## See Also {#see_also}

- [SimplePie](@/wiki/reference/simplepie/_index.md)
- [SimplePie_Item](@/wiki/reference/simplepie_item/_index.md)
- [SimplePie_Enclosure](@/wiki/reference/simplepie_enclosure/_index.md)
- [native_embed()](@/wiki/reference/simplepie_enclosure/native_embed.md)
