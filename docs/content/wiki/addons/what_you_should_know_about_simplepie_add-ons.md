+++
title = "What you should know about SimplePie Add-ons"
+++

SimplePie Add-ons are really, really cool, but there is a base level of knowledge required that is above SimplePie's normal knowledge requirements.

SimplePie is made up of a series of [classes](http://us.php.net/manual/en/ref.classobj.php) – each of which is geared for something different. [SimplePie_File](@/wiki/reference/simplepie_file/_index.md) is for getting files (like feeds), [SimplePie_Cache](@/wiki/reference/simplepie_cache/_index.md) is for caching them, [SimplePie_Parser](@/wiki/reference/simplepie_parser/_index.md) is for parsing them, and so on. You can get a complete list of these classes (and their methods) on the [API Reference](@/wiki/reference/_index.md) page. But these classes can also be extended ([PHP 4.x](http://php.net/manual/en/keyword.extends.php), [PHP 5.x](http://php.net/manual/en/language.oop5.basic.php#language.oop5.basic.extends)) to allow for new functionality to be added, or existing functionality to be altered.

This is what these add-ons do. They're designed to add or alter existing functionality in new ways to allow SimplePie to better fit your needs. Anybody who can understand the documentation in the preceding links should be able to write their own extensions to SimplePie.

To extend methods in specific classes, SimplePie has certain [configuration options](@/wiki/reference/_index.md#extending_classes_advanced) designed for exactly that, which tell SimplePie to use the extended version of the class instead of the built-in version.

More documentation will likely be added about this topic in the future, but this should be enough to get you started for the time being. If you happen to be knowledgeable in this area, please feel free to bring value to this page by editing it. :)
