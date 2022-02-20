<?php
/**
 * SimplePie
 *
 * A PHP-Based RSS and Atom Feed Framework.
 * Takes the hard work out of managing a complete RSS/Atom solution.
 *
 * Copyright (c) 2004-2017, Ryan Parman, Sam Sneddon, Ryan McCue, and contributors
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
 * @version 1.5.8
 * @copyright 2004-2017 Ryan Parman, Sam Sneddon, Ryan McCue
 * @author Ryan Parman
 * @author Sam Sneddon
 * @author Ryan McCue
 * @link http://simplepie.org/ SimplePie
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 */

use SimplePie\SimplePie as NamespacedSimplePie;

class_exists('SimplePie\SimplePie');

// @trigger_error(sprintf('Using the "SimplePie" class is deprecated since SimplePie version 1.x, use "SimplePie\SimplePie" instead.'), \E_USER_DEPRECATED);

if (\false) {
	/** @deprecated since SimplePie 1.x, use "SimplePie\SimplePie" instead */
	class SimplePie extends NamespacedSimplePie
	{
	}
}

/**
 * SimplePie Name
 */
define('SIMPLEPIE_NAME', NamespacedSimplePie::SIMPLEPIE_NAME);

/**
 * SimplePie Version
 */
define('SIMPLEPIE_VERSION', NamespacedSimplePie::SIMPLEPIE_VERSION);

/**
 * SimplePie Build
 * @todo Hardcode for release (there's no need to have to call SimplePie_Misc::get_build() only every load of simplepie.inc)
 */
define('SIMPLEPIE_BUILD', gmdate('YmdHis', \SimplePie\Misc::get_build()));

/**
 * SimplePie Website URL
 */
define('SIMPLEPIE_URL', NamespacedSimplePie::SIMPLEPIE_URL);

/**
 * SimplePie Useragent
 * @see SimplePie::set_useragent()
 * @deprecated since SimplePie 1.x, use \SimplePie\Misc::get_default_useragent() instead.
 */
define('SIMPLEPIE_USERAGENT', \SimplePie\Misc::get_default_useragent());

/**
 * SimplePie Linkback
 */
define('SIMPLEPIE_LINKBACK', NamespacedSimplePie::SIMPLEPIE_LINKBACK);

/**
 * No Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_NONE', NamespacedSimplePie::SIMPLEPIE_LOCATOR_NONE);

/**
 * Feed Link Element Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_AUTODISCOVERY', NamespacedSimplePie::SIMPLEPIE_LOCATOR_AUTODISCOVERY);

/**
 * Local Feed Extension Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_LOCAL_EXTENSION', NamespacedSimplePie::SIMPLEPIE_LOCATOR_LOCAL_EXTENSION);

/**
 * Local Feed Body Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_LOCAL_BODY', NamespacedSimplePie::SIMPLEPIE_LOCATOR_LOCAL_BODY);

/**
 * Remote Feed Extension Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_REMOTE_EXTENSION', NamespacedSimplePie::SIMPLEPIE_LOCATOR_REMOTE_EXTENSION);

/**
 * Remote Feed Body Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_REMOTE_BODY', NamespacedSimplePie::SIMPLEPIE_LOCATOR_REMOTE_BODY);

/**
 * All Feed Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_ALL', NamespacedSimplePie::SIMPLEPIE_LOCATOR_ALL);

/**
 * No known feed type
 */
define('SIMPLEPIE_TYPE_NONE', NamespacedSimplePie::SIMPLEPIE_TYPE_NONE);

/**
 * RSS 0.90
 */
define('SIMPLEPIE_TYPE_RSS_090', NamespacedSimplePie::SIMPLEPIE_TYPE_RSS_090);

/**
 * RSS 0.91 (Netscape)
 */
define('SIMPLEPIE_TYPE_RSS_091_NETSCAPE', NamespacedSimplePie::SIMPLEPIE_TYPE_RSS_091_NETSCAPE);

/**
 * RSS 0.91 (Userland)
 */
define('SIMPLEPIE_TYPE_RSS_091_USERLAND', NamespacedSimplePie::SIMPLEPIE_TYPE_RSS_091_USERLAND);

/**
 * RSS 0.91 (both Netscape and Userland)
 */
define('SIMPLEPIE_TYPE_RSS_091', NamespacedSimplePie::SIMPLEPIE_TYPE_RSS_091);

/**
 * RSS 0.92
 */
define('SIMPLEPIE_TYPE_RSS_092', NamespacedSimplePie::SIMPLEPIE_TYPE_RSS_092);

/**
 * RSS 0.93
 */
define('SIMPLEPIE_TYPE_RSS_093', NamespacedSimplePie::SIMPLEPIE_TYPE_RSS_093);

/**
 * RSS 0.94
 */
define('SIMPLEPIE_TYPE_RSS_094', NamespacedSimplePie::SIMPLEPIE_TYPE_RSS_094);

/**
 * RSS 1.0
 */
define('SIMPLEPIE_TYPE_RSS_10', NamespacedSimplePie::SIMPLEPIE_TYPE_RSS_10);

/**
 * RSS 2.0
 */
define('SIMPLEPIE_TYPE_RSS_20', NamespacedSimplePie::SIMPLEPIE_TYPE_RSS_20);

/**
 * RDF-based RSS
 */
define('SIMPLEPIE_TYPE_RSS_RDF', NamespacedSimplePie::SIMPLEPIE_TYPE_RSS_RDF);

/**
 * Non-RDF-based RSS (truly intended as syndication format)
 */
define('SIMPLEPIE_TYPE_RSS_SYNDICATION', NamespacedSimplePie::SIMPLEPIE_TYPE_RSS_SYNDICATION);

/**
 * All RSS
 */
define('SIMPLEPIE_TYPE_RSS_ALL', NamespacedSimplePie::SIMPLEPIE_TYPE_RSS_ALL);

/**
 * Atom 0.3
 */
define('SIMPLEPIE_TYPE_ATOM_03', NamespacedSimplePie::SIMPLEPIE_TYPE_ATOM_03);

/**
 * Atom 1.0
 */
define('SIMPLEPIE_TYPE_ATOM_10', NamespacedSimplePie::SIMPLEPIE_TYPE_ATOM_10);

/**
 * All Atom
 */
define('SIMPLEPIE_TYPE_ATOM_ALL', NamespacedSimplePie::SIMPLEPIE_TYPE_ATOM_ALL);

/**
 * All feed types
 */
define('SIMPLEPIE_TYPE_ALL', NamespacedSimplePie::SIMPLEPIE_TYPE_ALL);

/**
 * No construct
 */
define('SIMPLEPIE_CONSTRUCT_NONE', NamespacedSimplePie::SIMPLEPIE_CONSTRUCT_NONE);

/**
 * Text construct
 */
define('SIMPLEPIE_CONSTRUCT_TEXT', NamespacedSimplePie::SIMPLEPIE_CONSTRUCT_TEXT);

/**
 * HTML construct
 */
define('SIMPLEPIE_CONSTRUCT_HTML', NamespacedSimplePie::SIMPLEPIE_CONSTRUCT_HTML);

/**
 * XHTML construct
 */
define('SIMPLEPIE_CONSTRUCT_XHTML', NamespacedSimplePie::SIMPLEPIE_CONSTRUCT_XHTML);

/**
 * base64-encoded construct
 */
define('SIMPLEPIE_CONSTRUCT_BASE64', NamespacedSimplePie::SIMPLEPIE_CONSTRUCT_BASE64);

/**
 * IRI construct
 */
define('SIMPLEPIE_CONSTRUCT_IRI', NamespacedSimplePie::SIMPLEPIE_CONSTRUCT_IRI);

/**
 * A construct that might be HTML
 */
define('SIMPLEPIE_CONSTRUCT_MAYBE_HTML', NamespacedSimplePie::SIMPLEPIE_CONSTRUCT_MAYBE_HTML);

/**
 * All constructs
 */
define('SIMPLEPIE_CONSTRUCT_ALL', NamespacedSimplePie::SIMPLEPIE_CONSTRUCT_ALL);

/**
 * Don't change case
 */
define('SIMPLEPIE_SAME_CASE', NamespacedSimplePie::SIMPLEPIE_SAME_CASE);

/**
 * Change to lowercase
 */
define('SIMPLEPIE_LOWERCASE', NamespacedSimplePie::SIMPLEPIE_LOWERCASE);

/**
 * Change to uppercase
 */
define('SIMPLEPIE_UPPERCASE', NamespacedSimplePie::SIMPLEPIE_UPPERCASE);

/**
 * PCRE for HTML attributes
 */
define('SIMPLEPIE_PCRE_HTML_ATTRIBUTE', NamespacedSimplePie::SIMPLEPIE_PCRE_HTML_ATTRIBUTE);

/**
 * PCRE for XML attributes
 */
define('SIMPLEPIE_PCRE_XML_ATTRIBUTE', NamespacedSimplePie::SIMPLEPIE_PCRE_XML_ATTRIBUTE);

/**
 * XML Namespace
 */
define('SIMPLEPIE_NAMESPACE_XML', NamespacedSimplePie::SIMPLEPIE_NAMESPACE_XML);

/**
 * Atom 1.0 Namespace
 */
define('SIMPLEPIE_NAMESPACE_ATOM_10', NamespacedSimplePie::SIMPLEPIE_NAMESPACE_ATOM_10);

/**
 * Atom 0.3 Namespace
 */
define('SIMPLEPIE_NAMESPACE_ATOM_03', NamespacedSimplePie::SIMPLEPIE_NAMESPACE_ATOM_03);

/**
 * RDF Namespace
 */
define('SIMPLEPIE_NAMESPACE_RDF', NamespacedSimplePie::SIMPLEPIE_NAMESPACE_RDF);

/**
 * RSS 0.90 Namespace
 */
define('SIMPLEPIE_NAMESPACE_RSS_090', NamespacedSimplePie::SIMPLEPIE_NAMESPACE_RSS_090);

/**
 * RSS 1.0 Namespace
 */
define('SIMPLEPIE_NAMESPACE_RSS_10', NamespacedSimplePie::SIMPLEPIE_NAMESPACE_RSS_10);

/**
 * RSS 1.0 Content Module Namespace
 */
define('SIMPLEPIE_NAMESPACE_RSS_10_MODULES_CONTENT', NamespacedSimplePie::SIMPLEPIE_NAMESPACE_RSS_10_MODULES_CONTENT);

/**
 * RSS 2.0 Namespace
 * (Stupid, I know, but I'm certain it will confuse people less with support.)
 */
define('SIMPLEPIE_NAMESPACE_RSS_20', NamespacedSimplePie::SIMPLEPIE_NAMESPACE_RSS_20);

/**
 * DC 1.0 Namespace
 */
define('SIMPLEPIE_NAMESPACE_DC_10', NamespacedSimplePie::SIMPLEPIE_NAMESPACE_DC_10);

/**
 * DC 1.1 Namespace
 */
define('SIMPLEPIE_NAMESPACE_DC_11', NamespacedSimplePie::SIMPLEPIE_NAMESPACE_DC_11);

/**
 * W3C Basic Geo (WGS84 lat/long) Vocabulary Namespace
 */
define('SIMPLEPIE_NAMESPACE_W3C_BASIC_GEO', NamespacedSimplePie::SIMPLEPIE_NAMESPACE_W3C_BASIC_GEO);

/**
 * GeoRSS Namespace
 */
define('SIMPLEPIE_NAMESPACE_GEORSS', NamespacedSimplePie::SIMPLEPIE_NAMESPACE_GEORSS);

/**
 * Media RSS Namespace
 */
define('SIMPLEPIE_NAMESPACE_MEDIARSS', NamespacedSimplePie::SIMPLEPIE_NAMESPACE_MEDIARSS);

/**
 * Wrong Media RSS Namespace. Caused by a long-standing typo in the spec.
 */
define('SIMPLEPIE_NAMESPACE_MEDIARSS_WRONG', NamespacedSimplePie::SIMPLEPIE_NAMESPACE_MEDIARSS_WRONG);

/**
 * Wrong Media RSS Namespace #2. New namespace introduced in Media RSS 1.5.
 */
define('SIMPLEPIE_NAMESPACE_MEDIARSS_WRONG2', NamespacedSimplePie::SIMPLEPIE_NAMESPACE_MEDIARSS_WRONG2);

/**
 * Wrong Media RSS Namespace #3. A possible typo of the Media RSS 1.5 namespace.
 */
define('SIMPLEPIE_NAMESPACE_MEDIARSS_WRONG3', NamespacedSimplePie::SIMPLEPIE_NAMESPACE_MEDIARSS_WRONG3);

/**
 * Wrong Media RSS Namespace #4. New spec location after the RSS Advisory Board takes it over, but not a valid namespace.
 */
define('SIMPLEPIE_NAMESPACE_MEDIARSS_WRONG4', NamespacedSimplePie::SIMPLEPIE_NAMESPACE_MEDIARSS_WRONG4);

/**
 * Wrong Media RSS Namespace #5. A possible typo of the RSS Advisory Board URL.
 */
define('SIMPLEPIE_NAMESPACE_MEDIARSS_WRONG5', NamespacedSimplePie::SIMPLEPIE_NAMESPACE_MEDIARSS_WRONG5);

/**
 * iTunes RSS Namespace
 */
define('SIMPLEPIE_NAMESPACE_ITUNES', NamespacedSimplePie::SIMPLEPIE_NAMESPACE_ITUNES);

/**
 * XHTML Namespace
 */
define('SIMPLEPIE_NAMESPACE_XHTML', NamespacedSimplePie::SIMPLEPIE_NAMESPACE_XHTML);

/**
 * IANA Link Relations Registry
 */
define('SIMPLEPIE_IANA_LINK_RELATIONS_REGISTRY', NamespacedSimplePie::SIMPLEPIE_IANA_LINK_RELATIONS_REGISTRY);

/**
 * No file source
 */
define('SIMPLEPIE_FILE_SOURCE_NONE', NamespacedSimplePie::SIMPLEPIE_FILE_SOURCE_NONE);

/**
 * Remote file source
 */
define('SIMPLEPIE_FILE_SOURCE_REMOTE', NamespacedSimplePie::SIMPLEPIE_FILE_SOURCE_REMOTE);

/**
 * Local file source
 */
define('SIMPLEPIE_FILE_SOURCE_LOCAL', NamespacedSimplePie::SIMPLEPIE_FILE_SOURCE_LOCAL);

/**
 * fsockopen() file source
 */
define('SIMPLEPIE_FILE_SOURCE_FSOCKOPEN', NamespacedSimplePie::SIMPLEPIE_FILE_SOURCE_FSOCKOPEN);

/**
 * cURL file source
 */
define('SIMPLEPIE_FILE_SOURCE_CURL', NamespacedSimplePie::SIMPLEPIE_FILE_SOURCE_CURL);

/**
 * file_get_contents() file source
 */
define('SIMPLEPIE_FILE_SOURCE_FILE_GET_CONTENTS', NamespacedSimplePie::SIMPLEPIE_FILE_SOURCE_FILE_GET_CONTENTS);
