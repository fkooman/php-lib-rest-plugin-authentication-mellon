<?php

/**
* Copyright 2014 François Kooman <fkooman@tuxed.net>
*
* Licensed under the Apache License, Version 2.0 (the "License");
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
*
* http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*/

namespace fkooman\Rest;

use fkooman\Http\Request;
use fkooman\Rest\Plugin\Mellon\MellonAuthentication;
use PHPUnit_Framework_TestCase;

class MellonAuthenticationTest extends PHPUnit_Framework_TestCase
{
    public function testMellonAuthCorrect()
    {
        $request = new Request('http://www.example.org/foo', "GET");
        $request->setHeaders(array('MELLON_NAME_ID' => 'foo'));

        $basicAuth = new MellonAuthentication('MELLON_NAME_ID');
        $userInfo = $basicAuth->execute($request);
        $this->assertEquals('foo', $userInfo->getUserId());
    }

    /**
     * @expectedException fkooman\Http\Exception\InternalServerErrorException
     * @expectedExceptionMessage mellon configuration error, expected attribute not available
     */
    public function testMissingNameId()
    {
        $request = new Request('http://www.example.org/foo', "GET");

        $basicAuth = new MellonAuthentication('MELLON_NAME_ID');
        $basicAuth->execute($request);
    }
}
