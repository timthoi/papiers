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

<?php $fieldSet = $this->form->getFieldset('document.form');
$pathMainPics = '';
if (isset($this->item->main_pic)) {
    $pathMainPics = json_decode($this->item->main_pic);
}

$mainPic = '';
if (isset($this->item->avatars)) {
    $mainPic = json_decode($this->item->avatars);
}
?>
<fieldset class="fieldsform form-horizontal">

	<div class="wrapper-main-pic">
        <?php
        $srcPic = JUri::root() . $pathMainPics . '/' . $mainPic;
        ?>
		<div class="image" style="display: none">
			<a rel="gallery" title="" href="<?php echo $srcPic ?>">
				<img src="<?php echo $srcPic ?>">
			</a>
		</div>
	</div>

	<div class="wrapper-main-pic-thumb">
        <?php
        $srcPic = JUri::root() . $pathMainPics . '/thumb/' . $mainPic;
        ?>
		<div class="image" style="display: none">
			<a rel="gallery" title="" href="<?php echo $srcPic ?>">
				<img src="<?php echo $srcPic ?>">
			</a>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span4">
			<div class="drag_drop_zone_main_pic">
				<div class="control-group-heading">
					<?php if (isset($this->item->avatars)): ?>
					<a href="" class="see_main_pic"> Voir l'image</a><br>
					<a href="" class="see_main_pic_thumb"> Voir l'image thumb</a><br>
                    <?php endif;?>
					<h4><?php echo JText::_('PAPIERSDEFAMILLES_FIELD_MAIN_PIC') ?></h4>
				</div>
				<div class="clearfix"></div>
				<div id="myDropZoneMainPic" style="" class="dropzone clsbox"></div>
			</div>

			<div class="clearfix"></div>

			<!-- Add pdf -->
			<div class="drag_drop_zone_pdf">
				<div class="control-group-heading">
					<h4><?php echo JText::_('PAPIERSDEFAMILLES_FIELD_ADD_PDF') ?></h4>
				</div>
				<div class="clearfix"></div>
				<div id="myDropZonePDF" style="" class="dropzone clsbox"></div>
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
$document->addScript($baseAdmin . '/js/dropzone.js');
$document->addStyleSheet($baseAdmin . '/js/dropzone.css');
$document->addStyleSheet($baseAdmin . '/js/basic.min.css');

$document->addScript($baseAdmin . '/js/jquery.fullscreenslides.js');
$document->addStyleSheet($baseAdmin . '/js/fullscreenstyle.css');
?>

<script>
    jQuery(document).ready(function ($) {
        var locations = '<?php echo isset($this->item->locations) ? $this->item->locations : "" ?>';

        if (locations) {
            locations = $.parseJSON(locations);

            for (i = 0; i < locations.length; i++) {
                var location = locations[i];

                var regionId = location.region_id;

                var departementId = location.departement_id;
                var countryId = location.country_id;

                renderAjaxListRegion(i, regionId);
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

        jQuery(document).on('click', '.see_main_pic_thumb', function (e) {
            $('.wrapper-main-pic-thumb .image:first-child a').click();

            e.preventDefault();
            return false;
        });
        // All events are bound to this container element
        var $container = $('#fullscreenSlideshowContainer');

        $container
        //This is triggered once:
            .bind("init", function () {
                // The slideshow does not provide its own UI, so add your own
                // check the fullscreenstyle.css for corresponding styles
                $container
                    .append('<div class="ui" id="fs-close">&times;</div>')
                    .append('<div class="ui" id="fs-loader">Loading...</div>')
                    .append('<div class="ui" id="fs-prev">&lt;</div>')
                    .append('<div class="ui" id="fs-next">&gt;</div>')
                    .append('<div class="ui" id="fs-caption"><span></span></div>');

                // Bind to the ui elements and trigger slideshow events
                $('#fs-prev').click(function () {
                    // You can trigger the transition to the previous slide
                    $container.trigger("prevSlide");
                });
                $('#fs-next').click(function () {
                    // You can trigger the transition to the next slide
                    $container.trigger("nextSlide");
                });
                $('#fs-close').click(function () {
                    // You can close the slide show like this:
                    $container.trigger("close");
                });

            })
            // When a slide starts to load this is called
            .bind("startLoading", function () {
                // show spinner
                $('#fs-loader').show();
            })
            // When a slide stops to load this is called:
            .bind("stopLoading", function () {
                // hide spinner
                $('#fs-loader').hide();
            })
            // When a slide is shown this is called.
            // The "loading" events are triggered only once per slide.
            // The "start" and "end" events are called every time.
            // Notice the "slide" argument:
            .bind("startOfSlide", function (event, slide) {
                // set and show caption
                $('#fs-caption span').text(slide.title);
                $('#fs-caption').show();
            })
            // before a slide is hidden this is called:
            .bind("endOfSlide", function (event, slide) {
                $('#fs-caption').hide();
            });

        function isValidDate(dateString) {
            var regEx = /^\d{4}-\d{2}-\d{2}$/;
            return dateString.match(regEx) != null;
        }

        var tmpDate = $('#jform_birthday').val();

        if (isValidDate(tmpDate)) {
            // convert date
            var tmpDate = $('#jform_birthday').val();
            var neeDate = tmpDate.split("-").reverse().join("-");
            $('#jform_birthday').val(neeDate);
        }


        $('#jform_num_id').attr('readonly', 'true');

        Dropzone.autoDiscover = false;

        Joomla.submitbutton = function (task) {
            // disabled all button
            $('button').attr("onclick", "").unbind("click");
            if (task == 'document.cancel') {
                Joomla.submitform(task);
            } else {
             	if (myDropZonePDF.files.length && myDropZoneMainPic.files.length && myDropZonePDF.files[0].status == 'queued' && myDropZoneMainPic.files[0].status == 'queued') {
                        myDropZonePDF.processQueue();

                        myDropZonePDF.on("complete", function (file) {
                            myDropZoneMainPic.processQueue();

                            myDropZoneMainPic.on("complete", function (file) {
                                Joomla.submitform(task);
                                return false;
                            });
                        });
                }
                else if (myDropZonePDF.files.length && myDropZonePDF.files[0].status == 'queued') {
                        myDropZonePDF.processQueue();

                        myDropZonePDF.on("complete", function (file) {
                            Joomla.submitform(task);
                            return false;
                        });
                }
                else if (myDropZoneMainPic.files.length && myDropZoneMainPic.files[0].status == 'queued') {
                        myDropZoneMainPic.processQueue();

                        myDropZoneMainPic.on("complete", function (file) {
                            Joomla.submitform(task);
                            return false;
                        });
                }
            }
        }

        var avatar_images = '<?php echo $this->item->avatars?>';
        var tmp_avatar_path = '<?php echo json_decode($this->item->main_pic)?>';

        if (!(tmp_avatar_path)) {
            avatar_path = "<?php echo JUri::root()?>" + "images_documents";
            tmp_avatar_path = "images_documents";
        } else {
            avatar_path = "<?php echo JUri::root()?>" + tmp_avatar_path;
        }

        $("div#myDropZoneMainPic").dropzone({
            url: '<?php echo JUri::root()?>' + "endpoint.php",
            maxFiles: 1,
            maxFilesize: 1,
            acceptedFiles: '.jpg, .jpeg',
            autoProcessQueue: false,
            addRemoveLinks: true,
            dictRemoveFile: '<?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_REMOVE_FILE')?>',
            dictRemoveFileConfirmation: '<?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_ARE_YOU_SURE')?>',
            dictDefaultMessage: "<img class='add_new avatar' src='" + '<?php echo JUri::root()?>' + "images/extrabutton_2.png'><img class='add_more avatar' src='" + "<?php echo JUri::root()?>" + "images/extrabutton_2.png'><span class='add_new avatar'>" + Joomla.JText._('PAPIERSDEFAMILLES_TEXT_DRAG_DROP_IMAGE') + "</span>",
            init: function () {
                myDropZoneMainPic = this;

                // Load File
                var arr_images = jQuery.parseJSON(avatar_images);

                if (arr_images)
                {
                    var mockFile = {name: arr_images, type: 'image/*', accepted: 'true', status: "success"};

                    this.options.addedfile.call(this, mockFile);
                    this.options.thumbnail.call(this, mockFile, avatar_path + '/' + arr_images);
                    myDropZoneMainPic.files.push(mockFile);
                }

                this.on( "addedfile", function() { // event triggered when a file is added to the Dropzone
                    if ( this.files[1] != null ){ // we check to see if we have added a file to the files array
                        this.removeFile( this.files[0] ); // remove the existing file from the files array
                    }
                });

                // Delete File
                this.on("removedfile", function(file, responseText) {
                    // Remove origin
                    jQuery.ajax({
                        type: "POST",
                        data: {
                            filename: file.name,
                            filepath: tmp_avatar_path
                        },
                        url: '<?php echo JUri::root()?>' + "endpoint_delete.php",
                        success: function(response) {
                            //console.log(response);
                        }
                    });

                    // Remove thumb
                    jQuery.ajax({
                        type: "POST",
                        data: {
                            filename: file.name,
                            filepath: tmp_avatar_path + '/thumb'
                        },
                        url: '<?php echo JUri::root()?>' + "endpoint_delete.php",
                        success: function(response) {
                            //console.log(response);
                        }
                    });
                });

                // After success append to input hidden for move to new folder
                this.on("success", function(file, responseText) {
                    var html = '<input type="hidden" name="avatar_images[]" value=' + responseText + '>';
                    $('.drag_drop_zone_main_pic').append(html);
                    myDropZoneMainPic.options.autoProcessQueue = true;
                });
            }
        });

        var pdf_files = '<?php echo $this->item->pdfFiles?>';
        var tmp_pdf_path = '<?php echo json_decode($this->item->gallery_pic)?>';

        if (!(tmp_pdf_path)) {
            pdf_path = "<?php echo JUri::root()?>" + "images_documents";
            tmp_pdf_path = "images_documents";
        } else {
            pdf_path = "<?php echo JUri::root()?>" + tmp_pdf_path + '/pdf';
        }

		// DropZonePDF
        $("div#myDropZonePDF").dropzone({
            url: '<?php echo JUri::root()?>' + "endpoint.php",
            maxFiles: 1,
            maxFilesize: 5,
            acceptedFiles: '.pdf',
            autoProcessQueue: false,
            addRemoveLinks: true,
            dictRemoveFile: '<?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_REMOVE_FILE')?>',
            dictRemoveFileConfirmation: '<?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_ARE_YOU_SURE')?>',
            dictDefaultMessage: "<img class='add_new avatar' src='" + '<?php echo JUri::root()?>' + "images/extrabutton_2.png'><img class='add_more avatar' src='" + "<?php echo JUri::root()?>" + "images/extrabutton_2.png'><span class='add_new avatar'>" + Joomla.JText._('PAPIERSDEFAMILLES_TEXT_DRAG_DROP_IMAGE') + "</span>",
            init: function () {
                myDropZonePDF = this;

                // Load File
                var pdf_file = jQuery.parseJSON(pdf_files);

                if (pdf_file)
                {
                    var mockFile = {name: pdf_file, type: 'image/*', accepted: 'true', status: "success"};

                    this.options.addedfile.call(this, mockFile);
                    this.options.thumbnail.call(this, mockFile, "<?php echo JUri::root()?>" + 'images' + '/' + 'pdf.png');
                    myDropZonePDF.files.push(mockFile);
                }

                this.on( "addedfile", function() { // event triggered when a file is added to the Dropzone
                    if ( this.files[1] != null ){ // we check to see if we have added a file to the files array
                        this.removeFile( this.files[0] ); // remove the existing file from the files array
                    }
                });

                // Delete File
               this.on("removedfile", function(file, responseText) {
                    // Remove origin
                    jQuery.ajax({
                        type: "POST",
                        data: {
                            filename: file.name,
                            filepath: tmp_pdf_path
                        },
                        url: '<?php echo JUri::root()?>' + "endpoint_delete.php",
                        success: function(response) {
                            //console.log(response);
                        }
                    });
                });

                // After success append to input hidden for move to new folder
                this.on("success", function(file, responseText) {
                    var html = '<input type="hidden" name="pdf_file[]" value=' + responseText + '>';
                    $('.drag_drop_zone_pdf').append(html);
                    myDropZonePDF.options.autoProcessQueue = true;
                });
            }
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