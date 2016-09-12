<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license MIT; see LICENSE.txt
 */
namespace useless\core;

use useless\abstraction\{
    Request, Response
};

/**
 * interface Dispatcher
 *
 * @package useless\core
 */
interface Dispatcher
{
    /**
     * Dispatches request to action
     *
     * @param Request $request
     *
     * @return Response
     */
    public function dispatch(Request $request) : Response;
}