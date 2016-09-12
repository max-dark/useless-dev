<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license   MIT; see LICENSE.txt
 */

namespace useless\database;

/**
 * Class Config
 *
 * @package useless\database
 */
class Config
{
    /**
     * @var string DSN
     */
    private $dsn;

    /**
     * @var string Database User name
     */
    private $user;

    /**
     * @var string Password
     */
    private $password;

    /**
     * @var string Table Prefix
     */
    private $prefix;
    private $driver;

    /**
     * Config constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $dsn = "{$config['driver']}:{$config['database']}";
        $dsn .= ";host={$config['host']};charset={$config['charset']}";
        $this->dsn      = $dsn;
        $this->user     = $config['user'];
        $this->password = $config['password'];
        $this->prefix   = $config['prefix'] ?? '';
        $this->driver   = $config['driver'];
    }

    /**
     * @return string
     */
    public function getDSN()
    {
        return $this->dsn;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @return string
     */
    public function getDriver()
    {
        return $this->driver;
    }
}
