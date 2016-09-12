<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license   MIT; see LICENSE.txt
 */

namespace useless\abstraction;

interface Request
{
    public function method():string;

    public function path():string;

    public function has(string $name):bool;

    public function get(string $name);
}