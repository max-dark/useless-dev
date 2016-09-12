<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license   MIT; see LICENSE.txt
 */

namespace useless\abstraction;

/**
 * Interface Model
 *
 * @package useless\abstraction
 */
interface Model
{
    /**
     * @return string name of storage for this model
     */
    public static function name():string;

    /**
     * @param mixed $value
     *
     * @return void
     */
    public function setUID($value);

    /**
     * @return mixed UID for this model
     */
    public function getUID();

    /**
     * @return array field values
     */
    public function getFields():array;
}
