<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license   MIT; see LICENSE.txt
 */

return function () {
    return [
        'get:/' => [
            'class' => \useless\modules\site\Site::class,
            'action' => 'index',
            'params' => [],
        ],
        'get:/404/' => [
            'class' => \useless\modules\site\Site::class,
            'action' => 'error404',
            'params' => [],
        ],
    ];
};
