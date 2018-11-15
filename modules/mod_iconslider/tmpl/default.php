<?php
/**
 * @package     Joomla.Site
 * @subpackage  Module Bid Tours List
 *
 * @copyright   Copyright (C) 2017 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

//var_dump($iconIds);

?>
<div class="mod_iconsliders">
    <div class="content"><?php echo $intro?></div>
    <div class="owl-carousel owl-theme">
        <?php
        $i=1;
        foreach ($iconIds as $item):
            $imageLink = $item->icon;
            $title = $item->title;
            ?>

                <div class="item">
                    <img src="<?php echo htmlspecialchars($imageLink); ?>" alt="<?php echo htmlspecialchars($title); ?>"/>
                    <p><?php echo htmlspecialchars($title); ?></p>
                </div>

       <?php
       $i++;
       endforeach;?>
    </div>
</div>

<script>
jQuery(document).ready(function($){
    $('.owl-carousel').owlCarousel({
        rtl:true,
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    })
});
</script>
