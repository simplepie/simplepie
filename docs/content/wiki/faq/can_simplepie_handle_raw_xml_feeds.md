+++
title = "Can SimplePie handle raw XML feeds?"
+++

SimplePie is designed for the specific purpose of handling <abbr title="Rich Site Summary">RSS</abbr> and Atom feeds. Although SimplePie's individual classes could be made to work together to parse a raw <abbr title="Extensible Markup Language">XML</abbr> document, this is not what SimplePie was designed to do. For raw <abbr title="Extensible Markup Language">XML</abbr> parsing, we would recommend either PHP5's [SimpleXML](http://php.net/simplexml) extension, or [XMLize](http://hansanderson.com/php/xml/) (which powered the 0.9x releases of SimplePie).
