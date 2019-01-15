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

					<!-- BRICK : menu -->
                    <?php echo JDom::_('html.menu.submenu', array(
                        'list' => $this->menu
                    )); ?>

					<div class="nav-filters">
                        <?php echo $this->filters['filter_country_id']->input; ?>
						<hr class="hr-condensed">
                        <?php echo $this->filters['filter_region_id']->input; ?>
						<hr class="hr-condensed">
                        <?php echo $this->filters['filter_district_id']->input; ?>
						<hr class="hr-condensed">
                        <?php echo $this->filters['filter_category_id']->input; ?>
						<hr class="hr-condensed">
                        <?php echo $this->filters['filter_typedocument_id']->input; ?>
					</div>
				</div>
			</div>
			<div id="contents" class="span10">

				<!-- BRICK : filters -->
				<div class="pull-left">
					<div class="pull-left">
						<div class=" form-search btn-group"><div class="input-append"><input type="text" id="search_search" name="search_search" class="element-filter element-search search-query" title="" placeholder="<?php echo Jtext::_('PAPIERSDEFAMILLES_FILTER_NULL_NUM_ID_MAIN_PIC_GALLERY_PIC_ALIAS')?>" value="<?php echo $this->state->get('search.search')?>">

								<a class="btn hasTooltip btn-search" style="cursor:pointer;" type="button"><i class="icon-search icomoon "></i></a>
								<a class="btn hasTooltip btn-reset-filter" style="cursor:pointer;" onclick="Joomla.resetFilters();" type="button"><i class="icon-remove icomoon "></i></a></div></div>

                        <?php //echo $this->filters['search_search']->input;?>

					</div>

				</div>


				<!-- BRICK : display -->
				<div class="pull-right">
                    <?php echo $this->filters['sortTable']->input;?>
				</div>


				<div class="pull-right">
                    <?php echo $this->filters['directionTable']->input;?>
				</div>


				<div class="pull-right">
                    <?php echo $this->filters['limit']->input;?>
				</div>

				<div class="clearfix"></div>


				<!-- BRICK : grid -->
                <?php echo $this->loadTemplate('grid'); ?>

				<!-- BRICK : pagination -->
                <?php echo $this->pagination->getListFooter(); ?>

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