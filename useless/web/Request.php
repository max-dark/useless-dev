<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license   MIT; see LICENSE.txt
 */

namespace useless\web;

class Request implements \useless\abstraction\Request
{
    private $method = '';
    private $uri = '';
    /**
     * @var array
     */
    private $server;
    /**
     * @var array
     */
    private $request;

    public function __construct(array $server, array $request)
    {
        $this->uri     = $server['REQUEST_URI'] ?? '/';
        $this->method  = $server['HTTP_METHOD'] ?? 'GET';
        $this->server  = $server;
        $this->request = $request;
    }

    public function method():string
    {
        return $this->method;
    }

    public function path():string
    {
        return parse_url($this->uri, PHP_URL_PATH);
    }

    public function has(string $name):bool
    {
        return array_key_exists($name, $this->request);
    }

    public function get(string $name)
    {
        return $this->request[$name];
    }
}