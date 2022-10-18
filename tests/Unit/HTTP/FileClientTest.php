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

namespace SimplePie\Tests\Unit\HTTP;

use PHPUnit\Framework\TestCase;
use SimplePie\Exception\HttpException;
use SimplePie\File;
use SimplePie\HTTP\FileClient;
use SimplePie\HTTP\Response;
use SimplePie\Registry;

class FileClientTest extends TestCase
{
    public function testRequestReturnsResponse()
    {
        $registry = $this->createMock(Registry::class);
        $registry->method('create')->willReturn($this->createMock(File::class));
        $http_client = new FileClient($registry);

        $this->assertInstanceOf(Response::class, $http_client->request(FileClient::METHOD_GET, ''));
    }

    public function testRequestCallsRegistryWithValidDefaultArguments()
    {
        $registry = $this->createMock(Registry::class);
        $registry->expects($this->once())->method('call')->with(
            'Misc',
            'get_default_useragent'
        )->willReturn('SimplePie');
        $registry->expects($this->once())->method('create')->with(
            'File',
            [
                'https://example.com',
                10,
                5,
                [],
                'SimplePie',
                false,
                [],
            ]
        )->willReturn($this->createMock(File::class));

        $http_client = new FileClient($registry);
        $http_client->request(FileClient::METHOD_GET, 'https://example.com');
    }

    public function testRequestCallsRegistryWithCorrectArguments()
    {
        $registry = $this->createMock(Registry::class);
        $registry->expects($this->once())->method('create')->with(
            'File',
            [
                'https://example.com',
                20,
                1,
                ['header-name' => 'value'],
                'SimplePie user-agent',
                true,
                [45 => 1],
            ]
        )->willReturn($this->createMock(File::class));

        $http_client = new FileClient($registry);
        $http_client->request(
            FileClient::METHOD_GET,
            'https://example.com',
            ['header-name' => 'value'],
            [
                'timeout' => 20,
                'redirects' => 1,
                'useragent' => 'SimplePie user-agent',
                'force_fsockopen' => true,
                'curl_options' => [\CURLOPT_FAILONERROR => 1],
            ]
        );
    }

    public function testRequestWithoutSuccessThrowsHttpException()
    {
        $file = $this->createMock(File::class);
        $file->success = false;
        $file->error = 'Error message';

        $registry = $this->createMock(Registry::class);
        $registry->method('create')->willReturn($file);

        $http_client = new FileClient($registry);

        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('Error message');

        $http_client->request(
            FileClient::METHOD_GET,
            'https://example.com',
            [],
            ['useragent' => 'SimplePie',]
        );
    }
}
