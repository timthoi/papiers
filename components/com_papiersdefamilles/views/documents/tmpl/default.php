<?php
/**
 * @version
 * @package        Papiersdefamilles
 * @subpackage     Ticket Types
 * @copyright
 * @author         Harvey - timthoi
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
JDom::_('html.toolbar');
?>
<div class="documents-container">
	<form action="<?php echo(JRoute::_("index.php")); ?>" method="post" name="adminForm" id="adminForm">
		<div class="row">
			<div id="sidebar" class="span2">
				<div class="sidebar-nav">
					<!-- BRICK : display -->
					<div class="sortable">
						<?php echo $this->filters['sortTable']->input;?>
						<hr class="hr-condensed">
					</div>

					<div class="clearfix"></div>
					<div class="nav-filters">
                        <?php echo $this->filters['filter_typedocument_id']->input; ?>
						<hr class="hr-condensed">
						<input type="text" name="search_search" class="element-filters search_search1" title="" placeholder="<?php echo Jtext::_('PAPIERSDEFAMILLES_FILTER_NAME_1')?>" value="<?php echo $this->state->get('search.search')?>">

						<input type="text" name="search_search2" class="element-filters" title="" placeholder="<?php echo Jtext::_('PAPIERSDEFAMILLES_FILTER_NAME_2')?>" value="<?php echo $this->state->get('search.search2')?>">

						<input type="text" name="search_search3" class="element-filters" title="" placeholder="<?php echo Jtext::_('PAPIERSDEFAMILLES_FILTER_NAME_3')?>" value="<?php echo $this->state->get('search.search3')?>">

						<input type="text" name="search_search4" class="element-filters" title="" placeholder="<?php echo Jtext::_('PAPIERSDEFAMILLES_FILTER_NAME_4')?>" value="<?php echo $this->state->get('search.search4')?>">
						<hr class="hr-condensed">
                        <?php echo $this->filters['filter_country_id']->input; ?>
						<hr class="hr-condensed">
                        <?php echo $this->filters['filter_region_id']->input; ?>
						<hr class="hr-condensed">
                        <?php echo $this->filters['filter_district_id']->input; ?>

						<input type="submit" value="<?php echo JText::_('PAPIERSDEFAMILLES_TEXT_SEARCH')?>" class="filter_submit_btn">
					</div>
				</div>
			</div>
			<div id="contents" class="span10">

				<!-- BRICK : filters -->
				<div class="pull-left">

						<div class=" form-search btn-group"><div class="input-append"><input type="text" id="search_search" name="search_search" class="element-filter element-search search-query" title="" placeholder="<?php echo Jtext::_('PAPIERSDEFAMILLES_FILTER_NULL_NUM_ID_MAIN_PIC_GALLERY_PIC_ALIAS')?>" value="<?php echo $this->state->get('search.search')?>">

								<a class="btn hasTooltip btn-search" style="cursor:pointer;" type="button"><i class="icon-search icomoon "></i></a>
								<a class="btn hasTooltip btn-reset-filter" style="cursor:pointer;" onclick="Joomla.resetFilters();" type="button"><i class="icon-remove icomoon "></i></a></div></div>

                        <?php //echo $this->filters['search_search']->input;?>

				</div>



				<div class="pull-right hidden">
                    <?php echo $this->filters['directionTable']->input;?>
				</div>


				<div class="pull-right">
                    <?php echo $this->filters['limit']->input;?>
				</div>

				<div class="clearfix"></div>

				<div class="row">
					<div class="col-md-12">
					<p class="search-message"><?php echo JText::sprintf('PAPIERSDEFAMILLES_FIELD_SEARCH_MESSAGE_TOTAL', $this->pagination->get('total'), $this->state->get('search.search'))?></p>
					</div>
				</div>


				<!-- BRICK : grid -->
                <?php echo $this->loadTemplate('grid'); ?>

				<!-- BRICK : pagination -->
				<div class="pagination-container">
					<?php echo $this->pagination->getPagesLinks(); ?>
				</div>
			</div>
		</div>


        <?php
        $jinput = JFactory::getApplication()->input;
        echo JDom::_('html.form.footer', array(
            'values' => array(
                'view'             => $jinput->get('view', 'documents'),
                'layout'           => $jinput->get('layout', 'default'),
                'boxchecked'       => '0',
                'filter_order'     => $this->escape($this->state->get('list.ordering')),
                'filter_order_Dir' => $this->escape($this->state->get('list.direction'))
            )
        ));
        ?>
	</form>
</div>


<script type="text/javascript">
    jQuery(document).ready(function ($) {
		$('.pagination-container ul').addClass('pagination');
		$('.pagination-container li').addClass('page-item');
        $('.pagination-container li > a').addClass('page-link');
        $('.pagination-container span.pagenav').parent().addClass('active');

    })
</script>