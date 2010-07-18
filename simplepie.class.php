<?php
// autoloader
spl_autoload_register(array(new SimplePie_Autoloader, 'autoload'));

/**
 * SimplePie Name
 */
define('SIMPLEPIE_NAME', 'SimplePie');

/**
 * SimplePie Version
 */
define('SIMPLEPIE_VERSION', '1.3-dev');

/**
 * SimplePie Build
 * @todo Hardcode for release (there's no need to have to call SimplePie_Misc::parse_date() only every load of simplepie.inc)
 */
define('SIMPLEPIE_BUILD', gmdate('YmdHis', SimplePie_Misc::parse_date(substr('$Date$', 7, 25)) ? SimplePie_Misc::parse_date(substr('$Date$', 7, 25)) : filemtime(__FILE__)));

/**
 * SimplePie Website URL
 */
define('SIMPLEPIE_URL', 'http://simplepie.org');

/**
 * SimplePie Useragent
 * @see SimplePie::set_useragent()
 */
define('SIMPLEPIE_USERAGENT', SIMPLEPIE_NAME . '/' . SIMPLEPIE_VERSION . ' (Feed Parser; ' . SIMPLEPIE_URL . '; Allow like Gecko) Build/' . SIMPLEPIE_BUILD);

/**
 * SimplePie Linkback
 */
define('SIMPLEPIE_LINKBACK', '<a href="' . SIMPLEPIE_URL . '" title="' . SIMPLEPIE_NAME . ' ' . SIMPLEPIE_VERSION . '">' . SIMPLEPIE_NAME . '</a>');

/**
 * No Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_NONE', 0);

/**
 * Feed Link Element Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_AUTODISCOVERY', 1);

/**
 * Local Feed Extension Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_LOCAL_EXTENSION', 2);

/**
 * Local Feed Body Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_LOCAL_BODY', 4);

/**
 * Remote Feed Extension Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_REMOTE_EXTENSION', 8);

/**
 * Remote Feed Body Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_REMOTE_BODY', 16);

/**
 * All Feed Autodiscovery
 * @see SimplePie::set_autodiscovery_level()
 */
define('SIMPLEPIE_LOCATOR_ALL', 31);

/**
 * No known feed type
 */
define('SIMPLEPIE_TYPE_NONE', 0);

/**
 * RSS 0.90
 */
define('SIMPLEPIE_TYPE_RSS_090', 1);

/**
 * RSS 0.91 (Netscape)
 */
define('SIMPLEPIE_TYPE_RSS_091_NETSCAPE', 2);

/**
 * RSS 0.91 (Userland)
 */
define('SIMPLEPIE_TYPE_RSS_091_USERLAND', 4);

/**
 * RSS 0.91 (both Netscape and Userland)
 */
define('SIMPLEPIE_TYPE_RSS_091', 6);

/**
 * RSS 0.92
 */
define('SIMPLEPIE_TYPE_RSS_092', 8);

/**
 * RSS 0.93
 */
define('SIMPLEPIE_TYPE_RSS_093', 16);

/**
 * RSS 0.94
 */
define('SIMPLEPIE_TYPE_RSS_094', 32);

/**
 * RSS 1.0
 */
define('SIMPLEPIE_TYPE_RSS_10', 64);

/**
 * RSS 2.0
 */
define('SIMPLEPIE_TYPE_RSS_20', 128);

/**
 * RDF-based RSS
 */
define('SIMPLEPIE_TYPE_RSS_RDF', 65);

/**
 * Non-RDF-based RSS (truly intended as syndication format)
 */
define('SIMPLEPIE_TYPE_RSS_SYNDICATION', 190);

/**
 * All RSS
 */
define('SIMPLEPIE_TYPE_RSS_ALL', 255);

/**
 * Atom 0.3
 */
define('SIMPLEPIE_TYPE_ATOM_03', 256);

/**
 * Atom 1.0
 */
define('SIMPLEPIE_TYPE_ATOM_10', 512);

/**
 * All Atom
 */
define('SIMPLEPIE_TYPE_ATOM_ALL', 768);

/**
 * All feed types
 */
define('SIMPLEPIE_TYPE_ALL', 1023);

/**
 * No construct
 */
define('SIMPLEPIE_CONSTRUCT_NONE', 0);

/**
 * Text construct
 */
define('SIMPLEPIE_CONSTRUCT_TEXT', 1);

/**
 * HTML construct
 */
define('SIMPLEPIE_CONSTRUCT_HTML', 2);

/**
 * XHTML construct
 */
define('SIMPLEPIE_CONSTRUCT_XHTML', 4);

/**
 * base64-encoded construct
 */
define('SIMPLEPIE_CONSTRUCT_BASE64', 8);

/**
 * IRI construct
 */
define('SIMPLEPIE_CONSTRUCT_IRI', 16);

/**
 * A construct that might be HTML
 */
define('SIMPLEPIE_CONSTRUCT_MAYBE_HTML', 32);

/**
 * All constructs
 */
define('SIMPLEPIE_CONSTRUCT_ALL', 63);

/**
 * Don't change case
 */
define('SIMPLEPIE_SAME_CASE', 1);

/**
 * Change to lowercase
 */
define('SIMPLEPIE_LOWERCASE', 2);

/**
 * Change to uppercase
 */
define('SIMPLEPIE_UPPERCASE', 4);

/**
 * PCRE for HTML attributes
 */
define('SIMPLEPIE_PCRE_HTML_ATTRIBUTE', '((?:[\x09\x0A\x0B\x0C\x0D\x20]+[^\x09\x0A\x0B\x0C\x0D\x20\x2F\x3E][^\x09\x0A\x0B\x0C\x0D\x20\x2F\x3D\x3E]*(?:[\x09\x0A\x0B\x0C\x0D\x20]*=[\x09\x0A\x0B\x0C\x0D\x20]*(?:"(?:[^"]*)"|\'(?:[^\']*)\'|(?:[^\x09\x0A\x0B\x0C\x0D\x20\x22\x27\x3E][^\x09\x0A\x0B\x0C\x0D\x20\x3E]*)?))?)*)[\x09\x0A\x0B\x0C\x0D\x20]*');

/**
 * PCRE for XML attributes
 */
define('SIMPLEPIE_PCRE_XML_ATTRIBUTE', '((?:\s+(?:(?:[^\s:]+:)?[^\s:]+)\s*=\s*(?:"(?:[^"]*)"|\'(?:[^\']*)\'))*)\s*');

/**
 * XML Namespace
 */
define('SIMPLEPIE_NAMESPACE_XML', 'http://www.w3.org/XML/1998/namespace');

/**
 * Atom 1.0 Namespace
 */
define('SIMPLEPIE_NAMESPACE_ATOM_10', 'http://www.w3.org/2005/Atom');

/**
 * Atom 0.3 Namespace
 */
define('SIMPLEPIE_NAMESPACE_ATOM_03', 'http://purl.org/atom/ns#');

/**
 * RDF Namespace
 */
define('SIMPLEPIE_NAMESPACE_RDF', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');

/**
 * RSS 0.90 Namespace
 */
define('SIMPLEPIE_NAMESPACE_RSS_090', 'http://my.netscape.com/rdf/simple/0.9/');

/**
 * RSS 1.0 Namespace
 */
define('SIMPLEPIE_NAMESPACE_RSS_10', 'http://purl.org/rss/1.0/');

/**
 * RSS 1.0 Content Module Namespace
 */
define('SIMPLEPIE_NAMESPACE_RSS_10_MODULES_CONTENT', 'http://purl.org/rss/1.0/modules/content/');

/**
 * RSS 2.0 Namespace
 * (Stupid, I know, but I'm certain it will confuse people less with support.)
 */
define('SIMPLEPIE_NAMESPACE_RSS_20', '');

/**
 * DC 1.0 Namespace
 */
define('SIMPLEPIE_NAMESPACE_DC_10', 'http://purl.org/dc/elements/1.0/');

/**
 * DC 1.1 Namespace
 */
define('SIMPLEPIE_NAMESPACE_DC_11', 'http://purl.org/dc/elements/1.1/');

/**
 * W3C Basic Geo (WGS84 lat/long) Vocabulary Namespace
 */
define('SIMPLEPIE_NAMESPACE_W3C_BASIC_GEO', 'http://www.w3.org/2003/01/geo/wgs84_pos#');

/**
 * GeoRSS Namespace
 */
define('SIMPLEPIE_NAMESPACE_GEORSS', 'http://www.georss.org/georss');

/**
 * Media RSS Namespace
 */
define('SIMPLEPIE_NAMESPACE_MEDIARSS', 'http://search.yahoo.com/mrss/');

/**
 * Wrong Media RSS Namespace. Caused by a long-standing typo in the spec.
 */
define('SIMPLEPIE_NAMESPACE_MEDIARSS_WRONG', 'http://search.yahoo.com/mrss');

/**
 * Wrong Media RSS Namespace #2. New namespace introduced in Media RSS 1.5.
 */
define('SIMPLEPIE_NAMESPACE_MEDIARSS_WRONG2', 'http://video.search.yahoo.com/mrss');

/**
 * Wrong Media RSS Namespace #3. A possible typo of the Media RSS 1.5 namespace.
 */
define('SIMPLEPIE_NAMESPACE_MEDIARSS_WRONG3', 'http://video.search.yahoo.com/mrss/');

/**
 * Wrong Media RSS Namespace #4. New spec location after the RSS Advisory Board takes it over, but not a valid namespace.
 */
define('SIMPLEPIE_NAMESPACE_MEDIARSS_WRONG4', 'http://www.rssboard.org/media-rss');

/**
 * Wrong Media RSS Namespace #5. A possible typo of the RSS Advisory Board URL.
 */
define('SIMPLEPIE_NAMESPACE_MEDIARSS_WRONG5', 'http://www.rssboard.org/media-rss/');

/**
 * iTunes RSS Namespace
 */
define('SIMPLEPIE_NAMESPACE_ITUNES', 'http://www.itunes.com/dtds/podcast-1.0.dtd');

/**
 * XHTML Namespace
 */
define('SIMPLEPIE_NAMESPACE_XHTML', 'http://www.w3.org/1999/xhtml');

/**
 * IANA Link Relations Registry
 */
define('SIMPLEPIE_IANA_LINK_RELATIONS_REGISTRY', 'http://www.iana.org/assignments/relation/');

/**
 * Whether we're running on PHP5
 */
define('SIMPLEPIE_PHP5', version_compare(PHP_VERSION, '5.0.0', '>='));

/**
 * No file source
 */
define('SIMPLEPIE_FILE_SOURCE_NONE', 0);

/**
 * Remote file source
 */
define('SIMPLEPIE_FILE_SOURCE_REMOTE', 1);

/**
 * Local file source
 */
define('SIMPLEPIE_FILE_SOURCE_LOCAL', 2);

/**
 * fsockopen() file source
 */
define('SIMPLEPIE_FILE_SOURCE_FSOCKOPEN', 4);

/**
 * cURL file source
 */
define('SIMPLEPIE_FILE_SOURCE_CURL', 8);

/**
 * file_get_contents() file source
 */
define('SIMPLEPIE_FILE_SOURCE_FILE_GET_CONTENTS', 16);



class SimplePie_Autoloader
{
    public function __construct()
    {
        $this->path = dirname(__FILE__);
    }
    public function autoload($class)
    {
        // see if this request should be handled by this autoloader
        if (strpos($class, 'SimplePie') !== 0) {
            return;
        }

        $filename = $this->path . DIRECTORY_SEPARATOR . str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';
        include $filename;
    }
}