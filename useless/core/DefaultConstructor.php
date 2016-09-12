<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license MIT; see LICENSE.txt
 */

namespace useless\core;

use useless\abstraction\Application;

/**
 * Class DefaultConstructor
 *
 * @package useless\core
 * @method application(Application $application)
 */
trait DefaultConstructor
{
    /**
     * Action constructor.
     *
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->application($application);
    }
}