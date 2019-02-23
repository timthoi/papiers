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


if ( ! $this->form) {
    return;
}

$fieldSets = $this->form->getFieldsets();

JText::script('PAPIERSDEFAMILLES_TEXT_REMOVE_FILE');
JText::script('PAPIERSDEFAMILLES_TEXT_ARE_YOU_SURE');
JText::script('PAPIERSDEFAMILLES_TEXT_DRAG_DROP_IMAGE');
JText::script('PAPIERSDEFAMILLES_ERROR_DUPLICATE');

?>

<?php $fieldSet = $this->form->getFieldset('document.form');
$pathGalleries  = json_decode($this->item->gallery_pic);
$galleries      = json_decode($this->item->galleries);

$pathMainPics = json_decode($this->item->main_pic);
$mainPic      = json_decode($this->item->avatars);
?>
<div class="item-document">
    <?php
        $row = $this->item;

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

        $linkDetail = '';

        ?>


		<div class="document-information">
			<div class="col-xs-2">
				<div class="document-pic">
					<a rel="nofollow" class=""
					   href="<?php echo $linkDetail ?>"><img
								alt=""
								src="<?php echo $scrTmp ?>"
								class="image_resultat_document lazy">
					</a>
				</div>
			</div>
			<div class="col-xs-10 document-information-detail">
				<a class="link-document"
				   href="<?php echo $linkDetail ?>"><?php echo $types . ' ' . $categories ?><?php echo $yearText ?></a>

				<div class="document-information-group main-name">
					<span class="document-information-label"><?php echo JText::_('PAPIERSDEFAMILLES_TEXT_MAIN_NAME') ?></span>
                    <?php echo PapiersdefamillesHelper::printOutRawMainPersons($row->main_persons, $row->categories); ?>
				</div>

                <?php
                $tmpSecondaryPersons = PapiersdefamillesHelper::printOutRawSecondaryPersons($row->secondary_persons,3 );
                if ( ! empty($tmpSecondaryPersons)) :?>
					<div class="document-information-group secondary-name">
						<span class="document-information-label"><?php echo JText::_('PAPIERSDEFAMILLES_TEXT_SECONDARY_NAME') ?></span>
						<span>
							<?php echo $tmpSecondaryPersons; ?></span>
						</span>
					</div>
                <?php endif; ?>

                <?php
                $tmpLocations = PapiersdefamillesHelper::printOutRawCityLocations($row->locations);
                if ( ! empty($tmpLocations)) : ?>
					<div class="document-information-group address">
						<span class="document-information-label"><?php echo JText::_('PAPIERSDEFAMILLES_TEXT_LOCATION') ?></span>
						<span class="location">
							<?php echo PapiersdefamillesHelper::printOutRawCityLocations($row->locations); ?>
						</span>
					</div>
                <?php endif; ?>

                <?php
                $tmpLocations = PapiersdefamillesHelper::printOutRawCityLocations($row->locations);
                if ( ! empty($tmpLocations)) : ?>
					<div class="document-information-group address">
						<span class="document-information-label"><?php echo JText::_('PAPIERSDEFAMILLES_TEXT_DEPARTEMENT') ?></span>
						<span class="location">
							<?php echo PapiersdefamillesHelper::printOutRawDepartmentLocations($row->locations); ?>
						</span>
					</div>
                <?php endif; ?>

                <?php
                $tmpLocations = PapiersdefamillesHelper::printOutRawRegionLocations($row->locations);
                if ( ! empty($tmpLocations)) : ?>
					<div class="document-information-group address">
						<span class="document-information-label"><?php echo JText::_('PAPIERSDEFAMILLES_TEXT_REGIONS') ?></span>
						<span class="location">
							<?php echo PapiersdefamillesHelper::printOutRawRegionLocations($row->locations); ?>
						</span>
					</div>
                <?php endif; ?>

                <?php
                $tmpLocations = PapiersdefamillesHelper::printOutRawRegionLocations($row->locations);
                if ( ! empty($tmpLocations)) : ?>
					<div class="document-information-group address">
						<span class="document-information-label"><?php echo JText::_('PAPIERSDEFAMILLES_TEXT_COUNTRIES') ?></span>
						<span class="location">
							<?php echo PapiersdefamillesHelper::printOutRawCountryLocations($row->locations); ?>
						</span>
					</div>
                <?php endif; ?>
			</div>
		</div>
		<div class="clearfix"></div>
</div>

<style>

</style>

<script>
</script>