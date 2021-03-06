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
JDom::_('html.toolbar');
?>

<form action="<?php echo(JRoute::_("index.php")); ?>" method="post" name="adminForm" id="adminForm">
	<div class="row-fluid">
		<div id="sidebar" class="span2">
			<div class="sidebar-nav">

				<!-- BRICK : menu -->
				<?php echo JDom::_('html.menu.submenu', array(
					'list' => $this->menu
				)); ?>

				<div class="nav-filters">
					<!-- BRICK : filters -->
					<?php if ($this->canDo->get('core.edit.state')): ?>
						<?php echo $this->filters['filter_published']->input;?>
					<?php endif; ?>

					
					<hr class="hr-condensed">
						<?php echo $this->filters['filter_creation_date_from']->input;?>
						<?php echo $this->filters['filter_creation_date_to']->input;?>
					<hr class="hr-condensed">
					<?php echo $this->filters['filter_created_by']->input;?>
					<div class="static">
						<p>Total document: <?php echo  PapiersdefamillesHelper::getTotalDocuments();?> </p>
						<p>Total Faire part décès : <?php echo  PapiersdefamillesHelper::getTotalCategoryDocuments(5);?> </p>
						<p>Total faire part mariage : <?php echo  PapiersdefamillesHelper::getTotalCategoryDocuments(1);?> </p>
					</div>
				</div>


			</div>
		</div>
		<div id="contents" class="span10">

			<!-- BRICK : filters -->
			<div class="pull-left">
				<?php echo $this->filters['search_search']->input;?>

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

			<div class="row-fluid filter-row">
				<div class="span3">
					<?php echo $this->filters['filter_country_id']->input;?>
				</div>
				<div class="span3">
                    <?php echo $this->filters['filter_region_id']->input;?>
				</div>
				<!--
				<div class="span3">
                    <?php echo $this->filters['filter_city_id']->input;?>
				</div>
				-->
				<div class="span3">
                    <?php echo $this->filters['filter_district_id']->input;?>
				</div>
			</div>

			<div class="row-fluid filter-row">
				<div class="span3">
                    <?php echo $this->filters['filter_category_id']->input;?>
				</div>
				<div class="span3">
                    <?php echo $this->filters['filter_typedocument_id']->input;?>
				</div>
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
					'view' => $jinput->get('view', 'documents'),
					'layout' => $jinput->get('layout', 'default'),
					'boxchecked' => '0',
					'filter_order' => $this->escape($this->state->get('list.ordering')),
					'filter_order_Dir' => $this->escape($this->state->get('list.direction'))
				)));
	?>
</form>