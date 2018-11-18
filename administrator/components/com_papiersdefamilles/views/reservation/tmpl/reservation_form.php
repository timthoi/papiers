<?php
/**
* @version		
* @package		Papiersdefamilles
* @subpackage	Reservations
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

JHtml::_('behavior.calendar')
?>

<?php $fieldSet = $this->form->getFieldset('reservation.form');?>
<fieldset class="fieldsform form-horizontal">

	<?php
	// joomla user id
	$field = $fieldSet['jform_joomla_user_id'];
	$field->jdomOptions = array(
		'list' => $this->lists['fk']['user_id']
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
	// subscriptionplan
	$field = $fieldSet['jform_subscriptionplan_id'];
	$field->jdomOptions = array(
		'list' => $this->lists['fk']['subscriptionplan_id']
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
	// subscriptionplant price
	$field = $fieldSet['jform_subscriptionplan_price'];
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
	// price total
	$field = $fieldSet['jform_price_total'];
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
	// Discount
	$field = $fieldSet['jform_discount'];
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
	// Surname
	$field = $fieldSet['jform_surname'];
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
	// Phone
	$field = $fieldSet['jform_phone'];
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
	// Address
	$field = $fieldSet['jform_address'];
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
	// Zip Code
	$field = $fieldSet['jform_zip_code'];
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
	$field = $fieldSet['jform_city'];
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
	// Email
	$field = $fieldSet['jform_email'];
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
	// Birthday
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
	// Paypal
	$field = $fieldSet['jform_is_paypal'];
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
	// Paypal Refund
	$field = $fieldSet['jform_is_paypal_refund'];
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
	// Payment Status
	$field = $fieldSet['jform_payment_status'];
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

<!-- Choose cities and disitrts -->
<script type="text/javascript">
jQuery(document).ready(function ($) {
	/*var initCalendar = function()
	{
		var id = $(this).attr('jform_birthday');

        Calendar.setup({
            // Id of the input field
            inputField: id,
            // Format of the input field
            ifFormat: "%Y-%m-%d",
            // Trigger for the calendar (button ID)
            button: "jform_birthday-btn",
            // Alignment (defaults to "Bl")
            align: "Tl",
            singleClick: true,
            firstDay: 1
        });
	};*/
	
      /*window.addEvent('domready', function() {Calendar.setup({

			inputField: "jform_birthday",

			ifFormat: "%Y/%m/%d",	// Trigger for the calendar (button ID)

			button: "jform_birthday-btn",

			align: "B2",

			singleClick: true,firstDay: 0

		});});*/

})
</script>