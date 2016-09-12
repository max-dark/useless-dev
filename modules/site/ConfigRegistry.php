<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license MIT; see LICENSE.txt
 */

namespace useless\modules\site;

use useless\abstraction\Registry;
use useless\abstraction\Storage;
use useless\core\ArrayRegistry;
use useless\modules\site\models\ConfigModel;

class ConfigRegistry implements Registry
{
    private $changed = [];
    /**
     * @var Storage
     */
    private $storage;
    /**
     * @var ArrayRegistry
     */
    private $cache = null;

    public function __construct(Storage $storage)
    {
        $this->cache   = new ArrayRegistry();
        $this->storage = $storage->forModel(ConfigModel::class);
    }

    /**
     * Check that name found in repository
     *
     * @param string $name
     *
     * @return bool
     */
    public function has(string $name):bool
    {
        $found = $this->cache->has($name);

        if (!$found) {
            /** @var ConfigModel $model */
            $model = $this->loadOne($name);

            $found = false !== $model;
            if ($found) {
                $this->cache->set($name, $model);
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
        return $this->has($name) ? $this->cache->get($name) : null;
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
        $model = $this->get($name);
        if (is_null($model)) {
            $model        = new ConfigModel();
            $model->name  = $name;
            $model->value = $value;
            $this->cache->set($name, $model);
            $this->changed[$name] = true;
        } elseif ($model->value != $value) {
            $model->value         = $value;
            $this->changed[$name] = true;
        }

        return $this;
    }

    /**
     * @param string $name
     *
     * @return ConfigModel|false
     */
    protected function loadOne(string $name)
    {
        return $this->storage->findOne(['name' => $name])->getOne();
    }

    public function __destruct()
    {
        foreach ($this->changed as $name => $value) {
            $this->storage->save($this->cache->get($name));
        }
    }
}