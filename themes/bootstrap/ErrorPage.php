<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license MIT; see LICENSE.txt
 */

namespace useless\themes\bootstrap;

class ErrorPage extends IndexPage
{
    public function __construct()
    {
        parent::__construct();
        $this->overrideBlock('content', 'content_error');
    }
}
