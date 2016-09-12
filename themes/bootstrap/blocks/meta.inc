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
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php if ($page->keywords) : ?>
    <meta name="keywords" content="<?= $page->keywords ?>"/>
<?php endif; ?>
<?php if ($page->description) : ?>
    <meta name="description" content="<?= $page->description ?>"/>
<?php endif; ?>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
<link rel="stylesheet" href="/themes/bootstrap/css/main.css"/>
