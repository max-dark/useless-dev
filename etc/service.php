<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license   MIT; see LICENSE.txt
 */

use useless\abstraction\Registry;
use useless\core\SimpleRouter;
use useless\database\{
    Config, Database, MySqlStorage
};

return [
    'storage' => [
        'config'  => function (Registry $container) {
            return new Config($container->get('config.storage.default'));
        },
        'pdo'     => function (Registry $container) {
            return Database::instance($container->get('service.storage.config'));
        },
        'default' => function (Registry $container) {
            /** @var Config $cfg */
            $cfg = $container->get('service.storage.config');

            return $container->get('service.storage.' . $cfg->getDriver());
        },
        'mysql'   => function (Registry $container) {
            /** @var Config $cfg */
            $cfg = $container->get('service.storage.config');
            $pdo = $container->get('service.storage.pdo');

            return new MySqlStorage($cfg->getPrefix(), $pdo);
        }
    ],
    'route'   => function (Registry $container) {
        $app    = $container->get('app');
        $routes = $container->get('config.route');

        return new SimpleRouter($app, $routes);
    }
];