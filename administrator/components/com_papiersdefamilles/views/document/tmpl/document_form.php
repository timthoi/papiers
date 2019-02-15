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

$token = JSession::getFormToken();
?>

<?php

$fieldSet = $this->form->getFieldset('document.form');

?>
<fieldset class="fieldsform form-horizontal">

	<div class="wrapper-main-pic">
		<div class="image" style="display: none">
			<a rel="gallery" title="" href="<?php echo $this->mainPicPath ?>">
				<img src="<?php echo $this->mainPicPath ?>">
			</a>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span4">
			<h4><?php echo JText::_('PAPIERSDEFAMILLES_FIELD_MAIN_PIC') ?></h4>
			<div class="drag_drop_zone">
				<div class="upload-btn-wrapper">
					<button class="btn">Upload a file</button>
					<input type="file" name="main_pic" accept="image/*"/>
				</div>
				<div class="clearfix"></div>
				<img class="upload-file see_main_pic" src="<?php echo $this->mainPicPath?>" alt="<?php echo $this->mainPicName?>">
			</div>

			<div class="clearfix"></div>

			<!-- Add pdf -->
			<h4><?php echo JText::_('PAPIERSDEFAMILLES_FIELD_ADD_PDF') ?></h4>
			<a target="_blank" href="<?php echo $this->pdfFilePath ?>"><?php echo $this->pdfFileName ?></a>
			<div class="drag_drop_zone">
				<div class="upload-btn-wrapper">
					<button class="btn">Upload a file</button>
					<input type="file" name="pdf_file" accept="application/pdf"/>
				</div>
				<div class="clearfix"></div>
			</div>

			<div class="clearfix"></div>

			<!-- Add original pdf file -->
			<h4><?php echo JText::_('PAPIERSDEFAMILLES_FIELD_ADD_ORIGINAL') ?></h4>
			<a target="_blank" href="<?php echo $this->originalFilePath ?>"><?php echo $this->originalFileName ?></a>
			<div class="drag_drop_zone">
				<div class="upload-btn-wrapper">
					<button class="btn">Upload a file</button>
					<input type="file" name="original_file" accept="application/pdf"/>
				</div>
				<div class="clearfix"></div>
			</div>

			<div class="clearfix"></div>

			<!-- Add tif file -->
			<h4><?php echo JText::_('PAPIERSDEFAMILLES_FIELD_ADD_TIF') ?></h4>
			<a target="_blank" href="<?php echo $this->tiffFilePath ?>"><?php echo $this->tiffFileName ?></a>
			<div class="drag_drop_zone">
				<div class="upload-btn-wrapper">
					<button class="btn">Upload a file</button>
					<input type="file" name="tiff_file" accept="application/pdf"/>
				</div>
				<div class="clearfix"></div>
			</div>

			<div class="clearfix"></div>

            <?php
            // Note
            $field = $fieldSet['jform_note'];
            ?>
			<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">

                    <?php echo $field->label; ?>

                    <?php echo $field->input; ?>

			</div>
            <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>

		</div>
		<div class="span8">

            <?php
            // traceability
            $field  = $fieldSet['jform_traceability'];
            $cidTmp = (isset($this->item->id)) ? $this->item->id : '';
            ?>
			<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
				<div class="control-label">
                    <?php echo $field->label; ?>
				</div>

				<div class="controls">
					<input type="text" id="" name="" value="<?php echo $cidTmp ?>" size="32" disabled>
				</div>
			</div>
            <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>


            <?php
            // code
            $field = $fieldSet['jform_num_id'];
            ?>
			<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
				<div class="control-label">
                    <?php echo $field->label; ?>
				</div>

				<div class="controls">
                    <?php echo $field->input; ?>
				</div>
			</div>
            <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>

            <?php
            // price
            $field  = $fieldSet['jform_price'];
            $cidTmp = (isset($this->item->id)) ? $this->item->id : '';
            ?>
			<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
				<div class="control-label">
                    <?php echo $field->label; ?>
				</div>

				<div class="controls">
  					<?php echo $field->input; ?>
				</div>
			</div>
            <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>

			<div class="row-fluid">
				<div class="span6">
                    <?php
                    // categories
                    $field = $fieldSet['jform_categories'];
                    ?>
					<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
						<div class="control-label">
                            <?php echo $field->label; ?>
						</div>

						<div class="controls">
                            <?php echo $field->input; ?>
						</div>
					</div>
				</div>
				<div class="span6">
                    <?php
                    // typedocuments
                    $field = $fieldSet['jform_typedocuments'];
                    ?>
					<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?> special-edit">
						<div class="control-label">
                            <?php echo $field->label; ?>
						</div>

						<div class="controls">
                            <?php echo $field->input; ?>
						</div>
					</div>
				</div>


				<div class="row-fluid">
					<div class="span4">
                        <?php
                        // format document
                        $field              = $fieldSet['jform_format_document'];
                        $field->jdomOptions = array(
                            'list' => PapiersdefamillesHelperEnum::_('format_documents')
                        );
                        ?>
						<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
							<div class="control-label">
                            <?php echo $field->label; ?>
						</div>

							<div class="controls">
                            <?php echo $field->input; ?>
						</div>
						</div>
                        <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>

					</div>
					<div class="span4">
                        <?php
                        // qualities
                        $field = $fieldSet['jform_qualities'];
                        ?>
						<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?> special-edit">
							<div class="control-label">
                            <?php echo $field->label; ?>
						</div>

							<div class="controls">
                            <?php echo $field->input; ?>
						</div>
						</div>
                        <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>

					</div>
					<div class="span4">
                        <?php
                        // number_of_pages
                        $field = $fieldSet['jform_number_of_pages'];
                        ?>
						<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>  special-edit">
							<div class="control-label">
                            <?php echo $field->label; ?>
						</div>

							<div class="controls">
                            <?php echo $field->input; ?>
						</div>
						</div>
                        <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>

					</div>
				</div>

                <?php
                // description
                $field = $fieldSet['jform_description'];
                ?>
				<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>"
					 style="display: none">

                    <?php echo $field->label; ?>

                    <?php echo $field->input; ?>
				</div>
			</div>
            <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>

			<div class="field-location">
				<fieldset class="main_locations ">
					<div class="control-group-heading">
						<h2><?php echo JText::_('PAPIERSDEFAMILLES_LAYOUT_LOCATIONS') ?></h2>
					</div>

                    <?php
                    // locations
                    $field = $fieldSet['jform_locations'];

                    ?>
					<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
						<div class="">
                            <?php echo $field->input; ?>
						</div>
					</div>
				</fieldset>

                <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>
			</div>

			<div class="field-location">
				<fieldset class="main_persons">
					<div class="control-group-heading">
						<h2><?php echo JText::_('PAPIERSDEFAMILLES_FIELD_MAIN_PERSONS') ?></h2>
					</div>

                    <?php
                    // birthday
                    $field = $fieldSet['jform_birthday'];
                    ?>
					<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
						<div class="control-label">
                            <?php echo $field->label; ?>
						</div>

						<div class="controls">
                            <?php echo $field->input; ?>
						</div>
					</div>
                    <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>

                    <?php
                    // age
                    $field = $fieldSet['jform_age'];
                    ?>
					<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
						<div class="control-label">
                            <?php echo $field->label; ?>
						</div>

						<div class="controls">
                            <?php echo $field->input; ?>
						</div>
					</div>
                    <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>


                    <?php
                    // main persons
                    $field = $fieldSet['jform_main_persons'];

                    ?>
					<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">

						<div class="">
                            <?php echo $field->input; ?>
						</div>
					</div>
                    <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>


				</fieldset>
			</div>

			<div class="field-location">
				<fieldset class="secondary_persons">
					<div class="control-group-heading">
						<h2><?php echo JText::_('PAPIERSDEFAMILLES_LAYOUT_SECONDARY_PERSONS') ?></h2>
					</div>

                    <?php
                    // secondary persons
                    $field = $fieldSet['jform_secondary_persons'];
                    ?>
					<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
						<div class="">
                            <?php echo $field->input; ?>
						</div>
					</div>
                    <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>

				</fieldset>
			</div>

			<div class="row-fluid">
                <?php
                // is sale
                $field = $fieldSet['jform_is_sale'];
                ?>
				<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?> span6">
					<div class="control-label">
                        <?php echo $field->label; ?>
					</div>

					<div class="controls">
                        <?php echo $field->input; ?>
					</div>
				</div>
                <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>

                <?php if (isset($this->item->modification_date) && ! empty($this->item->modification_date)): ?>
                    <?php
                    // modification date
                    ?>
					<div class="control-group field-jform_modification_date span6">
						<div class="control-label">
                        <?php echo Jtext::_('PAPIERSDEFAMILLES_FIELD_MODIFICATION_DATE'); ?>
					</div>

						<div class="controls">
						<?php echo JDom::_('html.fly.datetime', array(
							'dataKey' => 'modification_date',
							'dataObject' => $this->item,
							'dateFormat' => 'd-m-Y H:i:s'
						));?>
					</div>
					</div>
                <?php endif; ?>
			</div>

            <?php
            // is sale ebay
            $field = $fieldSet['jform_is_sale_ebay'];
            ?>
			<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
				<div class="control-label">
                    <?php echo $field->label; ?>
				</div>

				<div class="controls">
                    <?php echo $field->input; ?>
				</div>
			</div>
            <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>


            <?php
            // Published
            $field = $fieldSet['jform_published'];
            ?>
            <?php if ( ! method_exists($field, 'canView') || $field->canView()): ?>
				<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
					<div class="control-label">
                        <?php echo $field->label; ?>
					</div>

					<div class="controls">
                        <?php echo $field->input; ?>
					</div>
				</div>
                <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>
            <?php endif; ?>
		</div>
	</div>

    <?php
    // state_document
    $field = $fieldSet['jform_state_document'];
    ?>
	<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?> hidden">
		<div class="control-label">
            <?php echo $field->label; ?>
        </div>

		<div class="controls">
            <?php echo $field->input; ?>
        </div>
	</div>
    <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>



    <?php
    // Main Pic
    $field = $fieldSet['jform_main_pic'];
    ?>
	<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
		<div class="control-label">
			<?php echo $field->label; ?>
		</div>

		<div class="controls">
			<?php echo $field->input; ?>
		</div>
	</div>
    <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>

    <?php
    // Gallery
    $field = $fieldSet['jform_gallery_pic'];
    ?>
	<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
		<div class="control-label">
			<?php echo $field->label; ?>
		</div>

		<div class="controls">
			<?php echo $field->input; ?>
		</div>
	</div>
    <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>

</fieldset>

<?php
$baseAdmin = JURI::root(true) . '/administrator/components/' . COM_PAPIERSDEFAMILLES;
$document  = JFactory::getDocument();

$document->addScript($baseAdmin . '/js/jquery.fullscreenslides.js');
$document->addStyleSheet($baseAdmin . '/js/fullscreenstyle.css');
?>

<script>
    jQuery(document).ready(function ($) {

        jQuery(document).on('click', '.see_main_pic', function (e) {
            $('.wrapper-main-pic .image:first-child a').click();

            e.preventDefault();
            return false;
        });

        var locations = '<?php echo isset($this->item->locations) ? $this->item->locations : "" ?>';

        if (locations) {
            locations = $.parseJSON(locations);

            for (i = 0; i < locations.length; i++) {
                var location = locations[i];

                var regionId = location.region_id;

                var departementId = location.departement_id;
                var countryId = location.country_id;

               	if (regionId) {
                    renderAjaxListRegion(i, regionId);
				}
            }
        }

        function renderAjaxListRegion($locationOffset, $regionId) {
            jQuery.ajax({
                type: "POST",
                data: {
                    'region_id': $regionId,
                    'all': 0,
                    "<?php echo $token ?>": "1"
                },
                url: window.location.protocol + "//" + window.location.host + window.location.pathname + '?option=com_papiersdefamilles&task=document.renderAjaxListRegion',
                success: function (response) {
                    var listRegions = jQuery.parseJSON(response);
                    var elementLocationRegion = '#jform_locations__locations' + $locationOffset + '__region_id';
                    $(elementLocationRegion).empty().append(listRegions);

                    // Event open this
                    $(elementLocationRegion).on('liszt:showing_dropdown', function (evt, params) {
                        renderAjaxGetRegions($locationOffset, $regionId);
                    });

                    $(elementLocationRegion).trigger("liszt:updated");
                }
            })
        }

        function renderAjaxGetRegions($locationOffset, $regionId) {
            jQuery.ajax({
                type: "POST",
                data: {
                    'region_id': $regionId,
                    'all': 1,
                    "<?php echo $token ?>": "1"
                },
                url: window.location.protocol + "//" + window.location.host + window.location.pathname + '?option=com_papiersdefamilles&task=document.renderAjaxListRegion',
                success: function (response) {
                    var listRegions = jQuery.parseJSON(response);
                    var elementLocationRegion = '#jform_locations__locations' + $locationOffset + '__region_id';
                    $(elementLocationRegion).empty().append(listRegions);

                    // Event close this
                    /*$(elementLocationRegion).on('liszt:hiding_dropdown', function(evt, params) {
                        renderAjaxListRegion($locationOffset, $regionId);
                    });*/

                    $(elementLocationRegion).trigger("liszt:updated");
                }
            })
        }
    })
</script>

<script>
    jQuery(document).ready(function ($) {
        $('.image img').fullscreenslides();
        jQuery(document).on('click', '.see_main_pic', function (e) {
            $('.wrapper-main-pic .image:first-child a').click();

            e.preventDefault();
            return false;
        });

        // Increase ordering
        $(document).on('subform-row-add', function (event, row) {
            var sd = $(row).attr('data-group').replace(/[^0-9]/gi, '');
            var number = parseInt(sd, 10);

            $(row).find("input[name$='[ordering]']").val(number + 1);
            $(row).find("input[name$='[ordering]']").attr('readonly', 'readonly');
            var parentNode = $(row).parent();
            $(row).detach();
            parentNode.append($(row));
        })
    });
</script>