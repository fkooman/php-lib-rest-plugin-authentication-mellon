<?php

/**
 * Copyright 2015 François Kooman <fkooman@tuxed.net>.
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
namespace fkooman\Rest\Plugin\Authentication\Mellon;

use fkooman\Http\Request;
use fkooman\Rest\Service;
use fkooman\Rest\Plugin\Authentication\AuthenticationPluginInterface;
use fkooman\Http\Exception\InternalServerErrorException;

class MellonAuthentication implements AuthenticationPluginInterface
{
    /** @var string */
    private $userIdAttribute;

    public function __construct($userIdAttribute = 'MELLON_NAME_ID')
    {
        $this->userIdAttribute = $userIdAttribute;
    }

    public function init(Service $service)
    {
        // NOP
    }

    public function isAuthenticated(Request $request)
    {
        $mellonUserId = $request->getHeader($this->userIdAttribute);
        if (null === $mellonUserId) {
            return false;
        }

        return new MellonUserInfo($mellonUserId);
    }

    public function requestAuthentication(Request $request)
    {
        // if we reach here, authentication failed and can't be fixed, no
        // matter what, we have a server configuration issue
        throw new InternalServerErrorException(
            sprintf('the required header "%s" was not set', $this->userIdAttribute)
        );
    }
}
