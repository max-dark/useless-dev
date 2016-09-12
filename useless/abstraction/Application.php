<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license   MIT; see LICENSE.txt
 */

namespace useless\abstraction;

interface Application
{
    public function __construct(
        Request $request,
        Registry $repository
    );

    public function getRequest():Request;

    public function getResponse():Response;

    public function container():Registry;

    public function run():Response;
}