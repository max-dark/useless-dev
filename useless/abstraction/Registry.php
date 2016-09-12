<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license   MIT; see LICENSE.txt
 */

namespace useless\abstraction;

interface Registry
{
    /**
     * Check that name found in repository
     *
     * @param string $name
     *
     * @return bool
     */
    public function has(string $name):bool;

    /**
     * Return value of key with $name
     *
     * @param string $name
     *
     * @return mixed
     */
    public function get(string $name);

    /**
     * Set key $name to $value
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return Registry self
     */
    public function set(string $name, $value):Registry;
}