<?php
/**
 * SimplePie
 *
 * A PHP-Based RSS and Atom Feed Framework.
 * Takes the hard work out of managing a complete RSS/Atom solution.
 *
 * Copyright (c) 2004-2016, Ryan Parman, Sam Sneddon, Ryan McCue, and contributors
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are
 * permitted provided that the following conditions are met:
 *
 * 	* Redistributions of source code must retain the above copyright notice, this list of
 * 	  conditions and the following disclaimer.
 *
 * 	* Redistributions in binary form must reproduce the above copyright notice, this list
 * 	  of conditions and the following disclaimer in the documentation and/or other materials
 * 	  provided with the distribution.
 *
 * 	* Neither the name of the SimplePie Team nor the names of its contributors may be used
 * 	  to endorse or promote products derived from this software without specific prior
 * 	  written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS
 * OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY
 * AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDERS
 * AND CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR
 * OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package SimplePie
 * @copyright 2004-2016 Ryan Parman, Sam Sneddon, Ryan McCue
 * @author Ryan Parman
 * @author Sam Sneddon
 * @author Ryan McCue
 * @author Lex Vjatkin
 * @link http://simplepie.org/ SimplePie
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 */

class SanitizeTest extends PHPUnit\Framework\TestCase
{
	public function testSanitize()
	{
		$sanitize = new SimplePie_Sanitize();

		$this->assertSame(
<<<EOT
&lt;head&gt; &amp; &lt;body&gt; /\ ' === ' &amp; " === ". Sbohem bez šátečku! Тут был Лёха.
EOT
			,
			$sanitize->sanitize(
<<<EOT
&#60;head&#62; &amp; &lt;body&gt; /\ ' === &apos; &#38; " === &quot;. Sbohem bez šátečku! Тут был Лёха.<script>alert('XSS')</script>
EOT
				,
				SIMPLEPIE_CONSTRUCT_MAYBE_HTML
			),
			'XML input (with corresponding xml entities) should be cleaned and converted to utf-8 escaped HTML'
		);
	}


    public function sanitizeURLProvider()
    {
        return array(
            'simple absolute valid a href, resolved' => array(
                '<a href="/path/to/doc">link</a>',
                '<a href="http://example.com/path/to/doc">link</a>'
            ),
            'image valid fully qualified src, no change expected' => array(
                '<img src="http://2.example.com/image.jpg">',
                '<img src="http://2.example.com/image.jpg">'
            ),
            'image valid relative src, resolved' => array(
                '<img src="image.jpg">',
                '<img src="http://example.com/image.jpg">'
            ),
            'image valid absolute src, resolved' => array(
                '<img src="/image.jpg">',
                '<img src="http://example.com/image.jpg">'
            ),
            'audio relative src, resolved, fixed' => array(
                '<audio src="a.mp3" />',
                '<audio src="http://example.com/a.mp3" preload="none"></audio>'
            ),
            'audio absolute source src path, resolved, fixed' => array(
                '<audio><source src="/a/b.wav" /></audio>',
                '<audio preload="none"><source src="http://example.com/a/b.wav"></audio>'
            ),
            'audio with alternative source src absolute paths, resolved, fixed' => array(
                '<audio><source src="a/b.wav" /><source src="/c/d.mp3" /></audio>',
                '<audio preload="none"><source src="http://example.com/a/b.wav"><source src="http://example.com/c/d.mp3"></audio>'
            ),
            'video src relative, resolved, fixed' => array(
                '<video src="./b.mpeg" />',
                '<video src="http://example.com/b.mpeg" preload="none"></video>'
            ),
            'video with alternative source src, resolved, fixed' => array(
                '<video><source src="a/b.mpeg" /><source src="/c/../d.mov"></video>',
                '<video preload="none"><source src="http://example.com/a/b.mpeg"><source src="http://example.com/d.mov"></video>'
            )
        );
    }

    /**
     * @dataProvider sanitizeURLProvider
     */
    public function testSanitizeURLResolution($given, $expected)
    {
        $sanitize = new SimplePie_Sanitize();

        $registry = new SimplePie_Registry();
        $registry->register('Misc', 'SimplePie_Misc');
        $sanitize->set_registry($registry);

        $base = 'http://example.com/';

        $this->assertSame($expected, $sanitize->sanitize($given, SIMPLEPIE_CONSTRUCT_HTML, $base));
    }
}
