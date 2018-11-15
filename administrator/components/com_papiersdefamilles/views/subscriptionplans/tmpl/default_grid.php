<?php
/**
* @version		
* @package		Papiersdefamilles
* @subpackage	Continents
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
	'domId' => 'grid-subscriptionplans',
	'listOrder' => $listOrder,
	'listDirn' => $listDirn,
	'formId' => 'adminForm',
	'ctrl' => 'subscriptionplans',
	'proceedSaveOrderButton' => true,
));
?>

<div class="clearfix"></div>
<div class="">
	<table class='table' id='grid-subscriptionplans'>
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

				<?php if ($model->canEditState()): ?>
				<th style="text-align:center">
					<?php echo JHTML::_('grid.sort',  "PAPIERSDEFAMILLES_HEADING_ORDERING", 'a.ordering', $listDirn, $listOrder ); ?>
				</th>
				<?php endif; ?>

                <th style="text-align:left">
                    <?php echo JText::_("PAPIERSDEFAMILLES_FIELD_NAME"); ?>
                </th>

				<th style="text-align:left">
                    <?php echo JText::_("PAPIERSDEFAMILLES_FIELD_TYPE_SUBSCRIPTION_PLANS"); ?>
				</th>

                <th style="text-align:left">
                    <?php echo JText::_("PAPIERSDEFAMILLES_FIELD_DESCRIPTION"); ?>
                </th>

                <th style="text-align:left">
                    <?php echo JText::_("PAPIERSDEFAMILLES_FIELD_NOTE"); ?>
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

                <td style="text-align:left">
                    <?php echo JDom::_('html.fly', array(
                        'dataKey' => 'name',
                        'dataObject' => $row,
                        'route' => array('view' => 'subscriptionplan','layout' => 'subscriptionplan','cid[]' => $row->id)
                    ));?>
                </td>

                <td style="text-align:left">
                    <?php if ( $row->price):?>
                    <?php echo $row->price . Jtext::_('PAPIERSDEFAMILLES_CURRENCY') . ' / ' . $row->times . ' ' . PapiersdefamillesHelperEnum::_('type_subscription_plans')[$row->type_subscription_plans]['text']?>
                    <?php else:?>.
                        <span class="label label-warning"><?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_FREE')?></span>
                    <?php endif;?>
                </td>

                <td style="text-align:left">
                    <?php echo mb_substr($row->description, 0, 20) . '...';?>
                </td>

                <td style="text-align:left">
                    <?php echo mb_substr($row->note, 0, 20) . '...';?>
                </td>

				<?php if ($model->canEditState()): ?>
				<td style="text-align:center">
					<?php echo JDom::_('html.grid.publish', array(
						'ctrl' => 'subscriptionplans',
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