<?php
/**
* @version		
* @package		Papiersdefamilles
* @subpackage	Ticket Types
* @copyright	
* @author		 Harvey - timthoi
* @license		
*
*             .oooO  Oooo.
*             (   )  (   )
* -------------\ (----) /----------------------------------------------------------- +
*               \_)  (_/
*/

// no direct access
defined('_JEXEC') or die('Restricted access');


PapiersdefamillesHelper::headerDeclarations();
//Load the formvalidator scripts requirements.
$token = JSession::getFormToken();
?>

<div class="documents-container">
	<div class="row">
		<div id="contents" class="">

			<form action="<?php echo(JRoute::_("index.php")); ?>" method="post" name="adminForm" id="adminForm">

			<div class=" form-search btn-group"><div class="input-append"><input type="text" id="search_search" name="search_search" class="element-filter element-search search-query" title="" placeholder="<?php echo Jtext::_('PAPIERSDEFAMILLES_FILTER_NULL_NUM_ID_MAIN_PIC_GALLERY_PIC_ALIAS')?>" value="<?php echo $this->state->get('search.search')?>">
					<a class="btn hasTooltip btn-search" style="cursor:pointer;" type="button"><i class="icon-search icomoon "></i></a>
					<a class="btn hasTooltip btn-reset-filter" style="cursor:pointer;" onclick="Joomla.resetFilters();" type="button"><i class="icon-remove icomoon "></i></a></div></div>

				<div class="input-append" style="float: right">
					<a class="btn" style="cursor:pointer;" href="<?php echo JRoute::_('index.php?option=com_papiersdefamilles&view=documents&layout=default&Itemid=101')?>"><?php echo JText::_('PAPIERSDEFAMILLES_TEXT_BACKMAINLIST')?></a></div>

				<input type="hidden" id="option" name="option" value="com_papiersdefamilles">
				<input type="hidden" id="view" name="view" value="documents">
				<input type="hidden" id="layout" name="layout" value="default">
				<input type="hidden" id="Itemid" name="Itemid" value="136">
				<input type="hidden" name="<?php echo $token?>" value="1">
			</form>
			<!-- BRICK : form -->
			<?php echo $this->loadTemplate('fly'); ?>

		</div>
	</div>


	<?php 
		$jinput = JFactory::getApplication()->input;
		echo JDom::_('html.form.footer', array(
		'dataObject' => $this->item,
		'values' => array(
					'id' => $this->state->get('document.id')
				)));
	?>
</div>

<script type="text/javascript">
    jQuery(document).ready(function ($) {

        $('#adminForm .btn-search').on('click', function (e) {

            Joomla.submitform();

            e.preventDefault();
            return false;
        })

        $('#adminForm .btn-reset-filter').on('click', function (e) {
            Joomla.submitform();
            e.preventDefault();
            return false;
        })
    })
</script>