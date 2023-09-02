+++
title = "Supported Media Mime Types"
+++

SimplePie 1.0 has improved support for embedding more media mime types. It also introduces some new methods like `get_handler()` which tells you which handler SimplePie would recommend you use when writing your own embed code, and `get_real_type()` which tells you what the mime type _actually_ is based on the file extension of the media file and some other variables.

## Mime Types {#mime_types}

<table class="inline">
<thead>
<tr>
<th>Handler</th>
<th>Mime Types</th>
</tr>
</thead>
<tbody>
<tr>
<td>Flash</td>
<td><code>application/x-shockwave-flash</code>, <code>application/futuresplash</code></td>
</tr>
<tr>
<td>Flash Media</td>
<td><code>video/flv</code>, <code>video/x-flv</code></td>
</tr>
<tr>
<td><abbr title="Motion Picture Experts Group Layer 3">MP3</abbr></td>
<td><code>audio/mp3</code>, <code>audio/x-mp3</code>, <code>audio/mpeg</code>, <code>audio/x-mpeg</code></td>
</tr>
<tr>
<td>Odeo</td>
<td>(<abbr title="Motion Picture Experts Group Layer 3">MP3</abbr>'s from the <a href="http://odeo.com">Odeo</a> service)</td>
</tr>
<tr>
<td>QuickTime</td>
<td><code>audio/3gpp</code>, <code>audio/3gpp2</code>, <code>audio/aac</code>, <code>audio/x-aac</code>, <code>audio/aiff</code>, <code>audio/x-aiff</code>, <code>audio/mid</code>, <code>audio/midi</code>, <code>audio/x-midi</code>, <code>audio/mp4</code>, <code>audio/m4a</code>, <code>audio/x-m4a</code>, <code>audio/wav</code>, <code>audio/x-wav</code>, <code>video/3gpp</code>, <code>video/3gpp2</code>, <code>video/m4v</code>, <code>video/x-m4v</code>, <code>video/mp4</code>, <code>video/mpeg</code>, <code>video/x-mpeg</code>, <code>video/quicktime</code>, <code>video/sd-video</code></td>
</tr>
<tr>
<td>Windows Media</td>
<td><code>application/asx</code>, <code>application/x-mplayer2</code>, <code>audio/x-ms-wma</code>, <code>audio/x-ms-wax</code>, <code>video/x-ms-asf-plugin</code>, <code>video/x-ms-asf</code>, <code>video/x-ms-wm</code>, <code>video/x-ms-wmv</code>, <code>video/x-ms-wvx</code></td>
</tr>
</tbody>
</table>

## How does this apply? {#how_does_this_apply}

`get_real_type()` will check the file extension and return one of these listed mime types if its file extension (via `get_extension()`) is known to map to it (the right-side of the chart). `get_handler()` will return a value corresponding to the recommended handler for this particular mime type (the left side of the chart).

The variable here is whether or not the path to `mediaplayer.swf` has been given to the `mediaplayer` option in `embed()` and `native_embed()`. If so, Flash Media support will be enabled, and <abbr title="Motion Picture Experts Group Layer 3">MP3</abbr>'s will be handled by the Flash Media handler as well. If not, Flash Media support is disabled, and <abbr title="Motion Picture Experts Group Layer 3">MP3</abbr>'s will be handled by QuickTime instead.
