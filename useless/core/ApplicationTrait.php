<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license   MIT; see LICENSE.txt
 */

namespace useless\core;

use useless\abstraction\{
    Registry, Request, Response
};

trait ApplicationTrait
{
    private $request;
    private $repository;
    private $response;

    /**
     * Application constructor.
     *
     * @param Request  $request
     * @param Registry $repository
     */
    public function __construct(Request $request, Registry $repository)
    {
        $this->request    = $request;
        $this->repository = $repository;
        $this->response   = $this->createResponse();
        $this->container()->set('app', $this);
    }

    /**
     * @return Request
     */
    public function getRequest():Request
    {
        return $this->request;
    }

    /**
     * @return Registry
     */
    public function container():Registry
    {
        return $this->repository;
    }

    /**
     * @return Response
     */
    public function getResponse():Response
    {
        return $this->response;
    }
}