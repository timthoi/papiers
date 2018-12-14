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

?>
<fieldset class="fieldsform form-horizontal">
	<div class="row-fluid">
		<div class="span4">
			<div class="drag_drop_zone_2">
				<div class="control-group-heading">
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