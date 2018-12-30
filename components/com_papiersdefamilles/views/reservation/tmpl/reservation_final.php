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

$doc = JFactory::getDocument();
$token = JSession::getFormToken();
?>
<?php $fieldSet = $this->form->getFieldset('reservation.form');?>

<div class="final">
	<!-- insurance -->
	<div class="insurance">
		<h3><?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_INSURANCE')?></h3>

		<?php
		// Is Insurance
		$field = $fieldSet['jform_is_insurance'];
		?>
		<?php if ($this->ticketDetail->insurance_rate): ?>

            <div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
	            <?php echo $field->input; ?>

                <div class="panel-final-tab">
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#insurance_rate"><?php echo Jtext::sprintf('PAPIERSDEFAMILLES_TEXT_TICKET_INSURANCE_RATE', $this->ticketDetail->insurance_rate)?></a>
                                </h4>

                            </div>
                            <div id="insurance_rate" class="panel-collapse collapse">
                                <div class="panel-body"><?php echo JText::_('PAPIERSDEFAMILLES_TEXT_INSURANCE_RATE_BODY')?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		<?php endif; ?>
        <input type="hidden" name="jform[insurance_price]" value="<?php echo ($this->ticketDetail->insurance_rate) ? $this->ticketDetail->insurance_rate : 0?>"

		<?php
		// Is luggage_refund_rate_grid
		$field = $fieldSet['jform_is_baggage_insurance'];
		?>
		<?php if ($this->ticketDetail->luggage_refund_rate_grid): ?>
            <div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
	            <?php echo $field->input; ?>

                <div class="panel-final-tab">
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#baggage_insurance_price"><?php echo Jtext::sprintf('PAPIERSDEFAMILLES_TEXT_TICKET_LUGGAGE_REFUND_RATE_GRID', $this->ticketDetail->luggage_refund_rate_grid)?></a>
                                </h4>

                            </div>
                            <div id="baggage_insurance_price" class="panel-collapse collapse">
                                <div class="panel-body"><?php echo JText::_('PAPIERSDEFAMILLES_TEXT_BAGGAGE_INSURANCE_BODY')?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		<?php endif; ?>
        <input type="hidden" name="jform[baggage_insurance_price]" value="<?php echo ($this->ticketDetail->luggage_refund_rate_grid) ? $this->ticketDetail->luggage_refund_rate_grid : 0?>">


		<p style="margin-top: 20px"><?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_INSURANCE_DESC')?></p>
	</div>

	<!-- Summary table -->
	<div class="information-table">
        <div class="block-quote">
            <h3><?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_SUMMARY_INFORMATION')?></h3>
            <!-- Departure-->
            <div class="row">
                <div class="">
                    <div class="header-label">
                        <span><?php echo Jtext::_('PAPIERSDEFAMILLES_FIELD_DEPARTURE_DATE')?></span>
                        <span class="gaps date departure_date"></span>
                        <span class="gaps location departure_city"></span>
                        <span class="gaps">vers</span>
                        <span class="gaps location destination_city"></span>
                    </div>
                </div>
            </div>

            <!-- Arrival -->
            <div class="row">
                <div class="">
                    <div class="header-label">
                        <span><?php echo Jtext::_('PAPIERSDEFAMILLES_FIELD_ARRIVAL_DATE')?></span>
                        <span class="gaps date arrival_date"></span>
                        <span class="gaps location destination_city"></span>
                        <span class="gaps">vers</span>
                        <span class="gaps location departure_city"></span>
                    </div>
                </div>
            </div>

            <p class="note"><?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_FINAL_BILL_NOTE')?></p>

            <div class="row">
                <!-- Number People -->
                <div class="span6">
                    <p><?php echo Jtext::_('PAPIERSDEFAMILLES_FIELD_NUMBER_ADULT_TICKET')?>: <span class="number_adult_ticket"></span></p>
                    <!--<p><?php echo Jtext::_('PAPIERSDEFAMILLES_FIELD_NUMBER_CHILDRENT_TICKET_1')?>: <span class="number_childrent_ticket_1"></span></p>-->
                    <p><?php echo Jtext::_('PAPIERSDEFAMILLES_FIELD_NUMBER_CHILDRENT_TICKET_2')?>: <span class="number_childrent_ticket_2"></span></p>
                </div>
                <!-- Bill -->
                <div class="span6">
                    <p class="ticket_price"></p>
                    <p class="ticket_price_total"></p>
                    <p class="ticket_sub_total"><?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_TICKET_PRICE_SUB_TOTAL')?><span>0</span></p>
                    <p class="ticket_total"></p>
                </div>
            </div>
        </div>

        <div id='Modulecontainer'>
        </div>

        <script src='https://www.google.com/recaptcha/api.js'></script>
        <div class="g-recaptcha" data-sitekey="6Lf96CATAAAAAKnzr8YYayGkX4LpafF_lvM86Etr"></div>
	</div>

	<input type="hidden" name="jform[ticket_type_id]" value="<?php echo $this->tickettypeId?>">

	<!-- Toolbar -->
	<div class="btn-toolbar" role="toolbar" aria-label="Toolbar" >

			<button class="btn btn-small button-cancel" onclick="Joomla.submitbutton('reservation.cancel');"><span class="icon-cancel" aria-hidden="true"></span><?php echo JText::_('PAPIERSDEFAMILLES_JTOOLBAR_CANCEL')?></button>

			<button class="btn btn-small button-save" id="button-quotation-request"><?php echo JText::_('PAPIERSDEFAMILLES_JTOOLBAR_QUOTATION_REQUEST')?></button>

			<button class="btn btn-small button-save" id="button-pay-payment"><?php echo JText::_('PAPIERSDEFAMILLES_JTOOLBAR_PAY_PAYPAL')?></button>
		</div>
	</div>
</div>
