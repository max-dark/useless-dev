<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license MIT; see LICENSE.txt
 */

namespace useless\themes\bootstrap;

class IndexPage extends BootstrapTheme
{
    public function __construct()
    {
        parent::__construct();
        $this->overrideBlock('content', 'content_index');
    }
}
