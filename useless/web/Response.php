<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license   MIT; see LICENSE.txt
 */

namespace useless\web;

use useless\abstraction\Response as ResponseInterface;

class Response implements ResponseInterface
{
    private $headers = [];
    private $body = '';
    private $code = 200;

    public function getHeader(string $header):string
    {
        return $this->headers[$header];
    }

    public function getHeaders():array
    {
        return $this->headers;
    }

    public function setHeaders(array $headers):ResponseInterface
    {
        $this->headers = $headers;

        return $this;
    }

    public function getBody():string
    {
        return $this->body;
    }

    public function setBody(string $body):ResponseInterface
    {
        $this->body = $body;

        return $this;
    }

    public function redirect(string $path, int $delay = 0):ResponseInterface
    {
        $delay = $delay > 0 ? ';' : '';
        return $this->setHeader('Location', $path . $delay);
    }

    public function setHeader(string $header, string $value):ResponseInterface
    {
        $this->headers[$header] = $value;

        return $this;
    }

    public function send():ResponseInterface
    {
        $headers = $this->getHeaders();
        foreach ($headers as $header => $value) {
            header("$header: $value");
        }
        if ($this->code != 200) {
            http_response_code($this->code);
        }
        return $this;
    }

    public function setCode($code):ResponseInterface
    {
        $this->code = $code;
        return $this;
    }

    public function getCode()
    {
        return $this->code;
    }
}