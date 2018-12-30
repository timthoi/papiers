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

$array_image = $this->item->galleries;
?>

<?php $fieldSet = $this->form->getFieldset('reservation.form');?>

<div class="">

    <!-- Step1 -->

    <!-- Gallery -->
    <div class="gallery">
        <div class="row">
        <div class="">
        <div class="slider ">
	        <?php if (!empty($this->item->main_pic)):?>
                <div class="">
                    <div class="background-img-hover" style="background-image: url(<?php echo PapiersdefamillesHelper::getAvatarImage($this->item->main_pic)?>);">
                        <img src="<?php echo PapiersdefamillesHelper::getAvatarImage($this->item->main_pic)?>" alt="<?php echo $this->ticketDetail->_city_id_name;?>" />
                    </div>
                </div>
	        <?php endif;?>
            <?php if (!empty($array_image)):?>
                <?php foreach ($array_image as $key => $image):?>
                    <div class="">
                        <div class="background-img-hover" style="background-image: url(<?php echo JUri::root() . $this->item->gallery . '/' . $image?>);">
                            <img src="<?php echo JUri::root() . $this->item->gallery . '/' . $image?>" id="img-<?php echo $key; ?> alt="<?php echo $image;?>" />
                        </div>
                    </div>
                <?php endforeach;?>
            <?php endif;?>
        </div>
        </div>




        </div>
    </div>
    <!-- End Gallery -->

    <!-- Title -->
    <div class="description">
        <div class="row">
            <div class="span8">
                <p class="city"><?php echo $this->ticketDetail->_city_id_name?></p>
                <p class="long-presentation"><?php echo Jtext::sprintf('PAPIERSDEFAMILLES_TEXT_LOWEST_PRICE_2', $this->ticketPriceArray['lowest_price']['price'], $this->ticketPriceArray['lowest_price']['month'])?></p>
            </div>

            <div class="span4 heart-position">
                <i style="" class="icon-time"></i>
                <p class="heart"><?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_1')?></p>
                <i style="" class="icon-heart-empty"></i>
            </div>
        </div>
    </div>
    <!-- End Title -->

    <!-- Form + Pricelist -->
    <div class="fieldsform form-horizontal destination">

            <div class="row">
                <div class="span6">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#description" class="btt-tab-description"><?php echo JText::_('PAPIERSDEFAMILLES_TEXT_DESCRIPTION')?></a></li>
                        <li class=""><a data-toggle="tab" href="#detail" class="btt-tab-detail"><?php echo JText::_('PAPIERSDEFAMILLES_TEXT_DETAIL')?></a></li>
                    </ul>

                    <div class="tab-content">
                        <!-- Description -->
                        <div class="tab-pane fade in active" id="description">
                            <p class="long-presentation"><?php echo $this->ticketDetail->long_presentation?></p>
                        </div>

                        <!-- Detail -->
                        <div class="tab-pane fade" id="detail">
                            <p class="long-presentation bg-blue"><?php echo Jtext::sprintf('PAPIERSDEFAMILLES_TEXT_LOWEST_PRICE', $this->ticketPriceArray['lowest_price']['month'], $this->ticketPriceArray['lowest_price']['price'])?></p>
                            <p class="long-presentation bg-blue"><?php echo Jtext::sprintf('PAPIERSDEFAMILLES_TEXT_HIGHEST_PRICE', $this->ticketPriceArray['highest_price']['month'], $this->ticketPriceArray['highest_price']['price'])?></p>
                            <p class="long-presentation bg-blue"><?php echo Jtext::sprintf('PAPIERSDEFAMILLES_TEXT_AVERAGE_PRICE', $this->ticketPriceArray['average_price'])?></p>
                        </div>
                    </div>
                </div>


                <div class="span6">
                    <h4 class="header bg-blue"><?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_HEADER_RESERVATION_2')?></h4>
                    <?php
                    // Departure City
                    $field = $fieldSet['jform_departure_city_id'];
                    $field->jdomOptions = array(
                        'list' => $this->lists['fk']['departure_city_id']
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
	                // Departure Date
	                $field = $fieldSet['jform_type_flight'];
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
                    // Departure Date
                    $field = $fieldSet['jform_departure_date'];
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
                    // Return Date
                    $field = $fieldSet['jform_arrival_date'];
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
                    // Number Adult Ticket
                    $field = $fieldSet['jform_number_adult_ticket'];
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

                    <!--
                    <?php
                    // Number Childrent Ticket 1 > 12
                    $field = $fieldSet['jform_number_childrent_ticket_1'];
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
                    -->

                    <?php
                    // Number Childrent Ticket 2 < 12
                    $field = $fieldSet['jform_number_childrent_ticket_2'];
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

                    <input type="hidden" id="jform_ticket_type_id" name="jform[ticket_type_id]"  style="display: none;" value="<?php echo $this->tickettypeId?>">
                </div>

                <!-- Toolbar -->
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar" >
                    <button class="btn btn-small button-save button-step1"><?php echo JText::_('PAPIERSDEFAMILLES_TEXT_NEXT')?></button>
                </div>
            </div>
        </div>

    <!-- End Step1 -->
</div>
