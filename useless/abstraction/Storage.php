<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license   MIT; see LICENSE.txt
 */

namespace useless\abstraction;

/**
 * Interface Storage
 *
 * @package useless\abstraction
 */
interface Storage
{
    /**
     * Clone this storage and set model class name
     *
     * @param string $modelClass
     *
     * @return Storage
     */
    public function forModel(string $modelClass):Storage;

    /**
     * Returns search result
     *
     * @param array $rule
     *
     * @return Result|false
     */
    public function findOne(array $rule);

    /**
     * Returns search result
     *
     * @param array $rule
     *
     * @return Result
     */
    public function findMany(array $rule):Result;

    /**
     * "Save"(add new or update) model to storage
     *
     * @param Model  $model
     * @param string $indexKey "index" key
     *
     * @return bool
     */
    public function save(Model $model, string $indexKey = 'uid'):bool;

    /**
     * Removes model from storage
     *
     * @param Model  $model
     * @param string $indexKey "index" key
     *
     * @return bool
     */
    public function remove(Model $model, string $indexKey = 'uid'):bool;
}
