<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license   MIT; see LICENSE.txt
 */

namespace useless\modules\template;

final class IncludeTool
{
    /**
     * Wrap included file with closure
     *
     * @param string $file_name
     *
     * @return \Closure
     * @throws \Exception
     */
    public static final function includeFile(string $file_name):\Closure
    {
        if (!file_exists($file_name)) {
            throw new \Exception("File [$file_name] not exists");
        }

        /** @noinspection PhpUnusedParameterInspection,PhpDocSignatureInspection */
        return function (PageBlock $block, Page $page) use ($file_name) {
            /** @noinspection PhpIncludeInspection */
            include $file_name;
        };
    }
}