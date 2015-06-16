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
require_once dirname(__DIR__).'/vendor/autoload.php';

use fkooman\Rest\Service;
use fkooman\Rest\PluginRegistry;
use fkooman\Rest\Plugin\Mellon\MellonAuthentication;
use fkooman\Rest\Plugin\Mellon\MellonUserInfo;

$service = new Service();
$pluginRegistry = new PluginRegistry();
$pluginRegistry->registerDefaultPlugin(
    new MellonAuthentication('MELLON_NAME_ID')
);
$service->setPluginRegistry($pluginRegistry);
$service->get(
    '/getMyUserId',
    function (MellonUserInfo $u) {
        return sprintf('Hello %s', $u->getUserId());
    }
);

$service->run()->send();
