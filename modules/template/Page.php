<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license   MIT; see LICENSE.txt
 */

namespace useless\modules\template;

class Page
{
    /**
     * Base directory with blocks
     */
    const BLOCKS_DIR = __DIR__;

    /**
     * extension of block file
     */
    const BLOCKS_EXT = '.inc';

    /**
     * @var array
     */
    private $blocks = [];

    /**
     * @var array
     */
    private $values = [];
    /**
     * @var PageBlock[]
     */
    private $block_cache = [];

    /**
     * @param array $values
     *
     * @return string
     */
    public final function render($values = null)
    {
        if (is_array($values)) {
            $this->values = $values;
        }

        return $this->renderBlock('layout', $this->values);
    }

    /**
     * @param string $name
     *
     * @return mixed|null
     */
    public function __get(string $name)
    {
        return $this->values[$name] ?? null;
    }
    /**
     * @param string $name
     * @param array  $values
     *
     * @return string
     */
    public final function renderBlock(string $name, array $values = []):string
    {
        $file_name = $this->getBlockFile($name);
        $block = $this->block_cache[$file_name] ?? null;

        if (is_null($block)) {
            $callback = IncludeTool::includeFile($file_name);
            $block = $this->block_cache[$file_name] = new PageBlock($this, $name, $callback);
        }

        return $block->render($values);
    }

    /**
     * @return string
     */
    protected final function getBlocksDirectory():string
    {
        return static::BLOCKS_DIR . DIRECTORY_SEPARATOR;
    }

    /**
     * @return string
     */
    protected final function getBlocksExt():string
    {
        return static::BLOCKS_EXT;
    }

    /**
     * @param string $name
     *
     * @return string
     */
    protected final function getBlockByName(string $name):string
    {
        $block = $this->blocks[$name] ?? [ 'file' => $name, 'parent' => null ];
        return $block['file'];
    }

    /**
     * Override block filename
     *
     * @param $block_name
     * @param $new_name
     */
    protected final function overrideBlock($block_name, $new_name)
    {
        $block = ($this->blocks[$block_name] ?? [ 'file' => $block_name, 'parent' => null ]);
        $this->blocks[$block_name] = [ 'file' => $new_name, 'parent' => $block ];
    }

    /**
     * @param string $name
     *
     * @return string
     */
    protected final function getBlockFile(string $name):string
    {
        return $this->getBlocksDirectory() . $this->getBlockByName($name) . $this->getBlocksExt();
    }
}
