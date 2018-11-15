<?php
/** 
* @package		Papiersdefamilles
* @subpackage	Reservations
* @copyright	
* @author		 -  - 
* @license		
*
*             .oooO  Oooo.
*             (   )  (   )
* -------------\ (----) /----------------------------------------------------------- +
*               \_)  (_/
*/

// no direct access
defined('_JEXEC') or die('Restricted access');


JHtml::addIncludePath(JPATH_ADMIN_PAPIERSDEFAMILLES.'/helpers/html');
JHtml::_('behavior.tooltip');
//JHtml::_('behavior.multiselect');

$model		= $this->model;
$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$saveOrder	= $listOrder == 'a.ordering' && $listDirn != 'desc';
JDom::_('framework.sortablelist', array(
	'domId' => 'grid-reservations',
	'listOrder' => $listOrder,
	'listDirn' => $listDirn,
	'formId' => 'adminForm',
	'ctrl' => 'reservations',
	'proceedSaveOrderButton' => true,
));
?>

<div class="clearfix"></div>
<div class="">
	<table class='table' id='grid-reservations'>
		<thead>
			<tr>
				<?php if ($model->canSelect()): ?>
				<th>
					<?php echo JDom::_('html.form.input.checkbox', array(
						'dataKey' => 'checkall-toggle',
						'title' => JText::_('JGLOBAL_CHECK_ALL'),
						'selectors' => array(
							'onclick' => 'Joomla.checkAll(this);'
						)
					)); ?>
				</th>
				<?php endif; ?>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_DEPARTURE_DATE"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_ARRIVAL_DATE"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_NUMBER_ADULT_TICKET"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_NUMBER_CHILDRENT_TICKET_1"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_NUMBER_CHILDRENT_TICKET_2"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_INFORMATION_ADULT"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_INFORMATION_CHILD_1"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_INFORMATION_CHILD_2"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_TICKET_TYPE_NUM_ID"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_NAME"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_SURNAME"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_PHONE"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_ADDRESS"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_ZIP_CODE"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_CITY"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_EMAIL"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_BIRTHDAY"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_TICKET_PRICE"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_TICKET_TOTAL"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_DISCOUNT"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_QUOTE"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_PAYPAL"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_PAYPAL_REFUND"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_PAYMENT_STATUS"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_CREATED_BY_NAME"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_MODIFIED_BY_NAME"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_CREATION_DATE"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_MODIFICATION_DATE"); ?>
				</th>

				<?php if ($model->canEditState()): ?>
				<th style="text-align:center">
					<?php echo JHTML::_('grid.sort',  "PAPIERSDEFAMILLES_HEADING_ORDERING", 'a.ordering', $listDirn, $listOrder ); ?>
				</th>
				<?php endif; ?>

				<?php if ($model->canEditState()): ?>
				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_PUBLISHED"); ?>
				</th>
				<?php endif; ?>
			</tr>
		</thead>
		<tbody>
		<?php
		$k = 0;
		for ($i=0, $n=count( $this->items ); $i < $n; $i++):
			$row = $this->items[$i];

			?>

			<tr class="<?php echo "row$k"; ?>">
				<?php if ($model->canSelect()): ?>
				<td>
					<?php if ($row->params->get('access-edit') || $row->params->get('tag-checkedout')): ?>
						<?php echo JDom::_('html.grid.checkedout', array(
													'dataObject' => $row,
													'num' => $i
														));
						?>
					<?php endif; ?>
				</td>
				<?php endif; ?>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly.datetime', array(
						'dataKey' => 'departure_date',
						'dataObject' => $row,
						'dateFormat' => 'Y-m-d'
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly.datetime', array(
						'dataKey' => 'arrival_date',
						'dataObject' => $row,
						'dateFormat' => 'Y-m-d'
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'number_adult_ticket',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'number_childrent_ticket_1',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'number_childrent_ticket_2',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'information_adult',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'information_child_1',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'information_child_2',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => '_ticket_type_id_num_id',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'name',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'surname',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'phone',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'address',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'zip_code',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'city',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'email',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly.datetime', array(
						'dataKey' => 'birthday',
						'dataObject' => $row,
						'dateFormat' => 'Y-m-d'
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'ticket_price',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'ticket_total',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'discount',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly.bool', array(
						'dataKey' => 'is_quote',
						'dataObject' => $row,
						'togglable' => false,
						'viewType' => 'icon'
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly.bool', array(
						'dataKey' => 'is_paypal',
						'dataObject' => $row,
						'togglable' => false,
						'viewType' => 'icon'
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly.bool', array(
						'dataKey' => 'is_paypal_refund',
						'dataObject' => $row,
						'togglable' => false,
						'viewType' => 'icon'
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly.bool', array(
						'dataKey' => 'payment_status',
						'dataObject' => $row,
						'togglable' => false,
						'viewType' => 'icon'
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => '_created_by_name',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => '_modified_by_name',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly.datetime', array(
						'dataKey' => 'creation_date',
						'dataObject' => $row,
						'dateFormat' => 'Y-m-d H:i'
					));?>
				</td>

				<td style="text-align:center">
					<?php echo JDom::_('html.fly.datetime', array(
						'dataKey' => 'modification_date',
						'dataObject' => $row,
						'dateFormat' => 'Y-m-d H:i'
					));?>
				</td>

				<?php if ($model->canEditState()): ?>
				<td style="text-align:center">
					<?php echo JDom::_('html.grid.ordering', array(
						'aclAccess' => 'core.edit.state',
						'dataKey' => 'ordering',
						'dataObject' => $row,
						'enabled' => $saveOrder
					));?>
				</td>
				<?php endif; ?>

				<?php if ($model->canEditState()): ?>
				<td style="text-align:center">
					<?php echo JDom::_('html.grid.publish', array(
						'ctrl' => 'reservations',
						'dataKey' => 'published',
						'dataObject' => $row,
						'num' => $i
					));?>
				</td>
				<?php endif; ?>
			</tr>
			<?php
			$k = 1 - $k;
		endfor;
		?>
		</tbody>
	</table>
</div>