<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license MIT; see LICENSE.txt
 */

namespace useless\modules\template;

class PageBlock
{
    /**
     * @var array
     */
    private $values = [];
    /**
     * @var string
     */
    private $name;
    /**
     * @var Page
     */
    private $view;
    /**
     * @var callable
     */
    private $callback;

    public function __construct(Page $view, string $name, callable $callback)
    {
        $this->name = $name;
        $this->view = $view;
        $this->callback = $callback;
    }

    /**
     * @param string|int $name
     *
     * @return mixed|null
     */
    public function __get($name)
    {
        return $this->values[$name] ?? null;
    }

    /**
     * @return string
     */
    public function blockName():string
    {
        return $this->name;
    }

    public function render(array $values):string
    {
        $this->values = $values;
        ob_start();
        ($this->callback)($this, $this->view);
        return ob_get_clean();
    }

}