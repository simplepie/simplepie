<?php
/**
 * SimplePie 1.2 PHPUnit Testsuite
 *
 * PHP Version 5.2
 *
 * @license <http://www.spdx.org/licenses/LGPL-2.1+> GNU Lesser General Public License v2.1 or later
 * @copyright Copyright © 2007, Geoffrey Sneddon
 * @copyright Copyright © 2012, hakre <http://hakre.wordpress.com/>
 */

return array(
	// who_knows_a_title_from_a_hole_in_the_ground/...
	array('<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
<id>http://atomtests.philringnalda.com/tests/item/title/html-cdata.atom</id>
<title>Atom item title html cdata</title>
<updated>2005-12-18T00:13:00Z</updated>
<author>
  <name>Phil Ringnalda</name>
  <uri>http://weblog.philringnalda.com/</uri>
</author>
<link rel="self" href="http://atomtests.philringnalda.com/tests/item/title/html-cdata.atom"/>
<entry>
  <id>http://atomtests.philringnalda.com/tests/item/title/html-cdata.atom/1</id>
  <title type="html"><![CDATA[&lt;title>]]></title>
  <updated>2005-12-18T00:13:00Z</updated>
  <summary>An item with a type="html" title consisting of a less-than
character, the word \'title\' and a greater-than character, where
the character entity reference for the less-than is escaped by being
in a CDATA section.</summary>
  <link href="http://atomtests.philringnalda.com/alt/title-title.html"/>
  <category term="item title"/>
</entry>
</feed>', '&lt;title>'), // html\cdata.php
	array('<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
<id>http://atomtests.philringnalda.com/tests/item/title/html-entity.atom</id>
<title>Atom item title html entity</title>
<updated>2005-12-18T00:13:00Z</updated>
<author>
  <name>Phil Ringnalda</name>
  <uri>http://weblog.philringnalda.com/</uri>
</author>
<link rel="self" href="http://atomtests.philringnalda.com/tests/item/title/html-entity.atom"/>
<entry>
  <id>http://atomtests.philringnalda.com/tests/item/title/html-entity.atom/1</id>
  <title type="html">&amp;lt;title></title>
  <updated>2005-12-18T00:13:00Z</updated>
  <summary>An item with a type="html" title consisting of a less-than
character, the word \'title\' and a greater-than character, where the
character entity reference for the less-than character is escaped by
replacing the ampersand with a character entity reference.</summary>
  <link href="http://atomtests.philringnalda.com/alt/title-title.html"/>
  <category term="item title"/>
</entry>
</feed>', '&lt;title>'), // html\entity.php
	array('<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
<id>http://atomtests.philringnalda.com/tests/item/title/html-ncr.atom</id>
<title>Atom item title html NCR</title>
<updated>2005-12-18T00:13:00Z</updated>
<author>
  <name>Phil Ringnalda</name>
  <uri>http://weblog.philringnalda.com/</uri>
</author>
<link rel="self" href="http://atomtests.philringnalda.com/tests/item/title/html-ncr.atom"/>
<entry>
  <id>http://atomtests.philringnalda.com/tests/item/title/html-ncr.atom/1</id>
  <title type="html">&#38;lt;title></title>
  <updated>2005-12-18T00:13:00Z</updated>
  <summary>An item with a type="html" title consisting of a less-than
character, the word \'title\' and a greater-than character, where
the HTML\'s character entity reference is escaped by replacing the
ampersand with a numeric character reference.</summary>
  <link href="http://atomtests.philringnalda.com/alt/title-title.html"/>
  <category term="item title"/>
</entry>
</feed>', '&lt;title>'), // html\ncr.php
	array('<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
<id>http://atomtests.philringnalda.com/tests/item/title/text-cdata.atom</id>
<title>Atom item title text in CDATA</title>
<updated>2005-12-18T00:13:00Z</updated>
<author>
  <name>Phil Ringnalda</name>
  <uri>http://weblog.philringnalda.com/</uri>
</author>
<link rel="self" href="http://atomtests.philringnalda.com/tests/item/title/text-cdata.atom"/>
<entry>

<id>http://atomtests.philringnalda.com/tests/item/title/text-cdata.atom/1</id>
  <title type="text"><![CDATA[<title>]]></title>
  <updated>2005-12-18T00:13:00Z</updated>
  <summary>An item with a type="text" title consisting of a less-than
character, the word \'title\' and a greater-than character, where
the less-than is escaped by being in a CDATA section.</summary>
  <link href="http://atomtests.philringnalda.com/alt/title-title.html"/>
  <category term="item title"/>
</entry>
</feed>', '&lt;title&gt;'), // text\cdata.php
	array('<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
<id>http://atomtests.philringnalda.com/tests/item/title/text-entity.atom</id>
<title>Atom item title text entity</title>
<updated>2005-12-18T00:13:00Z</updated>
<author>
  <name>Phil Ringnalda</name>
  <uri>http://weblog.philringnalda.com/</uri>
</author>
<link rel="self" href="http://atomtests.philringnalda.com/tests/item/title/text-entity.atom"/>
<entry>
  <id>http://atomtests.philringnalda.com/tests/item/title/text-entity.atom/1</id>
  <title type="text">&lt;title></title>
  <updated>2005-12-18T00:13:00Z</updated>
  <summary>An item with a type="text" title consisting of a less-than
character, the word \'title\' and a greater-than character, where the
less-than is escaped with its character entity reference.</summary>
  <link href="http://atomtests.philringnalda.com/alt/title-title.html"/>
  <category term="item title"/>
</entry>
</feed>', '&lt;title&gt;'), // text\entity.php
	array('<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
<id>http://atomtests.philringnalda.com/tests/item/title/text-ncr.atom</id>
<title>Atom item title text NCR</title>
<updated>2005-12-18T00:13:00Z</updated>
<author>
  <name>Phil Ringnalda</name>
  <uri>http://weblog.philringnalda.com/</uri>
</author>
<link rel="self" href="http://atomtests.philringnalda.com/tests/item/title/text-ncr.atom"/>
<entry>
  <id>http://atomtests.philringnalda.com/tests/item/title/text-ncr.atom/1</id>
  <title type="text">&#60;title></title>
  <updated>2005-12-18T00:13:00Z</updated>
  <summary>An item with a type="text" title consisting of a less-than
character, the word \'title\' and a greater-than character, where the
less-than character is escaped with a numeric character reference.</summary>
  <link href="http://atomtests.philringnalda.com/alt/title-title.html"/>
  <category term="item title"/>
</entry>
</feed>', '&lt;title&gt;'), // text\ncr.php
	array('<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
<id>http://atomtests.philringnalda.com/tests/item/title/xhtml-entity.atom</id>
<title>Atom item title xhtml entity</title>
<updated>2005-12-18T00:13:00Z</updated>
<author>
  <name>Phil Ringnalda</name>
  <uri>http://weblog.philringnalda.com/</uri>
</author>
<link rel="self" href="http://atomtests.philringnalda.com/tests/item/title/xhtml-entity.atom"/>
<entry>
  <id>http://atomtests.philringnalda.com/tests/item/title/xhtml-entity.atom/1</id>
  <title type="xhtml"><div xmlns="http://www.w3.org/1999/xhtml">&lt;title></div></title>
  <updated>2005-12-18T00:13:00Z</updated>
  <summary>An item with a type="xhtml" title consisting of a less-than
character, the word \'title\' and a greater-than character, where the
less-than character is escaped with its character entity reference.</summary>
  <link href="http://atomtests.philringnalda.com/alt/title-title.html"/>
  <category term="item title"/>
</entry>
</feed>', '&lt;title&gt;'), // xhtml\entity.php
	array('<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
<id>http://atomtests.philringnalda.com/tests/item/title/xhtml-ncr.atom</id>
<title>Atom item title xhtml ncr</title>
<updated>2005-12-18T00:13:00Z</updated>
<author>
  <name>Phil Ringnalda</name>
  <uri>http://weblog.philringnalda.com/</uri>
</author>
<link rel="self" href="http://atomtests.philringnalda.com/tests/item/title/xhtml-ncr.atom"/>
<entry>
  <id>http://atomtests.philringnalda.com/tests/item/title/xhtml-ncr.atom/1</id>
  <title type="xhtml"><div xmlns="http://www.w3.org/1999/xhtml">&#60;title></div></title>
  <updated>2005-12-18T00:13:00Z</updated>
  <summary>An item with a type="xhtml" title consisting of a less-than
character, the word \'title\' and a greater-than character, where
the less-than character is escaped with its numeric character reference.</summary>
  <link href="http://atomtests.philringnalda.com/alt/title-title.html"/>
  <category term="item title"/>
</entry>
</feed>', '&lt;title&gt;'), // xhtml\ncr.php
);
