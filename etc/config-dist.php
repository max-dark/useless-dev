<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license   MIT; see LICENSE.txt
 */

return function () {
    $etc_dir  = __DIR__ . DIRECTORY_SEPARATOR;
    $root_dir = dirname($etc_dir) . DIRECTORY_SEPARATOR;

    return [
        'path'    => [
            'etc'  => $etc_dir,
            'root' => $root_dir,
        ],
        'storage' => function () {
            return require __DIR__ . DIRECTORY_SEPARATOR . 'storage.php';
        },
        'route'   => function () {
            return require __DIR__ . DIRECTORY_SEPARATOR . 'route.php';
        },
        'site' => [
            'title' => 'useless.dev',
            'email' => 'root@localhost'
        ],
    ];
};
