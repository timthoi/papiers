<?php
/**
* @version		
* @package		Papiersdefamilles
* @subpackage	coupons
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

<?php $fieldSet = $this->form->getFieldset('coupon.form');?>
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
	// Value
	$field = $fieldSet['jform_value'];
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
	// Type
	$field = $fieldSet['jform_type'];
	$field->jdomOptions = array(
		'list' => PapiersdefamillesHelperEnum::_('coupon_type')
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