<?php
/**
* @version		
* @package		Papiersdefamilles
* @subpackage	Reservations
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

				<th style="text-align:left">
					<?php echo JHTML::_('grid.sort',  "PAPIERSDEFAMILLES_FIELD_CREATION_DATE", 'a.creation_date', $listDirn, $listOrder ); ?>
				</th>

                <th style="text-align:center">
                    <?php echo JText::_("PAPIERSDEFAMILLES_FIELD_CODE"); ?>
                </th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_SUBSCRIPTIONPLAN"); ?>
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
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_EMAIL"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_price_total"); ?>
				</th>

				<th style="text-align:center">
					<?php echo JText::_("PAPIERSDEFAMILLES_FIELD_NOTE"); ?>
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

				<td style="text-align:left">
					<?php echo JDom::_('html.fly.datetime', array(
						'dataKey' => 'creation_date',
						'dataObject' => $row,
						'dateFormat' => 'd-m-Y H:i',
						'route' => array('view' => 'reservation','layout' => 'reservation','cid[]' => $row->id)
					));?>
				</td>
                <td style="text-align:left">
                    <?php echo JDom::_('html.fly', array(
                        'dataKey' => '',
                        'dataObject' => $row
                    ));?>
                </td>

                <td style="text-align:left">
                    <?php echo JDom::_('html.fly', array(
                        'dataKey' => '_subscriptionplan_id_name',
                        'dataObject' => $row
                    ));?>
                </td>


				<td style="text-align:left">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'name',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:left">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'surname',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:left">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'phone',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:left">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'email',
						'dataObject' => $row
					));?>
				</td>


				<td style="text-align:center">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'price_total',
						'dataObject' => $row
					));?>
				</td>


                <td style="text-align:left">
                    <?php echo mb_substr($row->note, 0, 20) . '...';?>
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