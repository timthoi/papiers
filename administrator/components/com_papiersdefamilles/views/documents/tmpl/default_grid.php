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


JHtml::addIncludePath(JPATH_ADMIN_PAPIERSDEFAMILLES . '/helpers/html');
JHtml::_('behavior.tooltip');
//JHtml::_('behavior.multiselect');

$model     = $this->model;
$user      = JFactory::getUser();
$userId    = $user->get('id');
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
$saveOrder = $listOrder == 'a.id' && $listDirn != 'desc';
JDom::_('framework.sortablelist', array(
    'domId'                  => 'grid-documents',
    'listOrder'              => $listOrder,
    'listDirn'               => $listDirn,
    'formId'                 => 'adminForm',
    'ctrl'                   => 'documents',
    'proceedSaveOrderButton' => true,
));
?>

<div class="clearfix"></div>
<div class="">
	<table class='table table-striped' id='grid-documents'>
		<thead>
		<tr>
            <?php if ($model->canSelect()): ?>
				<th>
                    <?php echo JDom::_('html.form.input.checkbox', array(
                        'dataKey'   => 'checkall-toggle',
                        'title'     => JText::_('JGLOBAL_CHECK_ALL'),
                        'selectors' => array(
                            'onclick' => 'Joomla.checkAll(this);'
                        )
                    )); ?>
				</th>
            <?php endif; ?>

            <?php if ($model->canEditState()): ?>
				<th style="text-align:center">
                    <?php echo JHTML::_('grid.sort', "PAPIERSDEFAMILLES_FIELD_ORDERING", 'a.ordering', $listDirn,
                        $listOrder); ?>
				</th>
            <?php endif; ?>

			<th style="text-align:center">
                <?php echo JHTML::_('grid.sort', "PAPIERSDEFAMILLES_FIELD_CODE", 'a.num_id', $listDirn,
                    $listOrder); ?>
			</th>

			<th style="text-align:left">
                <?php echo JText::_("PAPIERSDEFAMILLES_FIELD_MAIN_PIC"); ?>
			</th>

			<th style="text-align:left">
                <?php echo JText::_("PAPIERSDEFAMILLES_FIELD_NAME"); ?>
			</th>

			<th style="text-align:center; display: none">
                <?php echo JText::_("PAPIERSDEFAMILLES_FIELD_DESCRIPTION"); ?>
			</th>

			<th style="text-align:left">
                <?php echo JText::_("PAPIERSDEFAMILLES_FIELD_FORMAT_DOCUMENT"); ?>
			</th>

			<th style="text-align:left">
                <?php echo JText::_("PAPIERSDEFAMILLES_FIELD_NUMBER_OF_PAGES"); ?>
			</th>

			<th style="text-align:left">
                <?php echo JText::_("PAPIERSDEFAMILLES_FIELD_QUALITIES"); ?>
			</th>

			<th style="text-align:left">
                <?php echo JText::_("PAPIERSDEFAMILLES_FIELD_IS_SALE"); ?>
			</th>

			<th style="text-align:center">
                <?php echo JText::_("PAPIERSDEFAMILLES_FIELD_IS_SALE_EBAY"); ?>
			</th>


			<th style="text-align:center">
                <?php echo JText::_("PAPIERSDEFAMILLES_FIELD_NOTE"); ?>
			</th>

            <?php if ($model->canEditState()): ?>
				<th style="text-align:center">
                    <?php echo JText::_("PAPIERSDEFAMILLES_FIELD_PUBLISHED"); ?>
				</th>
            <?php endif; ?>

			<th style="text-align:center">
                <?php echo JText::_("PAPIERSDEFAMILLES_FIELD_CREATION_DATE"); ?>
			</th>

			<th style="text-align:center">
                <?php echo JText::_("PAPIERSDEFAMILLES_FIELD_CREATED_BY_NAME"); ?>
			</th>
		</tr>
		</thead>
		<tbody>
        <?php
        $k = 0;
        for ($i = 0, $n = count($this->items); $i < $n; $i++):
            $row = $this->items[$i];

            ?>

			<tr class="<?php echo "row$k"; ?>">
                <?php if ($model->canSelect()): ?>
					<td>
                        <?php if ($row->params->get('access-edit') || $row->params->get('tag-checkedout')): ?>
                            <?php echo JDom::_('html.grid.checkedout', array(
                                'dataObject' => $row,
                                'num'        => $i
                            ));
                            ?>
                        <?php endif; ?>
					</td>
                <?php endif; ?>

                <?php if ($model->canEditState()): ?>
					<td style="text-align:center">
                        <?php echo JDom::_('html.grid.ordering', array(
                            'aclAccess'  => 'core.edit.state',
                            'dataKey'    => 'ordering',
                            'dataObject' => $row,
                            'enabled'    => $saveOrder
                        )); ?>
					</td>
                <?php endif; ?>


				<td style="text-align:center">
                    <?php echo JDom::_('html.fly', array(
                        'dataKey'    => 'num_id',
                        'dataObject' => $row,
                        'route'      => array('view' => 'document', 'layout' => 'document', 'cid[]' => $row->id)
                    )); ?>
				</td>

				<td style="text-align:center">
                    <?php

                    $row->avatars = '';

                    if ( ! empty($row->main_pic)) {
                        $row->avatars = JFolder::files(JPATH_SITE . DS . json_decode($row->main_pic), '.jpg|.png|.jpeg',
                            false, false, array());

                        if (isset($row->avatars[0])) {
                            $row->avatars = ($row->avatars[0]);
                        } else {
                            $row->avatars = '';
                        }
                    }

                    $scrTmp = JURI::root(true) . DS . json_decode($row->main_pic) . DS . $row->avatars;
                    ?>

					<img src="<?php echo $scrTmp ?>" alt="main pic" style="width: 100px">
				</td>
				<td style="text-align:center; display: none">
                    <?php echo JDom::_('html.fly', array(
                        'dataKey'    => 'description',
                        'dataObject' => $row,
                        'route'      => array('view' => 'document', 'layout' => 'document', 'cid[]' => $row->id)
                    )); ?>
				</td>

				<td style="text-align:left">
                    <?php
                    $tmpName = json_decode($row->main_persons);

                    echo (isset($tmpName[0]->name)) ? $tmpName[0]->name : '-';
                    ?>
				</td>

				<td style="text-align:left">
                    <?php echo PapiersdefamillesHelperEnum::_('format_documents')[$row->format_document]['text'] ?>
				</td>


				<td style="text-align:left">
                    <?php echo JDom::_('html.fly', array(
                        'dataKey'    => 'number_of_pages',
                        'dataObject' => $row
                    )); ?>
				</td>

				<td style="text-align:center">
                    <?php

                    $qualities = (isset(PapiersdefamillesHelperEnum::_('qualities')[$row->qualities])) ?  PapiersdefamillesHelperEnum::_('qualities')[$row->qualities]['text'] : '-';
                    echo $qualities; ?>
				</td>

				<td style="text-align:center">
                    <?php echo JDom::_('html.fly.bool', array(
                        'dataKey'    => 'is_sale',
                        'dataObject' => $row,
                        'togglable'  => false,
                        'viewType'   => 'icon'
                    )); ?>
				</td>

				<td style="text-align:center">
                    <?php echo JDom::_('html.fly.bool', array(
                        'dataKey'    => 'is_sale_ebay',
                        'dataObject' => $row,
                        'togglable'  => false,
                        'viewType'   => 'icon'
                    )); ?>
				</td>

				<td style="text-align:left">
                    <?php echo JDom::_('html.fly', array(
                        'dataKey'    => 'note',
                        'dataObject' => $row
                    )); ?>
				</td>

                <?php if ($model->canEditState()): ?>
					<td style="text-align:center">
                        <?php echo JDom::_('html.grid.publish', array(
                            'ctrl'       => 'documents',
                            'dataKey'    => 'published',
                            'dataObject' => $row,
                            'num'        => $i
                        )); ?>
					</td>
                <?php endif; ?>

				<td style="text-align:center">
                    <?php echo JDom::_('html.fly.datetime', array(
                        'dataKey'    => 'creation_date',
                        'dataObject' => $row,
                        'dateFormat' => 'd-m-Y H:i'
                    )); ?>
				</td>

				<td style="text-align:center">
                    <?php echo JDom::_('html.fly', array(
                        'dataKey'    => '_created_by_name',
                        'dataObject' => $row
                    )); ?>
				</td>
			</tr>
            <?php
            $k = 1 - $k;
        endfor;
        ?>
		</tbody>
	</table>
</div>