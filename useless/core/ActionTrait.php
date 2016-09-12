<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license   MIT; see LICENSE.txt
 */

namespace useless\core;

use useless\abstraction\Application;
use useless\abstraction\Registry;
use useless\abstraction\Response;

/**
 * Trait ActionTrait
 *
 * @package useless\abstraction
 */
trait ActionTrait
{
    /**
     * @var Application $application
     */
    private $application;

    private function application(Application $application)
    {
        $this->application = $application;
    }
    protected function container():Registry
    {
        return $this->application->container();
    }

    protected function response():Response
    {
        return $this->application->getResponse();
    }

    protected function request()
    {
        return $this->application->getRequest();
    }
}
