<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license   MIT; see LICENSE.txt
 */

namespace useless\database;

use useless\abstraction\{
    Model, Result, Storage
};

abstract class SqlStorage implements Storage
{
    /**
     * @var \useless\abstraction\Storage[]
     */
    private static $instances = [];
    /**
     * @var QueryBuilder[]
     */
    private static $build = [];
    /**
     * @var string
     */
    private $modelClass;
    /**
     * @var \PDO
     */
    private $pdo;
    /**
     * @var string
     */
    private $tablePrefix = '';
    /**
     * @var string
     */
    private $tableName = '';

    /**
     * MySqlStorage constructor.
     *
     * @param string $tablePrefix
     * @param \PDO   $pdo
     */
    public function __construct(string $tablePrefix, \PDO $pdo)
    {
        $this->pdo         = $pdo;
        $this->tablePrefix = $tablePrefix;
    }

    /**
     * Clone this storage and set model class name
     *
     * @param string $modelClass
     *
     * @return Storage
     */
    public function forModel(string $modelClass):Storage
    {
        if (!array_key_exists($modelClass, self::$instances)) {
            $instance                     = new static($this->tablePrefix, $this->pdo);
            $instance->modelClass         = $modelClass;
            /** @var Model $modelClass */
            $instance->tableName          = $this->tablePrefix . $modelClass::name();
            self::$instances[$modelClass] = $instance;
        }

        return self::$instances[$modelClass];
    }

    /**
     * Returns search result
     *
     * @param array $rule
     *
     * @return \useless\abstraction\Result|false
     */
    public function findOne(array $rule)
    {
        $rule['limit'] = 1;

        return $this->findMany($rule);
    }

    /**
     * Returns search result
     *
     * @param array $rule
     *
     * @return \useless\abstraction\Result
     */
    public function findMany(array $rule):Result
    {
        list($sql, $params) = $this->queryBuilder()->selectSQL($rule);

        return $this->execute($sql, $params);
    }

    /**
     * @return QueryBuilder
     */
    public function queryBuilder()
    {
        return $this->getBuilder();
    }

    /**
     * @return QueryBuilder
     */
    protected function getBuilder():QueryBuilder
    {
        if (!isset(self::$build[$this->getModelClass()])) {
            self::$build[static::class] = $this->createQueryBuilder();
        }

        return self::$build[$this->getModelClass()];
    }

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return $this->modelClass;
    }

    /**
     * @return QueryBuilder
     */
    abstract protected function createQueryBuilder();

    /**
     * @param string $sql
     * @param array  $params
     * @param bool   $needResult
     *
     * @return bool|\useless\abstraction\Result
     */
    public function execute($sql, $params = [], $needResult = true)
    {
        $query   = $this->pdo->prepare($sql);
        $success = $query->execute($params);

        return ($success && $needResult) ? new DbResult($query, $this->modelClass) : $success;
    }

    /**
     * "Save"(add new or update) model to storage
     *
     * @param Model  $model
     * @param string $indexKey "index" key
     *
     * @return bool
     */
    public function save(Model $model, string $indexKey = 'uid'):bool
    {
        $fields     = $model->getFields();
        $indexValue = $fields[$indexKey];
        unset($fields[$indexKey]);
        $names  = array_keys($fields);
        $params = [];
        foreach ($fields as $name => $value) {
            $params[":{$name}"] = $value;
        }
        if (empty($indexValue)) {
            $sql     = $this->queryBuilder()->insertSQL($names, $params);
            $success = $this->execute($sql, $params, false);
            if ($success) {
                $model->setUID($this->lastInsertId());
            }
        } else {
            $params[":{$indexKey}"] = $indexValue;

            $sql     = $this->queryBuilder()->updateSQL($names, $indexKey);
            $success = $this->execute($sql, $params, false);
        }

        return $success;
    }

    /**
     * @return string
     */
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    /**
     * @param \useless\abstraction\Model $model
     * @param string                     $indexKey
     *
     * @return bool
     */
    public function remove(Model $model, string $indexKey = 'uid'):bool
    {
        $sql = $this->queryBuilder()->deleteSQL($indexKey);

        return $this->execute($sql, [':index_key' => $model->getUID()], false);
    }

    /**
     * @return string
     */
    protected function getTableName():string
    {
        return $this->tableName;
    }
}
