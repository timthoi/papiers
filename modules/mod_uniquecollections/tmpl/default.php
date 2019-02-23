<?php
/**
 * @package     Joomla.Site
 * @subpackage  Module Company Bid Tours
 *
 * @copyright   Copyright (C) 2017 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<div class="module module-homepage-1">
	<h3><?php echo JText::_('PAPIERSDEFAMILLES_TEXT_MODULENIQUECOLLECTION_HEADER')?></h3>
	<p class="content"><?php echo JText::_('PAPIERSDEFAMILLES_TEXT_MODULENIQUECOLLECTION_CONTENT')?></p>
	<div class="block-content row">
		<div class="col-md-5">
			<div class="bulle_1_home"><?php echo JText::_('PAPIERSDEFAMILLES_TEXT_MODULENIQUECOLLECTION_BULLE_1_HOME')?>
				<img src="<?php echo JUri::root() . '/images/trec1.png' ?>" class="trec_b1">
			</div>
		</div>
		<div class="col-md-7">
			<div class="bulle_2_home"><?php echo JText::_('PAPIERSDEFAMILLES_TEXT_MODULENIQUECOLLECTION_BULLE_2_HOME')?>
				<img src="<?php echo JUri::root() . '/images/trec2.png' ?>" class="trec_b2">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
            <div class="zone_champs_home">
				<p class="title"><?php echo JText::_('PAPIERSDEFAMILLES_TEXT_MODULENIQUECOLLECTION_HEADER2')?></p>

				<form action="<?php echo (JRoute::_("index.php")); ?>" method="post" name="adminForm3" id="adminForm3">

					<div class="custom mod_booking_search">
						<div class="row">
							<div class="col-md-5">
								<input type="text" class="form-control champ_home" placeholder="<?php echo JText::_('PAPIERSDEFAMILLES_FIELD_PLACEHOLDER_MAIN_PERSON')?>" name="search_main_person" value="<?php echo $sessionSearch['main_person']?>">
								<input type="text" class="form-control champ_home" placeholder="<?php echo JText::_('PAPIERSDEFAMILLES_FIELD_SORTABLE_SECOND_NAME')?>" name="search_join" value="<?php echo $sessionSearch['join']?>">
							</div>
							<div class="col-md-5">
								<input type="text" class="form-control champ_home" placeholder="<?php echo JText::_('PAPIERSDEFAMILLES_FIELD_COUNTRY')?>" name="search_country" value="<?php echo $sessionSearch['country']?>">
								<input type="text" class="form-control champ_home" placeholder="<?php echo JText::_('PAPIERSDEFAMILLES_FIELD_REGION')?>" name="search_region value="<?php echo $sessionSearch['region']?>">
							</div>
							<div class="col-md-2">
								<a href="#" class="btn_champ_home"><i class="fa fa-search" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>
                    <?php
                    $jinput = JFactory::getApplication()->input;
                    echo JDom::_('html.form.footer', array(
                            'values' => array(
                                'option' => 'com_papiersdefamilles',
                                'view' => 'documents',
                                'layout' => 'default',
                                'boxchecked' => '0',
                                'task' => 'setSessionSearch'
                            ))
                    );
                    ?>
				</form>
            </div>
		</div>
		<div class="col-md-4">
			<img src="<?php echo JUri::root() . '/images/docs_home2.png' ?>" class="img_docs_home">
		</div>
	</div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        Joomla.submitform3 = function(task){
            if (task) {
                document.adminForm3.task.value = task;
            }
            else
                document.adminForm3.task.value = "";

            if (typeof document.adminForm3.onsubmit == "function") {
                document.adminForm3.onsubmit();
            }
            document.adminForm3.submit();
        }

        $('.btn_champ_home').on('click', function(e){
            Joomla.submitform3('documents.setSessionSearch');

            e.preventDefault();
            return false;
        })

    })
</script>