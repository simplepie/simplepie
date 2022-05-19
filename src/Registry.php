<?php
/**
 * SimplePie
 *
 * A PHP-Based RSS and Atom Feed Framework.
 * Takes the hard work out of managing a complete RSS/Atom solution.
 *
 * Copyright (c) 2004-2022, Ryan Parman, Sam Sneddon, Ryan McCue, and contributors
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
 * @link http://simplepie.org/ SimplePie
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 */

namespace SimplePie;

/**
 * Handles creating objects and calling methods
 *
 * Access this via {@see \SimplePie\SimplePie::get_registry()}
 *
 * @package SimplePie
 */
class Registry
{
    /**
     * Mapping of names that could be used to refer to a class instance
     * when talking to Registry instead of full class-string.
     * @var array<class-string, string>
     */
    private $legacyClassNames = [
        Cache::class => 'Cache',
        Locator::class => 'Locator',
        Parser::class => 'Parser',
        File::class => 'File',
        Sanitize::class => 'Sanitize',
        Item::class => 'Item',
        Author::class => 'Author',
        Category::class => 'Category',
        Enclosure::class => 'Enclosure',
        Caption::class => 'Caption',
        Copyright::class => 'Copyright',
        Credit::class => 'Credit',
        Rating::class => 'Rating',
        Restriction::class => 'Restriction',
        Content\Type\Sniffer::class => 'Content_Type_Sniffer',
        Source::class => 'Source',
        Misc::class => 'Misc',
        XML\Declaration\Parser::class => 'XML_Declaration_Parser',
        Parse\Date::class => 'Parse_Date',
    ];

    /**
     * Legacy mapping of names that can be used to refer to classes.
     *
     * (Inverted $this->legacyClassNames)
     *
     *
     * @var array<string, class-string>
     */
    protected $default = [];

    /**
     * Class mapping
     *
     * @see register()
     * @var array
     */
    protected $classes = [];

    /**
     * Legacy classes
     *
     * @see register()
     * @var array
     */
    protected $legacy = [];

    /**
     * Constructor
     *
     * No-op
     */
    public function __construct()
    {
        $this->default = array_flip($this->legacyClassNames);
    }

    /**
     * Register a class
     *
     * @param string $type See {@see $legacyClassNames} for names
     * @param string $class Class name, must subclass the corresponding default
     * @param bool $legacy Whether to enable legacy support for this class
     * @return bool Successfulness
     */
    public function register($type, $class, $legacy = false)
    {
        if (!class_exists($class)) {
            return false;
        }

        if (!((isset($this->legacyClassNames[$type]) && is_subclass_of($class, $type)) || (isset($this->default[$type]) && is_subclass_of($class, $this->default[$type])))) {
            return false;
        }

        $this->classes[$type] = $class;

        if ($legacy) {
            $this->legacy[] = $class;
        }

        return true;
    }

    /**
     * Get the class registered for a type
     *
     * Where possible, use {@see create()} or {@see call()} instead
     *
     * @template T
     * @param class-string<T> $type
     * @return class-string<T>|null
     */
    public function get_class($type)
    {
        if (!empty($this->classes[$type])) {
            return $this->classes[$type];
        }
        if (!empty($this->default[$type])) {
            return $this->default[$type];
        }

        if (!isset($this->legacyClassNames[$type])) {
            return null;
        }

        // Try again with the legacy type resolved.
        $type = $this->legacyClassNames[$type];
        if (!empty($this->classes[$type])) {
            return $this->classes[$type];
        }
        if (!empty($this->default[$type])) {
            return $this->default[$type];
        }

        return null;
    }

    /**
     * Create a new instance of a given type
     *
     * @template T class-string $type
     * @param class-string<T> $type
     * @param array $parameters Parameters to pass to the constructor
     * @return T Instance of class
     */
    public function &create($type, $parameters = [])
    {
        $class = $this->get_class($type);

        if (in_array($class, $this->legacy)) {
            switch ($type) {
                case 'locator':
                    // Legacy: file, timeout, useragent, file_class, max_checked_feeds, content_type_sniffer_class
                    // Specified: file, timeout, useragent, max_checked_feeds
                    $replacement = [$this->get_class('file'), $parameters[3], $this->get_class('content_type_sniffer')];
                    array_splice($parameters, 3, 1, $replacement);
                    break;
            }
        }

        if (!method_exists($class, '__construct')) {
            $instance = new $class();
        } else {
            $reflector = new \ReflectionClass($class);
            $instance = $reflector->newInstanceArgs($parameters);
        }

        if (method_exists($instance, 'set_registry')) {
            $instance->set_registry($this);
        }
        return $instance;
    }

    /**
     * Call a static method for a type
     *
     * @param class-string $type
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function &call($type, $method, $parameters = [])
    {
        $class = $this->get_class($type);

        if (in_array($class, $this->legacy)) {
            switch ($type) {
                case 'Cache':
                    // For backwards compatibility with old non-static
                    // Cache::create() methods in PHP < 8.0.
                    // No longer supported as of PHP 8.0.
                    if ($method === 'get_handler') {
                        $result = @call_user_func_array([$class, 'create'], $parameters);
                        return $result;
                    }
                    break;
            }
        }

        $result = call_user_func_array([$class, $method], $parameters);
        return $result;
    }
}

class_alias('SimplePie\Registry', 'SimplePie_Registry');
