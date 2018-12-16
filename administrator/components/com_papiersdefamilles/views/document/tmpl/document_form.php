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


if (!$this->form)
	return;

$fieldSets = $this->form->getFieldsets();

JText::script('PAPIERSDEFAMILLES_TEXT_REMOVE_FILE');
JText::script('PAPIERSDEFAMILLES_TEXT_ARE_YOU_SURE');
JText::script('PAPIERSDEFAMILLES_TEXT_DRAG_DROP_IMAGE');
JText::script('PAPIERSDEFAMILLES_ERROR_DUPLICATE');

?>

<?php $fieldSet = $this->form->getFieldset('document.form');
$pathGalleries = json_decode($this->item->gallery_pic);
$galleries = json_decode($this->item->galleries);

$pathMainPics = json_decode($this->item->main_pic);
$mainPic = json_decode($this->item->avatars);
?>
<fieldset class="fieldsform form-horizontal">

	<div class="wrapper-main-pic">
        <?php
        $srcPic = JUri::root() . $pathMainPics . '/' . $mainPic;
        ?>
		<div class="image" style="display: none">
			<a rel="gallery" title="" href="<?php echo $srcPic?>">
				<img src="<?php echo $srcPic?>">
			</a>
		</div>

	</div>

	<div class="wrapper-gallery-pic">
		<?php foreach ($galleries as $pic):
			$srcPic = JUri::root() . $pathGalleries . '/' . $pic;
        ?>
		<div class="image" style="display: none">
			<a rel="gallery" title="" href="<?php echo $srcPic?>">
				<img src="<?php echo $srcPic?>">
			</a>
		</div>
        <?php endforeach;?>
	</div>


	<div class="row-fluid">
		<div class="span4">
			<div class="drag_drop_zone_2">
				<div class="control-group-heading">
					<a href="" class="see_gallery_pic">view pic</a><br>
					<h4><?php echo JText::_('PAPIERSDEFAMILLES_FIELD_MAIN_PIC')?></h4>
				</div>
				<div class="clearfix"></div>
				<div id="myDropZone2" style="" class="dropzone clsbox"></div>
			</div>

			<div class="clearfix"></div>

			<div class="drag_drop_zone">
				<div class="control-group-heading">
					<h4><?php echo JText::_('PAPIERSDEFAMILLES_FIELD_GALLERY_PIC')?></h4>
				</div>
				<div class="clearfix"></div>
				<div id="myDropZone" style="" class="dropzone clsbox"></div>
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
            // traceability
            $field = $fieldSet['jform_traceability'];
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
					<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
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
                    $field = $fieldSet['jform_format_document'];
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
                    // number_of_pages
                    $field = $fieldSet['jform_number_of_pages'];
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
			</div>

            <?php
            // description
            $field = $fieldSet['jform_description'];
            ?>
			<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>" style="display: none">

                    <?php echo $field->label; ?>

                    <?php echo $field->input; ?>
				</div>
			</div>
            <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>

			<div class="field-location">
				<fieldset class="main_locations ">
					<div class="control-group-heading">
						<h2><?php echo JText::_('PAPIERSDEFAMILLES_LAYOUT_LOCATIONS')?></h2>
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

                <?php echo (PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>
			</div>

			<div class="field-location">
				<fieldset class="main_persons">
					<div class="control-group-heading">
						<h2><?php echo JText::_('PAPIERSDEFAMILLES_FIELD_MAIN_PERSONS')?></h2>
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
                    <?php echo (PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>


				</fieldset>
			</div>

			<div class="field-location">
				<fieldset class="secondary_persons">
					<div class="control-group-heading">
						<h2><?php echo JText::_('PAPIERSDEFAMILLES_LAYOUT_SECONDARY_PERSONS')?></h2>
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


            <?php
            // is sale
            $field = $fieldSet['jform_is_sale'];
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
            <?php if (!method_exists($field, 'canView') || $field->canView()): ?>
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
	<?php echo (PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>

</fieldset>

<?php
$baseAdmin = JURI::root(true).'/administrator/components/' . COM_PAPIERSDEFAMILLES;
$document = JFactory::getDocument();
$document->addScript($baseAdmin . '/js/dropzone.js');
$document->addStyleSheet($baseAdmin . '/js/dropzone.css');
$document->addStyleSheet($baseAdmin . '/js/basic.min.css');

$document->addScript($baseAdmin . '/js/jquery.fullscreenslides.js');
$document->addStyleSheet($baseAdmin . '/js/fullscreenstyle.css');
?>
<style>
	.field-location {
		padding: 0 40px;
		border:2px solid #ccc;
		-moz-border-radius:8px;
		-webkit-border-radius:8px;
		border-radius:8px;
		margin-bottom: 20px;
	}
</style>

<script>

    jQuery(document).ready(function($){
        $('.image img').fullscreenslides();
        jQuery(document).on('click', '.see_gallery_pic', function(e) {
			$('.wrapper-main-pic .image:first-child a').click();

            e.preventDefault();
            return false;
        });
        // All events are bound to this container element
        var $container = $('#fullscreenSlideshowContainer');

        $container
        //This is triggered once:
            .bind("init", function() {
                // The slideshow does not provide its own UI, so add your own
                // check the fullscreenstyle.css for corresponding styles
                $container
                    .append('<div class="ui" id="fs-close">&times;</div>')
                    .append('<div class="ui" id="fs-loader">Loading...</div>')
                    .append('<div class="ui" id="fs-prev">&lt;</div>')
                    .append('<div class="ui" id="fs-next">&gt;</div>')
                    .append('<div class="ui" id="fs-caption"><span></span></div>');

                // Bind to the ui elements and trigger slideshow events
                $('#fs-prev').click(function(){
                    // You can trigger the transition to the previous slide
                    $container.trigger("prevSlide");
                });
                $('#fs-next').click(function(){
                    // You can trigger the transition to the next slide
                    $container.trigger("nextSlide");
                });
                $('#fs-close').click(function(){
                    // You can close the slide show like this:
                    $container.trigger("close");
                });

            })
            // When a slide starts to load this is called
            .bind("startLoading", function() {
                // show spinner
                $('#fs-loader').show();
            })
            // When a slide stops to load this is called:
            .bind("stopLoading", function() {
                // hide spinner
                $('#fs-loader').hide();
            })
            // When a slide is shown this is called.
            // The "loading" events are triggered only once per slide.
            // The "start" and "end" events are called every time.
            // Notice the "slide" argument:
            .bind("startOfSlide", function(event, slide) {
                // set and show caption
                $('#fs-caption span').text(slide.title);
                $('#fs-caption').show();
            })
            // before a slide is hidden this is called:
            .bind("endOfSlide", function(event, slide) {
                $('#fs-caption').hide();
            });

        function isValidDate(dateString) {
            var regEx = /^\d{4}-\d{2}-\d{2}$/;
            return dateString.match(regEx) != null;
        }
        var tmpDate= $('#jform_birthday').val();

        if (isValidDate(tmpDate)) {
            // convert date
            var tmpDate= $('#jform_birthday').val();
            var neeDate = tmpDate.split("-").reverse().join("-");
            $('#jform_birthday').val(neeDate);
		}


        $('#jform_num_id').attr('readonly', 'true');

        Dropzone.autoDiscover = false;

        Joomla.submitbutton = function(task){
            var myDropzone = Dropzone.forElement("div#myDropZone2");
            myDropzone.processQueue();

            setTimeout(function(){
                Joomla.submitform(task);
            }, 2000);
        }

        var gallery_images = '<?php echo $this->item->galleries?>';
        var tmp_gallery_path = '<?php echo json_decode($this->item->gallery_pic)?>';

        if (!(tmp_gallery_path))
        {
            gallery_path = "<?php echo JUri::root()?>" + "images";
            tmp_gallery_path = "images";
        }
        else
        {
            gallery_path = "<?php echo JUri::root()?>" + tmp_gallery_path;
        }

        $("div#myDropZone").dropzone({
            url : '<?php echo JUri::root()?>' + "endpoint.php",
            addRemoveLinks: true,
            dictRemoveFile: '<?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_REMOVE_FILE')?>',
            dictRemoveFileConfirmation: '<?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_ARE_YOU_SURE')?>',
            dictDefaultMessage: "<img class='add_new' src='" + '<?php echo JUri::root()?>' + "images/extrabutton.png'><img class='add_more' src='" + "<?php echo JUri::root()?>" + "images/extrabutton.png'><span class='add_new'>" + Joomla.JText._('PAPIERSDEFAMILLES_TEXT_DRAG_DROP_IMAGE') + "</span>",
            init: function() {
                // Load File
                var arr_images = jQuery.parseJSON(gallery_images);
                var imgDropzone = Dropzone.forElement("div#myDropZone");

                if (arr_images)
                {
                    for(var i=0; i < arr_images.length; i++)
                    {
                        var mockFile = { name: arr_images[i], type: 'image/jpeg' };

                        imgDropzone.emit("addedfile", mockFile);
                        this.options.thumbnail.call(this, mockFile, gallery_path + '/' + arr_images[i]);
                    }
                }

                // Delete File
                this.on("removedfile", function(file, responseText) {
                    jQuery.ajax({
                        type: "POST",
                        data: {
                            filename: file.name,
                            filepath: tmp_gallery_path
                        },
                        url: '<?php echo JUri::root()?>' + "endpoint_delete.php",
                        success: function(response) {
                            // console.log(response);
                        }
                    });
                });

                // After success append to input hidden for move to new folder
                this.on("success", function(file, responseText) {
                    var html = '<input type="hidden" name="gallery_images[]" value="' + responseText + '">';
                    $('.drag_drop_zone').append(html);
                });
            }
        });

        var avatar_images = '<?php echo $this->item->avatars?>';
        var tmp_avatar_path = '<?php echo json_decode($this->item->main_pic)?>';

        if (!(tmp_avatar_path))
        {
            avatar_path = "<?php echo JUri::root()?>" + "images";
            tmp_avatar_path = "images";
        }
        else
        {
            avatar_path = "<?php echo JUri::root()?>" + tmp_avatar_path;
        }

        $("div#myDropZone2").dropzone({
            url : '<?php echo JUri::root()?>' + "endpoint.php",
            maxFiles:1,
            autoProcessQueue: false,
            addRemoveLinks: true,
            dictRemoveFile: '<?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_REMOVE_FILE')?>',
            dictRemoveFileConfirmation: '<?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_ARE_YOU_SURE')?>',
            dictDefaultMessage: "<img class='add_new avatar' src='" + '<?php echo JUri::root()?>' + "images/extrabutton_2.png'><img class='add_more avatar' src='" + "<?php echo JUri::root()?>" + "images/extrabutton_2.png'><span class='add_new avatar'>" + Joomla.JText._('PAPIERSDEFAMILLES_TEXT_DRAG_DROP_IMAGE') + "</span>",
            init: function() {
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
                // Load File
                var arr_images = '';
                if (avatar_images)
                {
                    var arr_images = jQuery.parseJSON(avatar_images);
                }

                if (arr_images)
                {
                    var mockFile = { name: arr_images, type: 'image/jpeg' };
                    this.addFile.call(this, mockFile);
                    if (avatar_path != 'images')
                    {
                        this.options.thumbnail.call(this, mockFile, avatar_path + '/' + arr_images);
                    }
                }

                // Delete File
                this.on("removedfile", function(file, responseText) {
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
                });

                // After success appedn to input hidden for move to new folder
                this.on("success", function(file, responseText) {
                    var html = '<input type="hidden" name="avatar_images[]" value="' + responseText + '">';
                    $('.drag_drop_zone_2').append(html);
                });
            }
        });
    });
</script>