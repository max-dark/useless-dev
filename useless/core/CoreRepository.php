<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license   MIT; see LICENSE.txt
 */

namespace useless\core;

use useless\abstraction\Registry;

class CoreRepository implements Registry
{
    const DELIMITER = '.';
    private $values = [];
    private $cache = [];

    /**
     * Check that name found in repository
     *
     * @param string $name
     *
     * @return bool
     */
    public function has(string $name):bool
    {
        $keys  = explode(static::DELIMITER, $name);
        $ptr   = &$this->values;
        $found = array_key_exists($name, $this->cache);
        if (!$found) {
            foreach ($keys as $key) {
                $found = is_array($ptr) && array_key_exists($key, $ptr);
                if (!$found) {
                    break;
                }
                $ptr = &$ptr[$key];
            }
        }

        return $found;
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
        $keys  = explode(static::DELIMITER, $name);
        $tmp   = &$this->values;
        $is_ok = false;
        foreach ($keys as $key) {
            $is_ok = is_array($tmp) && array_key_exists($key, $tmp);
            if (!$is_ok) {
                break;
            }
            $tmp = &$tmp[$key];
            while (is_callable($tmp)) {
                $tmp = $tmp($this);
            }
        }

        $result = null;
        if ($is_ok) {
            $result = $this->cache[$name] = &$tmp;
        }

        return $result;
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
        $keys = explode(static::DELIMITER, $name);
        $ptr  = &$this->values;
        foreach ($keys as $key) {
            if (!isset($ptr[$key])) {
                $ptr[$key] = [];
            }
            $ptr = &$ptr[$key];
        }
        $ptr = $value;

        return $this;
    }
}