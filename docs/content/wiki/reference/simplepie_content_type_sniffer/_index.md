+++
title = "SimplePie_Content_Type_Sniffer"
+++

<div class="warning">

This is a non-public object, and is only intended to be used internally by SimplePie.

</div>

<span class="curid">[SimplePie_Content_Type_Sniffer](@/wiki/reference/simplepie_content_type_sniffer/_index.md)</span> is used for detecting the correct Content-Type of files when the <abbr title="Hyper Text Transfer Protocol">HTTP</abbr> headers can't be trusted. Our implementation is based upon [HTML 5](http://www.whatwg.org/specs/web-apps/current-work/#content-type-sniffing), which is very similar to what Firefox 3 will ship with. This algorithm is designed to minimise possible security risks caused by treating content differently to how it is served, as well as being mostly compatible with Internet Explorer 7 and Safari 3. The sniffing may change in part, or in whole, at any time. This class can be overloaded with [set_content_type_sniffer_class()](@/wiki/reference/simplepie/set_content_type_sniffer_class.md).

## See Also {#see_also}

<div id="plugin__backlinks">

- [set_content_type_sniffer_class()](@/wiki/reference/simplepie/set_content_type_sniffer_class.md)
- <span class="curid">[SimplePie_Content_Type_Sniffer](@/wiki/reference/simplepie_content_type_sniffer/_index.md)</span>
- [API Reference](@/wiki/reference/_index.md)

</div>
