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


PapiersdefamillesHelper::headerDeclarations();
//Load the formvalidator scripts requirements.
JDom::_('html.toolbar');
JHTML::_('behavior.modal');
$token = JSession::getFormToken();



JHtml::_('behavior.calendar');

$doc = JFactory::getDocument();


$array_image = $this->item->galleries;

$description = strlen($this->ticketDetail->long_presentation) > 150 ? substr(strip_tags($this->ticketDetail->long_presentation),0,150)."..." : strip_tags($this->ticketDetail->long_presentation);

foreach ($array_image as $key => $image)
{
	if ($key = 1)
	{
		$imageUrl = "http://" . $_SERVER['HTTP_HOST'] . "/" . $this->item->gallery . '/' . $image;
	}
}

$doc->addCustomTag( '<meta property="og:type" content="website" />');
$doc->addCustomTag( '<meta property="og:title" content="'.$doc->getTitle().'" />');
$doc->addCustomTag( '<meta property="og:description" content="'.$description.'" />');
$doc->addCustomTag( '<meta property="og:image" content="'.$imageUrl.'" />');

JText::script('PAPIERSDEFAMILLES_FORMVALIDATOR_THIS_FIELD_IS_REQUIRED');
JText::script('PAPIERSDEFAMILLES_ERROR_THIS_FIELD_IS_REQUIRED');
JText::script('PAPIERSDEFAMILLES_ERROR_RETURN_DATE_MUST_BE_GREATER_THAN_DEPARUTURE_DATE');
JText::script('PAPIERSDEFAMILLES_ERROR_NUMBER');
JText::script('PAPIERSDEFAMILLES_ERROR_DATE');
JText::script('PAPIERSDEFAMILLES_ERROR_DATE_2');
JText::script('PAPIERSDEFAMILLES_ERROR_DATE_GREATER_NOW');
JText::script('PAPIERSDEFAMILLES_ERROR_DATE_LESS_NOW');
JText::script('PAPIERSDEFAMILLES_ERROR_NOT_HAVE_TICKET');

//var_dump(PapiersdefamillesHelper::getTicketFlight(3, 1, '20-05-2018'));

?>

<script language="javascript" type="text/javascript">
	//Secure the user navigation on the page, in order preserve datas.
	/*var holdForm = true;
	window.onbeforeunload = function closeIt(){	if (holdForm) return false;};*/
</script>


<form action="<?php echo(JRoute::_("index.php")); ?>" method="post" name="adminForm3" id="adminForm3" class='' enctype='multipart/form-data'>
	<div class="row-fluid reservation">
		<div id="contents" class="span12">

			<ul class="main nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#step1" class="btt-tab-step1"><?php echo JText::_('PAPIERSDEFAMILLES_TEXT_STEP1')?></a></li>
				<li><a data-toggle="tab" href="#step2" class="btt-tab-step2"><?php echo JText::_('PAPIERSDEFAMILLES_TEXT_STEP2')?></a></li>
				<li><a data-toggle="tab" href="#step3" class="btt-tab-step3"><?php echo JText::_('PAPIERSDEFAMILLES_TEXT_STEP3')?></a></li>
			</ul>
			<!-- BRICK : form -->

			<div class="tab-panel">
				<!-- Step1 -->
				<div class="step1 tab-pane fade in active" id="step1">
					 <?php echo $this->loadTemplate('form'); ?>
				</div>

				<!-- Step2 -->
				<div class="step2 tab-pane fade" id="step2">
					<?php echo $this->loadTemplate('information'); ?>
				</div>

				<!-- Step3 -->
				<div class="step3 tab-pane fade" id="step3">
					 <?php echo $this->loadTemplate('final'); ?>
				</div>

                <div class="footer">
                    <?php //echo JText::_('PAPIERSDEFAMILLES_TEXT_FOOTER_RESERVATION_1')?>
                    <?php echo JText::_('PAPIERSDEFAMILLES_TEXT_FOOTER_RESERVATION_2')?>
                </div>

			</div>

		</div>
	</div>


	<?php
		$jinput = JFactory::getApplication()->input;
		echo JDom::_('html.form.footer', array(
		'dataObject' => $this->item,
		'values' => array(
					'id' => $this->state->get('reservation.id')
				)));
	?>
</form>


<script type="text/javascript">
	jQuery(document).ready(function ($) {


        $('.slider').slick({
            draggable: true,
            arrows: true,
            dots: true,
            fade: true,
            speed: 900,
            infinite: true,
            touchThreshold: 100
        })

		// Init gallery
		/*$('.slider-for').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			fade: true,

			asNavFor: '.slider-nav'
		});
		$('.slider-nav').slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			asNavFor: '.slider-for',
			dots: false,
            arrows: false,
			centerMode: true,
			vertical: true,
			focusOnSelect: true
		});*/
	})
</script>

<!-- Step 1 -->
<script type="text/javascript">
	jQuery(document).ready(function ($) {
        Joomla.submitform3 = function(task){
            if (task) {
                document.adminForm3.task.value = task;
            }
            else
                document.adminForm3.task.value = "";

            if (typeof document.adminForm3.onsubmit == "function") {
                document.adminForm3.onsubmit();
            }
            document.adminForm3.submit();
        }

        $(".main.nav .disabled > a").on("click", function(e) {
            e.preventDefault();
            return false;
        });

        // Step 1 disabled 2 step
        $('.main.nav.nav-tabs').find("li:eq(1)").addClass('disabled');
        $('.main.nav.nav-tabs').find("li:eq(2)").addClass('disabled');

        // Disable when not have pricelist
        var flag_show_price_list = 0;
        var is_have_ticket = 0;

        $('#jform_departure_city_id option').each(function(index,element){
            //console.log(index);
            //console.log(element.value);
            //console.log(element.text);

            if (element.value)
            {
                jQuery.ajax({
                    type: "POST",
                    data: {
                        "<?php echo $token ?>": "1",
                        'selected_departure_city_id': element.value,
                        'tickettype_id': '<?php echo $this->tickettypeId?>'
                    },
                    url: '<?php echo JUri::root() ?>index.php?option=com_papiersdefamilles&task=reservation.ajaxGetPriceList',
                    success: function(response) {
                        if (response == 0)
                        {
                            var $chosen = $("#jform_departure_city_id").chosen();

                            $chosen.find('option:contains("' + element.text + '")').attr('disabled','disabled');
                            $chosen.trigger("liszt:updated");
                        }
                        else if (flag_show_price_list == 0)
                        {
                            flag_show_price_list = 1;
                            //renderAjaxGetPriceList(element.value);
                        }
                    }
                });
            }
        });

		// Init -Choose departure city
		/*var departure_city_id = $("#jform_departure_city_id").val();

		if  (!departure_city_id)
		{
			departure_city_id = 1;
		}

		// Init to get Type Flight
        var is_choose_departure_city_id = 0;
        var is_choose_departure_date = 0;

		renderAjaxGetPriceList(departure_city_id);

		$("#jform_departure_city_id").chosen().change(function(event) {
			if ($(this).val() != "") {
				var selected_departure_city_id = $(this).val();
				renderAjaxGetPriceList(selected_departure_city_id);
                is_choose_departure_city_id = 1;
			}
			else {
                is_choose_departure_city_id = 0;
            }
		});


		function renderAjaxGetPriceList(selected_departure_city_id)
        {
            jQuery.ajax({
                type: "POST",
                data: {
                    "<?php echo $token ?>": "1",
                    'selected_departure_city_id': selected_departure_city_id,
                    'tickettype_id': '<?php echo $this->tickettypeId?>'
                },
                url: '<?php echo JUri::root() ?>/index.php?option=com_papiersdefamilles&task=reservation.ajaxGetPriceList',
                success: function(response) {
                    if (response != 0)
                    {
                        $('.pricelist').empty();
                        $('.pricelist').append(response);
                    }
                }
            });
        }*/


        var myFunction_adult_ticket = function() {
            var count = $("#jform_number_adult_ticket").val();

            $.each( $(".information-adult2 tbody tr"), function() {
                $(this).find('td .group-remove').trigger('click');
            });

            if (count == 1) {
                $('.information-adult2').hide();
            }
            else {
                $('.information-adult2').show();
                $('.information-adult2').removeClass('hidden');

                setTimeout(function(){
                    for (var i = 1; i < count; i++)
                    {
                        if (i ==1)
                            $("input[name='jform[information_adult]']").parent().find('th .group-add').trigger('click');
                    }
                }, 500);
            }
        };

       /* var myFunction_childrent_ticket_1 = function() {
            var count = $("#jform_number_childrent_ticket_1").val();

            $.each( $(".information-children1 tbody tr"), function() {
                $(this).find('td .group-remove').trigger('click');
            });

            if (!count || count ==0) {
                $('.information-children1').hide();
            }
            else {
                $('.information-children1').show();
                $('.information-children1').removeClass('hidden');

                setTimeout(function() {
                    for (var i = 0; i < count; i++)
                    {
                        if (i ==0) {
                            $("input[name='jform[information_child_1]']").parent().find('th .group-add').trigger('click');
                        }
                        else {
                            $("input[name='jform[information_child_1]']").parent().find('td .group-add').trigger('click');
                        }
                    }
                }, 500);
            }
        };*/

        var myFunction_childrent_ticket_2 = function() {
            var count = $("#jform_number_childrent_ticket_2").val();

            $.each( $(".information-children2 tbody tr"), function() {
                $(this).find('td .group-remove').trigger('click');
            });

            if (!count || count ==0) {
                $('.information-children2').hide();
            }
            else {
                $('.information-children2').show();
                $('.information-children2').removeClass('hidden');

                setTimeout(function() {
                    for (var i = 0; i < count; i++)
                    {
                        if (i ==0) {
                            $("input[name='jform[information_child_2]']").parent().find('th .group-add').trigger('click');
                        }
                        else {
                            $("input[name='jform[information_child_2]']").parent().find('td .group-add').trigger('click');
                        }
                    }
                }, 500);
            }
        };


        $(document).on('subform-row-add', function(event, row){
            elements = document.querySelectorAll(".field-calendar");
            for (i = 0; i < elements.length; i++) {
                JoomlaCalendar.init(elements[i]);
            }
        })

		// Click button-step1
		// 1.Validate
		// 2.display none
		// 3.display step2
        $("#adminForm3").validationEngine('detach');
        $("#adminForm3").validationEngine('attach', {promptPosition : "topLeft", scroll: false});

        $('.btt-tab-step1').on('click', function(e) {
            // disable tab 1-2
            $('.main.nav.nav-tabs').find("li:eq(1)").removeClass("disabled").addClass("disabled");
            $('.main.nav.nav-tabs').find("li:eq(2)").removeClass("disabled").addClass("disabled");
        });

        $('.btt-tab-step2').on('click', function(e) {
            // disable tab 1-2
            $('.main.nav.nav-tabs').find("li:eq(2)").removeClass("disabled").addClass("disabled");
        });

        var flag_check_type_flight = 0;

		$('.button-step1').on('click', function(e) {
		    // disable tab 1-2
            $('.main.nav.nav-tabs').find("li:eq(1)").removeClass("disabled").addClass("disabled");
            $('.main.nav.nav-tabs').find("li:eq(2)").removeClass("disabled").addClass("disabled");

            var flag_validate = $("#adminForm3").validationEngine('validate');

            if (!$("#jform_departure_city_id").val())
            {
                flag_validate = false;
                $('#jform_departure_city_id_chzn').validationEngine('showPrompt', "<span>•</span> " + Joomla.JText._('PAPIERSDEFAMILLES_FORMVALIDATOR_THIS_FIELD_IS_REQUIRED'), 'asdas',"topLeft", 1);
            }

            if (!$("#jform_number_adult_ticket").val() || $("#jform_number_adult_ticket").val() == 0)
            {
                flag_validate = false;
                $('#jform_number_adult_ticket').validationEngine('showPrompt', "<span>•</span> " + Joomla.JText._('PAPIERSDEFAMILLES_FORMVALIDATOR_THIS_FIELD_IS_REQUIRED'), 'asdas',"topLeft", 1);
            }

            if ($('#jform_departure_date').val() && $('#jform_arrival_date').val())
            {
                if (flag_validate)
                {
                    a = string2date($('#jform_departure_date').val());
                    b = string2date($('#jform_arrival_date').val());
                    c = string2date(getDateNow());

                    if (b < a)
                    {
                        $('#jform_arrival_date').validationEngine('showPrompt', "<span>•</span> " + Joomla.JText._('PAPIERSDEFAMILLES_ERROR_RETURN_DATE_MUST_BE_GREATER_THAN_DEPARUTURE_DATE'), 'asdas',"topLeft",1);
                        flag_validate = false;
                    }
                    else if (a < c)
                    {
                        $('#jform_departure_date').validationEngine('showPrompt', "<span>•</span> " + Joomla.JText._('PAPIERSDEFAMILLES_ERROR_DATE_GREATER_NOW'), 'asdas',"topLeft",1);
                        flag_validate = false;
                    }
                    else if (b < c)
                    {
                        $('#jform_arrival_date').validationEngine('showPrompt', "<span>•</span> " + Joomla.JText._('PAPIERSDEFAMILLES_ERROR_DATE_GREATER_NOW'), 'asdas',"topLeft",1);
                        flag_validate = false;
                    }
                }
            }

            // Check Do the systtem have ticket in this date

            // Hide step 1 - display step 2
			if (flag_validate)
			{
                // Ajax get Type Flight

                jQuery.ajax({
                    type: "POST",
                    async: true,
                    data: {
                        'jform[tickettype_id]': "<?php echo $this->tickettypeId ?>",
                        'jform[departure_city_id]': $('#jform_departure_city_id').val(),
                        'jform[departure_date]': $('#jform_departure_date').val(),
                        'jform[type_flight]': $("input[name='jform[type_flight]']:checked").val(),
                        'jform[number_adult_ticket]': $('#jform_number_adult_ticket').val(),
                        'jform[number_childrent_ticket_1]': 0,
                        'jform[number_childrent_ticket_2]': $('#jform_number_childrent_ticket_2').val(),
                        "<?php echo $token ?>": "1"
                    },
                    url: '<?php echo JUri::root() ?>index.php?option=com_papiersdefamilles&task=reservation.ajaxGetTicketPrice',
                    success: function(response) {
                        console.log(response);

                        if (response == 0 || response == 1) {
                            $('#jform_departure_date').validationEngine('showPrompt', "<span>•</span> " + Joomla.JText._('PAPIERSDEFAMILLES_ERROR_NOT_HAVE_TICKET'), 'asdas',"topLeft",1);
                            is_have_ticket = 0;
                        }
                        if (response == 2) {
                            $("input[name='jform[type_flight]']:checked").validationEngine('showPrompt', "<span>•</span> " + Joomla.JText._('PAPIERSDEFAMILLES_ERROR_NOT_HAVE_TICKET'), 'asdas',"topLeft",1);
                            is_have_ticket = 0;
                        } else {
                            is_have_ticket = 1;
                            var result = jQuery.parseJSON(response);

                            $('#step3 .ticket_price').html(result['ticket_price']);
                            $('#step3 .ticket_price_total').html(result['ticket_price_total']);
                            $('#step3 .ticket_total').html(result['ticket_total']);

                            // Step 1 disabled 2 step
                            $('.main.nav.nav-tabs').find("li:eq(1)").removeClass('disabled');
                            $('.btt-tab-step2').trigger('click');

                            $('.btt-tab-step2').scrollView();

                            myFunction_adult_ticket();
                            //myFunction_childrent_ticket_1();
                            myFunction_childrent_ticket_2();

                            if (!$("#jform_number_childrent_ticket_1").val())
                            {
                                $('.information-children1').addClass('hidden');
                            }

                            if (!$("#jform_number_childrent_ticket_2").val())
                            {
                                $('.information-children2').addClass('hidden');
                            }

                            if (!$("#jform_number_adult_ticket").val())
                            {
                                $('.information-main-adult').addClass('hidden');
                            }
                        }
                    }
                });
			}

			e.preventDefault();
			return false;
		});

		// Click button-step1
		// 1.Validate
		// 2.display none
		// 3.display step2

		$('.button-step2').on('click', function(e) {
            // disable tab 2
            $('.main.nav.nav-tabs').find("li:eq(2)").removeClass("disabled").addClass("disabled");

			var flag_validate = true;
            $("#jform_name").addClass('validate[required]');
            $("#jform_surname").addClass('validate[required]');
            $("#jform_phone").addClass('validate[required,custom[numeric]]');
            $("#jform_zip_code").addClass('validate[required,custom[numeric]]');
            $("#jform_address").addClass('validate[required]');
            $("#jform_city").addClass('validate[required]');
            $("#jform_email").addClass('validate[required,custom[email]]');
            //$("#jform_birthday").addClass('validate[required,custom[date]]');

            jQuery(".subform-repeatable-wrapper input[name$='[name]']").addClass('validate[required]');
            jQuery(".subform-repeatable-wrapper input[name$='[surname]']").addClass('validate[required]');
            jQuery(".subform-repeatable-wrapper input[name$='[birthday]']").addClass('validate[required,custom[date]]');

            var flag_validate = $("#adminForm3").validationEngine('validate');

			/*if ($('#jform_birthday').val())
			{
				if (flag_validate)
				{
					a = string2date($('#jform_birthday').val());
					c = string2date(getDateNow());

					if (a > c)
					{
						$('#jform_birthday').validationEngine('showPrompt', "<span>•</span> " + Joomla.JText._('PAPIERSDEFAMILLES_ERROR_DATE_LESS_NOW'), 'asdas',"topLeft",1);
						flag_validate = false;
					}
				}
			}*/

            var dayValidate = "^(0?[1-9]|[12][0-9]|3[01])$";
            var monthValidate = "^(0?[1-9]|1[012])$";
            var yearValidate = "^(19[5-9]\d|20[0-4]\d|2050)$";
            var days = $('#step2 #dayId').val();
            var months = $('#step2 #monthId').val();
            var years = $('#step2 #yearId').val();

            if (!days.match(dayValidate)) {
                $('#step2 #dayId').validationEngine('showPrompt', "<span>•</span> " + Joomla.JText._('PAPIERSDEFAMILLES_ERROR_DATE_2'), 'asdas', "topLeft", 1);

                //alert("Please, Enter Days  between 1 to 31 ");
                flag_validate = false;
            }

            if (!months.match(monthValidate)) {
                $('#step2 #monthId').validationEngine('showPrompt', "<span>•</span> " + Joomla.JText._('PAPIERSDEFAMILLES_ERROR_DATE_2'), 'asdas', "topLeft", 1);
                //alert("Please, Enter Months in between 1 to 12 ");

                flag_validate = false;
            }

            if (!(years >= 1900 && years <= 2050)) {
                //alert("Please, Enter Years in between 1900 to 2016 ");
                $('#step2 #yearId').validationEngine('showPrompt', "<span>•</span> " + Joomla.JText._('PAPIERSDEFAMILLES_ERROR_DATE_2'), 'asdas', "topLeft", 1);

                flag_validate = false;
            }

			// Hide step 1 - display step 2
			if (flag_validate)
			{
                $('#jform_birthday').val($('#dayId').val() + '-' + $('#monthId').val() + '-' + $('#yearId').val());
				// Display value
                $('#step3 .departure_date').text($('#jform_departure_date').val());
                $('#step3 .arrival_date').text($('#jform_arrival_date').val());

                var departure_city = $("#jform_departure_city_id option:selected").text();

                var departure_city = departure_city;
                var destination_city = '<?php echo $this->ticketDetail->destination?>';

                $('#step3 .destination_city').text(destination_city);
                $('#step3 .departure_city').text(departure_city);

                $('#step3 .number_adult_ticket').text($('#jform_number_adult_ticket').val());
                //$('#step3 .number_childrent_ticket_1').text($('#jform_number_childrent_ticket_1').val());
                if ($('#jform_number_childrent_ticket_2').val()) {
                    $('#step3 .number_childrent_ticket_2').text($('#jform_number_childrent_ticket_2').val());
                }
                else {
                    $('#step3 .number_childrent_ticket_2').text(0);
                }


                //ajaxGetTicketPrice();

                $('.main.nav.nav-tabs').find("li:eq(2)").removeClass('disabled');
				$('.btt-tab-step3').trigger('click');
                $('.btt-tab-step3').scrollView();

                $('#toolbar-final').removeClass('hidden');
			}

			e.preventDefault();
			return false;
		});

		$('#button-quotation-request').on('click', function(e) {
            var googleResponse = jQuery('#g-recaptcha-response').val();

            if (!googleResponse)
            {
                $('.g-recaptcha').validationEngine('showPrompt', "<span>•</span> " + '<?php echo Jtext::_('PAPIERSDEFAMILLES_ERROR_NOT_CHECK_CAPTCHA')?>', 'asdas',"topLeft",1);
            }
            else if (googleResponse)
            {
                Joomla.submitform3('reservation.quotation_request');
            }

		    e.preventDefault();
		    return false;
        });

        $('#button-pay-payment').on('click', function(e) {
            var googleResponse = jQuery('#g-recaptcha-response').val();

            if (!googleResponse)
            {
                $('.g-recaptcha').validationEngine('showPrompt', "<span>•</span> " + '<?php echo Jtext::_('PAPIERSDEFAMILLES_ERROR_NOT_CHECK_CAPTCHA')?>', 'asdas',"topLeft",1);
            }
            else if (googleResponse)
            {
                Joomla.submitform3('reservation.payment_paypal');
            }

            e.preventDefault();
            return false;
        });

        var insurance_rate = '<?php echo $this->ticketDetail->insurance_rate?>';
        var luggage_refund_rate_grid = '<?php echo $this->ticketDetail->luggage_refund_rate_grid?>';

        var sub_total = 0;
        var is_insurance_click_0 = 1;
        var is_insurance_click_1 = 0;

        // Update SubTotal
        $('#jform_is_insurance label').on('click', function(e) {
            var attr = $(this).attr('for');
            var grand_total = parseInt($('#step3 .ticket_total span').text());

            if (attr == 'jform_is_insurance_1' && is_insurance_click_1 == 0) {
                sub_total += parseInt(insurance_rate);
                grand_total += parseInt(insurance_rate);

                is_insurance_click_0 = 0;
                is_insurance_click_1 = 1;
            }
            else if (attr == 'jform_is_insurance_0' && is_insurance_click_0 == 0) {
                sub_total -= parseInt(insurance_rate);
                grand_total -= parseInt(insurance_rate);

                is_insurance_click_0 = 1;
                is_insurance_click_1 = 0;
            }

            $('#step3 .ticket_sub_total span').empty();
            $('#step3 .ticket_sub_total').append('<span>' + sub_total + '€</span>');

            $('#step3 .ticket_total span').empty();
            $('#step3 .ticket_total').append('<span>' + grand_total + '€</span>');

            e.preventDefault();
            return false;
        });

        var is_baggage_insurance_click_0 = 1;
        var is_baggage_insurance_click_1 = 0;
        // Update SubTotal
        $('#jform_is_baggage_insurance label').on('click', function(e) {
            var attr = $(this).attr('for');
            var grand_total = parseInt($('#step3 .ticket_total span').text());

            if (attr == 'jform_is_baggage_insurance_1' && is_baggage_insurance_click_1 == 0) {
                sub_total += parseInt(luggage_refund_rate_grid);
                grand_total += parseInt(luggage_refund_rate_grid);

                is_baggage_insurance_click_0 = 0;
                is_baggage_insurance_click_1 = 1;
            }
            else if (attr == 'jform_is_baggage_insurance_0' && is_baggage_insurance_click_0 == 0) {
                sub_total -= parseInt(luggage_refund_rate_grid);
                grand_total -= parseInt(luggage_refund_rate_grid);

                is_baggage_insurance_click_0 = 1;
                is_baggage_insurance_click_1 = 0;
            }

            $('#step3 .ticket_sub_total span').empty();
            $('#step3 .ticket_sub_total').append('<span>' + sub_total + '€</span>');

            $('#step3 .ticket_total span').empty();
            $('#step3 .ticket_total').append('<span>' + grand_total + '€</span>');

            e.preventDefault();
            return false;
        });

		function string2date(date){
			var parts = date.split("-");
			return new Date(parts[2], parts[1]-1, parts[0]);
		}

		function getDateNow()
		{
			var dNow = new Date();
			var utcdate= dNow.getDate() + '-' + (dNow.getMonth()+ 1)+ '-' + dNow.getFullYear();

			return utcdate;
		}

        $.fn.scrollView = function () {
            return this.each(function () {
                $('html, body').animate({
                    scrollTop: $(this).offset().top
                }, 1000);
            });
        }
	})
</script>


<style>
	.tab-pane.fade {
		display: none;
	}

	.tab-pane.fade.active {
		display: block;
	}

	table.adminlist.table-striped tr td:last-child,  table.adminlist.table-striped tr th:last-child{
		display: none;
	}
</style>