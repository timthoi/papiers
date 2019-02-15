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

$app    = JFactory::getApplication();
$menu   = $app->getMenu();
$active = $menu->getActive();
$itemId = (isset($active->id)) ? $active->id : 0
?>

<div class="clearfix"></div>
<div class="list-documents">
    <?php
    $k = 0;
    for ($i = 0, $n = count($this->items); $i < $n; $i++):
        $row = $this->items[$i];

        $tmpName = json_decode($row->types);

        $strTmp = '';

        if (isset($tmpName[0])) {
            foreach ($tmpName as $tmp) {
                $strTmp = $tmp . ', ';
            }

        }
        $types = substr($strTmp, 0, -2);

        $tmpName = json_decode($row->categories);

        $strTmp = '';

        if (isset($tmpName[0])) {
            foreach ($tmpName as $tmp) {
                $strTmp = $tmp . ', ';
            }
        }

        $categories = substr($strTmp, 0, -2);

        $years = substr($row->birthday, 0, 4);

        if ($years) {
            $yearText = Jtext::sprintf('PAPIERSDEFAMILLES_TEXT_YEARS', $years);
        }
        $row->avatars = '';

        if ( ! empty(json_decode($row->main_pic))) {
            $row->avatars = JFolder::files(JPATH_SITE . DS . json_decode($row->main_pic) . DS . 'thumb',
                '.jpg|.png|.jpeg',
                false, false, array());

            if (isset($row->avatars[0])) {
                $row->avatars = ($row->avatars[0]);
            } else {
                $row->avatars = '';
            }
            $scrTmp = JURI::root(true) . DS . json_decode($row->main_pic) . DS . 'thumb' . DS . $row->avatars;
        } else {
            $scrTmp = JURI::root(true) . DS . "images" . DS . 'No_Image_Available.jpg';
        }

        $linkDetail = JRoute::_('index.php?option=com_papiersdefamilles&view=document&layout=document&Itemid=' . $itemId . '&cid=' . $row->id);

        ?>


		<div class="document-information">
			<div class="col-xs-3 document-pic">
				<a rel="nofollow" class=""
				   href="<?php echo $linkDetail ?>"><img
							alt=""
							src="<?php echo $scrTmp ?>"
							class="image_resultat_document lazy">
				</a>
			</div>
			<div class="col-xs-9 document-information-detail">
				<a class="link-document"
				   href="<?php echo $linkDetail ?>"><?php echo $types . ' ' . $categories ?><?php echo $yearText ?></a>

				<div class="document-information-group main-name">
					<span class="document-information-label"><?php echo JText::_('PAPIERSDEFAMILLES_TEXT_MAIN_NAME') ?></span>
                    <?php echo PapiersdefamillesHelper::printOutRawMainPersons($row->main_persons, $row->categories); ?>
				</div>

                <?php
                $tmpLocations = PapiersdefamillesHelper::printOutRawLocations($row->locations);
                if ( ! empty($tmpLocations)) : ?>
					<div class="document-information-group address">
						<span class="document-information-label"><?php echo JText::_('PAPIERSDEFAMILLES_TEXT_LOCATION') ?></span>
						<span class="location">
							<?php echo PapiersdefamillesHelper::printOutRawLocations($row->locations); ?>
						</span>
					</div>
                <?php endif; ?>

                <?php
                $tmpSecondaryPersons = PapiersdefamillesHelper::printOutRawSecondaryPersons($row->secondary_persons);
                if ( ! empty($tmpSecondaryPersons)) :?>
					<div class="document-information-group secondary-name">
						<span class="document-information-label"><?php echo JText::_('PAPIERSDEFAMILLES_TEXT_SECONDARY_NAME') ?></span>
						<span>
							<?php echo $tmpSecondaryPersons; ?></span>
						</span>
					</div>
                <?php endif; ?>

				<a class="btn-link-detail" href="<?php echo $linkDetail ?>">
					<?php echo JText::_("PAPIERSDEFAMILLES_TEXT_ADD_MORE")?><i class="fa fa-chevron-right" aria-hidden="true"></i>
				</a>
			</div>
		</div>
		<div class="clearfix"></div>
        <?php
        $k = 1 - $k;
    endfor;
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
            $(this).parents('#adminForm').find("input[name*='filter_country_id[]']").val('');
            $(this).parents('#adminForm').find("input[name*='filter_region_id[]']").val('');
            $(this).parents('#adminForm').find("input[name*='filter_category_id[]']").val('');
            $(this).parents('#adminForm').find("input[name*='filter_typedocument_id[]']").val('');

            $(this).parents('#adminForm').find("#directionTable").val('asc');

            Joomla.submitform();
            e.preventDefault();
            return false;
        })

    })
</script>