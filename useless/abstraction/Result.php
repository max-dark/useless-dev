<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license   MIT; see LICENSE.txt
 */

namespace useless\abstraction;

/**
 * Interface Result
 *
 * @package useless\abstraction
 */
interface Result
{
    /**
     * @return Model|false single Model from result
     */
    public function getOne();

    /**
     * @return Model[]|false all matched models from result
     */
    public function getAll();

    /**
     * @return array Array of fields
     */
    public function asArray();
}
