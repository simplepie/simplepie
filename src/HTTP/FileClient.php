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
 * @copyright 2004-2022 Ryan Parman, Sam Sneddon, Ryan McCue
 * @author Ryan Parman
 * @author Sam Sneddon
 * @author Ryan McCue
 * @link http://simplepie.org/ SimplePie
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 */

namespace SimplePie\HTTP;

use InvalidArgumentException;
use SimplePie\Exception\HttpException;
use SimplePie\Registry;

/**
 * HTTP Client based on \SimplePie\File
 *
 * @package SimplePie
 * @subpackage HTTP
 */
final class FileClient implements Client
{
    private $registry;

    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * send a request and return the response
     *
     * @param string $method
     * @param string $url
     * @param array $headers
     * @param array $options
     *
     * @return Response
     *
     * @throws HttpException if anything goes wrong requesting the data
     */
    public function request(string $method, string $url, array $headers = [], array $options = []): Response
    {
        if ($method !== self::METHOD_GET) {
            throw new InvalidArgumentException(sprintf(
                '%s(): Argument #1 ($method) only supports "%s".',
                __METHOD__,
                self::METHOD_GET
            ), 1);
        }

        $file = $this->registry->create('File', [
            $url,
            $options['timeout'] ?? 10,
            $options['redirects'] ?? 5,
            $headers,
            $options['useragent'] ?? $this->registry->call('Misc', 'get_default_useragent'),
            $options['force_fsockopen'] ?? false,
            $options['curl_options'] ?? []
        ]);

        if (! $file->success) {
            throw new HttpException($file->error);
        }

        return new FileResponse($file);
    }
}
