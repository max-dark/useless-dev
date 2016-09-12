<?php
/**
 * @copyright Copyright (C) 2016. Max Dark maxim.dark@gmail.com
 * @license   MIT; see LICENSE.txt
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
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>-=:: <?= $page->title ?> ::=-</title>
    <?= $page->renderBlock('meta'); ?>
</head>
<body>
<?= $page->renderBlock('menu'); ?>
<div class="container text-center">
    <?= $page->renderBlock('content'); ?>
</div>
<footer class="container-fluid text-center">
    <?= $page->renderBlock('footer'); ?>
</footer>
<?= $page->renderBlock('scripts'); ?>
</body>
</html>
