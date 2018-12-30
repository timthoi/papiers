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

JHtml::_('behavior.calendar');
JHTML::_('behavior.modal');

$doc = JFactory::getDocument();
$token = JSession::getFormToken();
$item = $this->item;
?>

<?php $fieldSet = $this->form->getFieldset('reservation.form');?>

<div class="">
    <div class="fieldsform form-horizontal">
        <div class="row">
            <div class="span8">

                <div class="information-block information-main-adult">
                    <!-- Information Main adult -->

	                <?php
	                // Gender
	                $field = $fieldSet['jform_gender'];
	                ?>
                    <div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
                        <div class="control-label asterisk">
			                <?php echo $field->label; ?>
                        </div>

                        <div class="controls ">
			                <?php echo $field->input; ?>
                        </div>
                    </div>
	                <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>

			        <?php
			        // Name
			        $field = $fieldSet['jform_name'];
			        ?>
                    <div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
                        <div class="control-label asterisk">
					        <?php echo $field->label; ?>
                        </div>

                        <div class="controls ">
					        <?php echo $field->input; ?>
                        </div>
                    </div>
			        <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>



			        <?php
			        // Surname
			        $field = $fieldSet['jform_surname'];
			        ?>
                    <div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
                        <div class="control-label asterisk">
					        <?php echo $field->label; ?>
                        </div>

                        <div class="controls ">
					        <?php echo $field->input; ?>
                        </div>
                    </div>
			        <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>


	                <?php
	                // Address
	                $field = $fieldSet['jform_address'];
	                ?>
                    <div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
                        <div class="control-label asterisk">
			                <?php echo $field->label; ?>
                        </div>

                        <div class="controls ">
			                <?php echo $field->input; ?>
                        </div>
                    </div>
	                <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>


			        <?php
			        // Zip Code - City
			        ?>
                    <div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
                        <div class="control-label asterisk">
					        <?php echo JText::_('PAPIERSDEFAMILLES_TEXT_ZIP_CODE_CITY'); ?>
                        </div>

                        <div class="controls ">

					        <?php
					        // Zip Code
                            $field = $fieldSet['jform_zip_code'];
					        echo $field->input; ?>

					        <?php
					         // City
                             $field = $fieldSet['jform_city'];
					        echo $field->input; ?>
                        </div>
                    </div>
			        <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>

                    <?php
			        // Email - Telephone
			        ?>
                    <div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
                        <div class="control-label asterisk">
					        <?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_TELEPHONE_EMAIL'); ?>
                        </div>

                        <div class="controls ">
                            <?php
					        // Phone
	                        $field = $fieldSet['jform_phone'];
					        echo $field->input; ?>

					        <?php
					        // Email
			                $field = $fieldSet['jform_email'];
					        echo $field->input; ?>
                        </div>
                    </div>
			        <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>


			        <?php
			        // Birthday
			        $field = $fieldSet['jform_birthday'];
			        ?>
                    <div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
                        <div class="control-label asterisk">
					        <?php echo $field->label; ?>
                        </div>

                        <div class="controls ">
                            <input type="text" id="dayId"  style="width: 20px"/>
                            <input type="text" id="monthId"  style="width: 20px; margin-left: 10px"/>
                            <input type="text" id="yearId" style="width: 40px; margin-left: 10px"/>
                        </div>
                    </div>
                    <input type="hidden" id="jform_birthday" name="jform[birthday]" value="" class="">

                </div>
                <!-- End Information Main adult -->
                <div class="information-adult2">
                    <h3 class="title"><?php echo Jtext::_('PAPIERSDEFAMILLES_HEADER_SUB_PASSENGER_RESERVATION_INFORMATION')?></h3>
                    <!-- Information Adult 2 -->
		            <?php
		            // Information Adult
		            $field = $fieldSet['jform_information_adult'];
		            ?>
                    <div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">


                        <div class="controls">
				            <?php echo $field->input; ?>
                        </div>
                    </div>
		            <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>
                </div>

                <!-- End Information Adult 2 -->


                <!-- Information Children 2 -->

                <div class="information-children2">
                    <h3 class="title"><?php echo Jtext::_('PAPIERSDEFAMILLES_HEADER_CHILDREN_2_RESERVATION_INFORMATION')?></h3>
		            <?php
		            // Information Child 2
		            $field = $fieldSet['jform_information_child_2'];
		            ?>
                    <div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">

                        <div class="controls">
				            <?php echo $field->input; ?>
                        </div>
                    </div>
		            <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>
                </div>
            </div>
            <div class="span4">
                <div class="block green">
                    <?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_BLOCK_1')?>
                    <p><i><a class="modal modify" href="/papiersdefamilles/index.php?option=com_content&amp;view=article&amp;id=26&amp;amp=&amp;Itemid=101&amp;tmpl=component" rel="{handler: 'iframe', size: {x: 640, y: 480}}"><?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_BLOCK_1_LINK')?></a></i></p>
                </div>
                <div class="block orange"><?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_BLOCK_2')?></div>
                <div class="block blue"><?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_BLOCK_3')?></div>
            </div>


        </div>
</div>


    <!-- Toolbar -->
    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar" >

            <button class="btn btn-small button-cancel" onclick="Joomla.submitbutton('reservation.cancel');"><span class="icon-cancel" aria-hidden="true"></span><?php echo JText::_('PAPIERSDEFAMILLES_JTOOLBAR_CANCEL')?></button>

            <button class="btn btn-small button-save button-step2"><?php echo JText::_('PAPIERSDEFAMILLES_JTOOLBAR_SAVE')?></button>

    </div>
</div>
<!-- Choose cities and disitrts -->
<script type="text/javascript">
jQuery(document).ready(function ($) {
})
</script>
<style>
    /*table.adminlist.table-striped tr td:last-child,  table.adminlist.table-striped tr th:last-child{
        display: none;
    }*/
</style>
