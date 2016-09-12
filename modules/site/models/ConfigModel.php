<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license MIT; see LICENSE.txt
 */

namespace useless\modules\site\models;

use useless\abstraction\Model;

class ConfigModel implements Model
{
    public $uid;
    public $name;
    public $value;

    /**
     * @return string name of storage for this model
     */
    public static function name():string
    {
        return 'config';
    }

    /**
     * @param mixed $value
     *
     * @return void
     */
    public function setUID($value)
    {
        $this->uid = $value;
    }

    /**
     * @return mixed UID for this model
     */
    public function getUID()
    {
        return $this->uid;
    }

    /**
     * @return array field values
     */
    public function getFields():array
    {
        return [
            'uid'   => $this->uid,
            'name'  => $this->name,
            'value' => $this->value,
        ];
    }
}