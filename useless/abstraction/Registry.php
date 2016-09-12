<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license   MIT; see LICENSE.txt
 */

namespace useless\abstraction;

interface Registry
{
    /**
     * Checks that the name is contained in the repository
     *
     * @param string $name
     *
     * @return bool
     */
    public function has(string $name):bool;

    /**
     * Returns key value with $name
     *
     * @param string $name
     *
     * @return mixed
     */
    public function get(string $name);

    /**
     * Sets key $name to $value
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return Registry self
     */
    public function set(string $name, $value):Registry;
}