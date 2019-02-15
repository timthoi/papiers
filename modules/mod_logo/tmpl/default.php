<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_offerhotelforusers
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<div class="module-logo">
    <div class="row">
        <div class="logo col-md-6">
            <a href="<?php echo JURI::base() ?>"><img
                        src="images/Logo-papiersdefamilles.png" alt="Logo Papiersdefamilles"></a>
        </div>

        <div class="search col-md-6">
			<form action="<?php echo (JRoute::_("index.php")); ?>" method="post" name="adminFormTopSearch" id="adminFormTopSearch">
				<div class="input-prepend">
					<input id="module-logo-search" type="text" class="form-control" name="search_main_person" value="<?php echo $sessionSearch['main_person']?>" placeholder="<?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_MODULELOGO_PLACEHOLDER')?>"
						   autocomplete="off">
					<span class="add-on btn-module-logo-search">
						<span class="fa fa-search hasTooltip" title="" data-original-title="Search"></span>
					</span>
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
            <p class="note"><?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_MODULELOGO_HEADER')?></p>

        </div>
    </div>
</div>


<script type="text/javascript">
    jQuery(document).ready(function ($) {
        Joomla.submitformAdminFormTopSearch = function(task){
            if (task) {
                document.adminFormTopSearch.task.value = task;
            }
            else
                document.adminFormTopSearch.task.value = "";

            if (typeof document.adminFormTopSearch.onsubmit == "function") {
                document.adminFormTopSearch.onsubmit();
            }
            document.adminFormTopSearch.submit();
        }

        $('.btn-module-logo-search').on('click', function(e){
            Joomla.submitformAdminFormTopSearch('documents.setSessionSearch');

            e.preventDefault();
            return false;
        })

    })
</script>