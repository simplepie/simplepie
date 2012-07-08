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
	// itunes_rss/...
	array('<rss xmlns:itunes="http://www.itunes.com/DTDs/Podcast-1.0.dtd">
	<channel>
		<itunes:block>yes</itunes:block>
		<item>
			<enclosure url="http://test.com/test.mp3" />
		</item>
	</channel>
</rss>', 'deny'), // SPtests\rss\2.0\itunes_channel_block.php
	array('<rss xmlns:itunes="http://www.itunes.com/DTDs/Podcast-1.0.dtd">
	<channel>
		<item>
			<enclosure url="http://test.com/test.mp3" />
		</item>
	</channel>
</rss>', 'allow'), // SPtests\rss\2.0\itunes_channel_block_default.php
	array('<rss xmlns:itunes="http://www.itunes.com/DTDs/Podcast-1.0.dtd">
	<channel>
		<itunes:block>no</itunes:block>
		<item>
			<enclosure url="http://test.com/test.mp3" />
		</item>
	</channel>
</rss>', 'allow'), // SPtests\rss\2.0\itunes_channel_block_reverse.php
);
