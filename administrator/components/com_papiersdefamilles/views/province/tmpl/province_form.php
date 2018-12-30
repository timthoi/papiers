<?php
/**
* @version		
* @package		Papiersdefamilles
* @subpackage	Provinces
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
?>

<?php $fieldSet = $this->form->getFieldset('province.form');?>
<fieldset class="fieldsform form-horizontal">

	<?php
	// Name
	$field = $fieldSet['jform_name'];
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
	// Alias
	$field = $fieldSet['jform_alias'];
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
    // Note
    $field = $fieldSet['jform_note'];
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
    // Description
    $field = $fieldSet['jform_description'];
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
?>

<!-- Choose provinces and disitrts -->
<script type="text/javascript">
jQuery(document).ready(function ($) {
	var continentId = <?php echo $continentId?>;

	if (continentId)
	{
		var continentId = <?php echo $continentId?>;
		generateSelectCountries(continentId);
	}


	$("#jform_continent_id").chosen().change(function(event){
		var continentId = $(this).chosen().val();
		
		if (continentId != "")
		{
            generateSelectCountries(continentId);
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
        		var list_countries = $.parseJSON(response);

				for (i = 0; i < list_countries.length; i++)
				{
					if (list_countries[i].continent_id == continentId)
						$("#jform_country_id").append("<option selected value='" + list_countries[i].id + "'>" + list_countries[i].name + "</option>");
					else
						$("#jform_country_id").append("<option value='" + list_countries[i].id + "'>" + list_countries[i].name + "</option>");
            	}

            	$("#jform_country_id").trigger("liszt:updated");
            	
            }
        });
    }

})
</script>