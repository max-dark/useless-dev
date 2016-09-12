<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license   MIT; see LICENSE.txt
 */

namespace useless\abstraction;

interface Response
{
    public function setHeader(string $header, string $value):Response;

    public function setHeaders(array $headers):Response;

    public function getHeader(string $header):string;

    public function getHeaders():array;

    public function setBody(string $body):Response;

    public function getBody():string;

    public function redirect(string $path, int $delay = 0):Response;

    public function send():Response;

    public function setCode($code):Response;

    public function getCode();
}