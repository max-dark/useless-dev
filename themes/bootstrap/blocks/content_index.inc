<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license MIT; see LICENSE.txt
 */

namespace useless\themes\bootstrap\blocks;

use useless\modules\template\{
    Page, PageBlock
};

/**
 * @var Page      $page
 * @var PageBlock $block
 */
?>
<?= $page->renderBlock('slider', ['slider' => $page->slider]); ?>
<pre><?= $page->message ?></pre>
