<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license   MIT; see LICENSE.txt
 */

use useless\{
    core\CoreRepository, web\Application, web\Request
};

(function /* main */
(
    array $server,
    array $request
) {
    $classLoader = require_once 'vendor/autoload.php';

    $app = new Application(new Request($server, $request), new CoreRepository());

    $app->container()
        ->set('config', require_once 'etc/config.php')
        ->set('service', require_once 'etc/service.php')
        ->set('service.autoload', $classLoader);

    print($app->run()->getBody());
})($_SERVER, $_REQUEST);
