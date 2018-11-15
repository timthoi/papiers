<?php
/** 
* @package		Papiersdefamilles
* @subpackage	Reservations
* @copyright	
* @author		 -  - 
* @license		
*
*             .oooO  Oooo.
*             (   )  (   )
* -------------\ (----) /----------------------------------------------------------- +
*               \_)  (_/
*/

// no direct access
defined('_JEXEC') or die('Restricted access');



?>

<fieldset class="fieldsfly fly-horizontal">

	<div class="control-group field-departure_date">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_DEPARTURE_DATE" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly.datetime', array(
				'dataKey' => 'departure_date',
				'dataObject' => $this->item,
				'dateFormat' => 'Y-m-d'
			));?>
		</div>
    </div>
	<div class="control-group field-arrival_date">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_ARRIVAL_DATE" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly.datetime', array(
				'dataKey' => 'arrival_date',
				'dataObject' => $this->item,
				'dateFormat' => 'Y-m-d'
			));?>
		</div>
    </div>
	<div class="control-group field-number_adult_ticket">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_NUMBER_ADULT_TICKET" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
				'dataKey' => 'number_adult_ticket',
				'dataObject' => $this->item
			));?>
		</div>
    </div>
	<div class="control-group field-number_childrent_ticket_1">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_NUMBER_CHILDRENT_TICKET_1" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
				'dataKey' => 'number_childrent_ticket_1',
				'dataObject' => $this->item
			));?>
		</div>
    </div>
	<div class="control-group field-number_childrent_ticket_2">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_NUMBER_CHILDRENT_TICKET_2" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
				'dataKey' => 'number_childrent_ticket_2',
				'dataObject' => $this->item
			));?>
		</div>
    </div>
	<div class="control-group field-information_adult">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_INFORMATION_ADULT" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
				'dataKey' => 'information_adult',
				'dataObject' => $this->item
			));?>
		</div>
    </div>
	<div class="control-group field-information_child_1">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_INFORMATION_CHILD_1" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
				'dataKey' => 'information_child_1',
				'dataObject' => $this->item
			));?>
		</div>
    </div>
	<div class="control-group field-information_child_2">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_INFORMATION_CHILD_2" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
				'dataKey' => 'information_child_2',
				'dataObject' => $this->item
			));?>
		</div>
    </div>
	<div class="control-group field-_ticket_type_id_num_id">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_TICKET_TYPE_NUM_ID" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
				'dataKey' => '_ticket_type_id_num_id',
				'dataObject' => $this->item
			));?>
		</div>
    </div>
	<div class="control-group field-name">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_NAME" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
				'dataKey' => 'name',
				'dataObject' => $this->item
			));?>
		</div>
    </div>
	<div class="control-group field-surname">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_SURNAME" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
				'dataKey' => 'surname',
				'dataObject' => $this->item
			));?>
		</div>
    </div>
	<div class="control-group field-phone">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_PHONE" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
				'dataKey' => 'phone',
				'dataObject' => $this->item
			));?>
		</div>
    </div>
	<div class="control-group field-address">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_ADDRESS" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
				'dataKey' => 'address',
				'dataObject' => $this->item
			));?>
		</div>
    </div>
	<div class="control-group field-zip_code">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_ZIP_CODE" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
				'dataKey' => 'zip_code',
				'dataObject' => $this->item
			));?>
		</div>
    </div>
	<div class="control-group field-city">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_CITY" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
				'dataKey' => 'city',
				'dataObject' => $this->item
			));?>
		</div>
    </div>
	<div class="control-group field-email">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_EMAIL" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
				'dataKey' => 'email',
				'dataObject' => $this->item
			));?>
		</div>
    </div>
	<div class="control-group field-birthday">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_BIRTHDAY" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly.datetime', array(
				'dataKey' => 'birthday',
				'dataObject' => $this->item,
				'dateFormat' => 'Y-m-d'
			));?>
		</div>
    </div>
	<div class="control-group field-ticket_price">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_TICKET_PRICE" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
				'dataKey' => 'ticket_price',
				'dataObject' => $this->item
			));?>
		</div>
    </div>
	<div class="control-group field-ticket_total">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_TICKET_TOTAL" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
				'dataKey' => 'ticket_total',
				'dataObject' => $this->item
			));?>
		</div>
    </div>
	<div class="control-group field-discount">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_DISCOUNT" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
				'dataKey' => 'discount',
				'dataObject' => $this->item
			));?>
		</div>
    </div>
	<div class="control-group field-is_quote">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_QUOTE" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly.bool', array(
				'dataKey' => 'is_quote',
				'dataObject' => $this->item
			));?>
		</div>
    </div>
	<div class="control-group field-is_paypal">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_PAYPAL" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly.bool', array(
				'dataKey' => 'is_paypal',
				'dataObject' => $this->item
			));?>
		</div>
    </div>
	<div class="control-group field-is_paypal_refund">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_PAYPAL_REFUND" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly.bool', array(
				'dataKey' => 'is_paypal_refund',
				'dataObject' => $this->item
			));?>
		</div>
    </div>
	<div class="control-group field-payment_status">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_PAYMENT_STATUS" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly.bool', array(
				'dataKey' => 'payment_status',
				'dataObject' => $this->item
			));?>
		</div>
    </div>
	<div class="control-group field-_created_by_name">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_CREATED_BY_NAME" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
				'dataKey' => '_created_by_name',
				'dataObject' => $this->item
			));?>
		</div>
    </div>
	<div class="control-group field-_modified_by_name">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_MODIFIED_BY_NAME" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly', array(
				'dataKey' => '_modified_by_name',
				'dataObject' => $this->item
			));?>
		</div>
    </div>
	<div class="control-group field-creation_date">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_CREATION_DATE" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly.datetime', array(
				'dataKey' => 'creation_date',
				'dataObject' => $this->item,
				'dateFormat' => 'Y-m-d H:i'
			));?>
		</div>
    </div>
	<div class="control-group field-modification_date">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_MODIFICATION_DATE" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly.datetime', array(
				'dataKey' => 'modification_date',
				'dataObject' => $this->item,
				'dateFormat' => 'Y-m-d H:i'
			));?>
		</div>
    </div>
	<div class="control-group field-ordering">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_ORDERING" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly.int', array(
				'dataKey' => 'ordering',
				'dataObject' => $this->item
			));?>
		</div>
    </div>
	<div class="control-group field-published">
    	<div class="control-label">
			<label><?php echo JText::_( "PAPIERSDEFAMILLES_FIELD_PUBLISHED" ); ?></label>
		</div>
		
        <div class="controls">
			<?php echo JDom::_('html.fly.publish', array(
				'dataKey' => 'published',
				'dataObject' => $this->item
			));?>
		</div>
    </div>
</fieldset>