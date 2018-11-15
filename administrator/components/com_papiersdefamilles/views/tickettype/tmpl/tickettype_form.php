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

<?php $fieldSet = $this->form->getFieldset('tickettype.form');?>
<fieldset class="fieldsform form-horizontal">
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
	// Num ID
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
	// Destination
	$field = $fieldSet['jform_destination'];
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
	// continent
	$field = $fieldSet['jform_continent_id'];
	$field->jdomOptions = array(
		'list' => $this->lists['fk']['continent_id']
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



	<?php
	// Country
	$field = $fieldSet['jform_country_id'];
	$field->jdomOptions = array(
		'list' => $this->lists['fk']['country_id']
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

	<?php
	// City
	$field = $fieldSet['jform_city_id'];
	$field->jdomOptions = array(
		'list' => $this->lists['fk']['city_id']
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



	<?php	
	// Price list
	$field = $fieldSet['jform_pricelist'];
	
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


	<?php
	// Short Presentation
	$field = $fieldSet['jform_short_presentation'];
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
	// Long Presentation
	$field = $fieldSet['jform_long_presentation'];
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
	
	<?php
	// Is Online
	$field = $fieldSet['jform_is_online'];
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
	// Is Online Quote
	$field = $fieldSet['jform_is_online_quote'];
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
	// Is Good Plan
	$field = $fieldSet['jform_is_good_plan'];
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
	// Insurance Rate
	$field = $fieldSet['jform_insurance_rate'];
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
	// Lowest Price
	$field = $fieldSet['jform_lowest_price'];
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
	// Luggage Refund Rate Grid
	$field = $fieldSet['jform_luggage_refund_rate_grid'];
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

</fieldset>
<?php

$continentId = 0;

if (isset($this->item->continent_id))
{
	$continentId = $this->item->continent_id;
}

$countryId = 0;

if (isset($this->item->country_id))
{
	$countryId = $this->item->country_id;
}

$cityId = 0;

if (isset($this->item->city_id))
{
	$cityId = $this->item->city_id;
}
?>

<?php 
$baseAdmin = JURI::root(true).'/administrator/components/' . com_papiersdefamilles;
$document = JFactory::getDocument();
$document->addScript($baseAdmin . '/js/dropzone.js');
$document->addStyleSheet($baseAdmin . '/js/dropzone.css');
$document->addStyleSheet($baseAdmin . '/js/basic.min.css');

?>

<!-- Choose cities and disitrts -->
<script type="text/javascript">
jQuery(document).ready(function ($) {
	var continentId = <?php echo $continentId?>;
	var countryId = <?php echo $countryId?>;
	var cityId = <?php echo $cityId?>;


	if (continentId && countryId && cityId)
	{
		generateSelectCountries(continentId);

		setTimeout(function(){
		    generateSelectCities(continentId, countryId);
		}, 1000);
		
	}


	$("#jform_continent_id").chosen().change(function(event){
		var continentId = $(this).chosen().val();
		
		if (continentId != "")
		{
            generateSelectCountries(continentId);
        }
	})

	$("#jform_country_id").chosen().change(function(event){
		var countryId = $(this).chosen().val();
		var continentId = $("#jform_continent_id").val();
		
		if (countryId != "" && continentId != "")
		{
            generateSelectCities(continentId, countryId);
        }
	})

    function generateSelectCountries(continentId)
    {
        jQuery.ajax({
            type: "POST",
            data: {
                'continent_id': continentId
            },

            url: window.location.protocol + "//" + window.location.host + window.location.pathname + '?option=com_papiersdefamilles&task=continents.ajaxGetListCountries',

            success: function(response) {
        		$('#jform_country_id option').not(':first').remove();
        		$('#jform_city_id option').not(':first').remove();
        		var list_countries = $.parseJSON(response);

				for (i = 0; i < list_countries.length; i++)
				{
					if (list_countries[i].id == countryId)
						$("#jform_country_id").append("<option selected value='" + list_countries[i].id + "'>" + list_countries[i].name + "</option>");
					else
						$("#jform_country_id").append("<option value='" + list_countries[i].id + "'>" + list_countries[i].name + "</option>");
            	}

            	$("#jform_country_id").trigger("liszt:updated");
            	$("#jform_city_id").trigger("liszt:updated");
            	
            }
        });
    }

    function generateSelectCities(continentId, countryId)
    {
        jQuery.ajax({
            type: "POST",
            data: {
                'country_id': countryId,
                'continent_id': continentId
            },

            url: window.location.protocol + "//" + window.location.host + window.location.pathname + '?option=com_papiersdefamilles&task=continents.ajaxGetListCities',

            success: function(response) {
        		$('#jform_city_id option').not(':first').remove();
        		var list_cities = $.parseJSON(response);
        		console.log(list_cities);

				for (i = 0; i < list_cities.length; i++)
				{
					if (list_cities[i].id == cityId)
						$("#jform_city_id").append("<option selected value='" + list_cities[i].id + "'>" + list_cities[i].name + "</option>");
					else
						$("#jform_city_id").append("<option value='" + list_cities[i].id + "'>" + list_cities[i].name + "</option>");
            	}

            	$("#jform_city_id").trigger("liszt:updated");
            	
            }
        });
    }

})
</script>

<script>
	jQuery(document).ready(function($){
		$('#jform_num_id').attr('readonly', 'true');

		Dropzone.autoDiscover = false;
		
	 	Joomla.submitbutton = function(task){
	        var myDropzone = Dropzone.forElement("div#myDropZone2");
			myDropzone.processQueue();
			
            var pricelistArray = [[]];
            var tr_index = 0;
            var flag_validate = true;

            $('tr.subform-repeatable-group').each(function() {
            	var departure_city_id 	= $(this).find("select[name$='[departure_city_id]']").val();
            	var month_id 			= $(this).find("select[name$='[month_id]']").val();
                var year_id 			= $(this).find("input[name$='[year]']").val();
                var type_flight 		= $(this).find("select[name$='[type_flight]']").val();

        		pricelistArray[tr_index] = [];
            	pricelistArray[tr_index].push(departure_city_id);
            	pricelistArray[tr_index].push(month_id);
                pricelistArray[tr_index].push(year_id);
                pricelistArray[tr_index].push(type_flight);

            	tr_index++;
            });

            console.log(pricelistArray);

            for(var i = 0; i < pricelistArray.length - 1; i++)
			{
				if (flag_validate)
				{
					for(var j = i + 1; j < pricelistArray.length; j++)
					{
						if (pricelistArray[i][0] == pricelistArray[j][0]
                            && pricelistArray[i][1] == pricelistArray[j][1]
                            && pricelistArray[i][2] == pricelistArray[j][2]
                            && flag_validate)
						{
						    if (pricelistArray[i][3] == pricelistArray[j][3])
                            {
                                flag_validate = false;

                                $('tr.subform-repeatable-group').eq(j).validationEngine('showPrompt', "<span>•</span> " + '<?php echo Jtext::_('PAPIERSDEFAMILLES_ERROR_DUPLICATE')?>', 'asdas',"bottomLeft",1);
                            }
						}
					}
				}
			}

            //console.log(pricelistArray);

            if (flag_validate)    
            {
            	setTimeout(function(){
		        	Joomla.submitform(task);
		      	}, 2000);
            }
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