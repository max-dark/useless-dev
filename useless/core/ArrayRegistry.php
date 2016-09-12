<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license MIT; see LICENSE.txt
 */

namespace useless\core;

use useless\abstraction\Registry;

class ArrayRegistry implements Registry
{
    private $storage = [];
    /**
     * Check that name found in repository
     *
     * @param string $name
     *
     * @return bool
     */
    public function has(string $name):bool
    {
        return array_key_exists($name, $this->storage);
    }

    /**
     * Return value of key with $name
     *
     * @param string $name
     *
     * @return mixed
     */
    public function get(string $name)
    {
        return $this->storage[$name] ?? null;
    }

    /**
     * Set key $name to $value
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return Registry self
     */
    public function set(string $name, $value):Registry
    {
        $this->storage[$name] = $value;
        return $this;
    }
}