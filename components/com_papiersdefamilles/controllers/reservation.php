<?php
/**
 * @package        Papiersdefamilles
 * @subpackage     Reservations
 * @copyright
 * @author         -  -
 * @license
 *
 *             .oooO  Oooo.
 *             (   )  (   )
 * -------------\ (----) /----------------------------------------------------------- +
 *               \_)  (_/
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once JPATH_LIBRARIES . '/paypal/vendor/autoload.php';

use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

/**
 * Papiersdefamilles Reservation Controller
 *
 * @package       Papiersdefamilles
 * @subpackage    Reservation
 */
class PapiersdefamillesControllerReservation extends PapiersdefamillesClassControllerItem
{
	/**
	 * The context for storing internal data, e.g. record.
	 *
	 * @var string
	 */
	protected $context = 'reservation';

	/**
	 * The URL view item variable.
	 *
	 * @var string
	 */
	protected $view_item = 'reservation';

	/**
	 * The URL view list variable.
	 *
	 * @var string
	 */
	protected $view_list = 'reservations';

	/**
	 * Constructor
	 *
	 * @access    public
	 *
	 * @param    array $config An optional associative array of configuration settings.
	 *
	 * @return    void
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);
		$app = JFactory::getApplication();

	}

	/**
	 * Override method when the author allowed to delete own.
	 *
	 * @access    protected
	 *
	 * @param    array  $data An array of input data.
	 * @param    string $key  The name of the key for the primary key; default is id..
	 *
	 * @return    boolean    True on success
	 */
	protected function allowDelete($data = array(), $key = id)
	{
		return parent::allowDelete($data, $key, array(
			'key_author' => 'created_by'
		));
	}

	/**
	 * Override method when the author allowed to edit own.
	 *
	 * @access    protected
	 *
	 * @param    array  $data An array of input data.
	 * @param    string $key  The name of the key for the primary key; default is id..
	 *
	 * @return    boolean    True on success
	 */
	protected function allowEdit($data = array(), $key = id)
	{
		return parent::allowEdit($data, $key, array(
			'key_author' => 'created_by'
		));
	}

	/**
	 * Method to cancel an element.
	 *
	 * @access    public
	 *
	 * @param    string $key The name of the primary key of the URL variable.
	 *
	 * @return    void
	 */
	public function cancel($key = null)
	{
		$this->_result = $result = parent::cancel();
		$model         = $this->getModel();

		//Define the redirections
		switch ($this->getLayout() . '.' . $this->getTask())
		{
			case 'reservation.cancel':

				$app = JFactory::getApplication();
				$app->redirect("index.php");

				/*$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.reservations.default'
				), array(
					'cid[]' => null
				));*/
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.reservations.default'
				));
				break;
		}
	}

	/**
	 * Method to delete an element.
	 *
	 * @access    public
	 *
	 * @param    string $key The name of the primary key of the URL variable.
	 *
	 * @return    void
	 */
	public function cancelDelete($key = null)
	{
		JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
		$this->_result = $result = parent::delete();
		$model         = $this->getModel();

		//Define the redirections
		$app = JFactory::getApplication();
		$app->redirect("index.php");
	}

	/**
	 * Method to delete an element.
	 *
	 * @access    public
	 *
	 * @return    void
	 */
	public function delete()
	{
		JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
		$this->_result = $result = parent::delete();
		$model         = $this->getModel();

		//Define the redirections
		switch ($this->getLayout() . '.' . $this->getTask())
		{
			case 'default.delete':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.reservations.default'
				), array(
					'cid[]' => null
				));
				break;

			case 'modal.delete':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.reservations.default'
				), array(
					'cid[]' => null
				));
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.reservations.default'
				));
				break;
		}
	}

	/**
	 * Return the current layout.
	 *
	 * @access    protected
	 *
	 * @param    bool $default If true, return the default layout.
	 *
	 * @return    string    Requested layout or default layout
	 */
	protected function getLayout($default = null)
	{
		if ($default)
			return 'reservation';

		$jinput = JFactory::getApplication()->input;

		return $jinput->get('layout', 'reservation', 'CMD');
	}


	/**
	 * Method to save an element. - step 1 -> step 2: save time to go
	 *
	 * @access    public
	 *
	 * @param    string $key    The name of the primary key of the URL variable.
	 * @param    string $urlVar The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
	 *
	 * @return    void
	 */
	public function payment_paypal($key = null, $urlVar = null)
	{
		self::save($key, $urlVar);
	}

	/**
	 * Method to save an element. - step 2 -> step 3: save informtion of passenger
	 *
	 * @access    public
	 *
	 * @param    string $key    The name of the primary key of the URL variable.
	 * @param    string $urlVar The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
	 *
	 * @return    void
	 */
	public function quotation_request($key = null, $urlVar = null)
	{
		self::save($key, $urlVar);
	}

	/**
	 * Method to save an element.
	 *
	 * @access    public
	 *
	 * @param    string $key    The name of the primary key of the URL variable.
	 * @param    string $urlVar The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
	 *
	 * @return    void
	 */
	public function save($key = null, $urlVar = null)
	{
		JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));

		//Check the ACLs
		$model  = $this->getModel();
		$item   = $model->getItem();
		$result = false;

		$jinput = JFactory::getApplication()->input;
		$data   = $jinput->get('jform', array(), 'array');

		if ($model->canEdit($item, true))
		{
			$result = parent::save();
			//Get the model through postSaveHook()
			if ($this->model)
			{
				$model = $this->model;
				$item  = $model->getItem();

				$ticketTypeId    = $item->ticket_type_id;
				$modelTicketType = CkJModel::getInstance('tickettype', 'PapiersdefamillesModel');
				$ticketType      = $modelTicketType->getItem($item->ticket_type_id);

				$object     = new stdClass();
				$flagUpdate = false;

				$priceTicketArray = PapiersdefamillesHelper::calculateTicketPrice($item->ticket_type_id, $item->departure_city_id, $item->departure_date, $item->number_adult_ticket, $item->number_childrent_ticket_1, $item->number_childrent_ticket_2);

				if (!empty($priceTicketArray))
				{
					$flagUpdate           = true;
					$object->ticket_price = $priceTicketArray['ticket_price'];
					$object->ticket_total = $priceTicketArray['ticket_total'];
					$object->discount     = $priceTicketArray['discount'];
				}

				if (isset($data['is_insurance']) && $data['is_insurance'])
				{
					$flagUpdate              = true;
					$object->insurance_price = $ticketType->insurance_rate;
					$object->ticket_total    += $object->insurance_price;
				}

				if (isset($data['is_baggage_insurance']) && $data['is_baggage_insurance'])
				{
					$flagUpdate                      = true;
					$object->baggage_insurance_price = $ticketType->luggage_refund_rate_grid;
					$object->ticket_total            += $object->baggage_insurance_price;
				}

				if (isset($data['information_adult']) && $data['information_adult'])
				{
					// JSon Type [{"field1":"value1","field2":"value2"}, {"field1":"value1","field2":"value2"}]
					$tmp = '[';

					foreach ($data['information_adult'] as $promotion)
					{
						$tmp .= '{"name":"' . $promotion['name'] . '", "surname":"' . $promotion['surname'] . '", "birthday":"' . $promotion['birthday'] . '"},';
					}

					$tmp = rtrim($tmp, ",");
					$tmp .= ']';

					$object->information_adult = $tmp;
					$flagUpdate                = true;
				}

				/*if (isset($data['information_child_1']) && $data['information_child_1'])
				{
					// JSon Type [{"field1":"value1","field2":"value2"}, {"field1":"value1","field2":"value2"}]
					$tmp = '[';

					foreach ($data['information_child_1'] as $promotion)
					{
						$tmp .= '{"name":"' . $promotion['name'] . '", "surname":"' . $promotion['surname'] . '", "birthday":"' . $promotion['birthday'] . '"},';
					}

					$tmp = rtrim($tmp, ",");
					$tmp .= ']';

					$object->information_child_1 = $tmp;
					$flagUpdate                  = true;
				}*/

				if (isset($data['information_child_2']) && $data['information_child_2'])
				{
					// JSon Type [{"field1":"value1","field2":"value2"}, {"field1":"value1","field2":"value2"}]
					$tmp = '[';

					foreach ($data['information_child_2'] as $promotion)
					{
						$tmp .= '{"name":"' . $promotion['name'] . '", "surname":"' . $promotion['surname'] . '", "birthday":"' . $promotion['birthday'] . '"},';
					}

					$tmp = rtrim($tmp, ",");
					$tmp .= ']';

					$object->information_child_2 = $tmp;
					$flagUpdate                  = true;
				}

				// Send Email Quotation Request
				if ($this->getTask() == 'quotation_request')
				{
					$object->is_quote = 1;

					$object->is_paypal        = 0;
					$object->is_paypal_refund = 0;
					$object->payment_status   = 0;
					$flagUpdate               = true;

					// Send Email
					$search             = array('[TICKET_TYPE_ID]',
						'[DEPARTURE_CITY]',
						'[DEPARTURE_DATE]',
						'[ARRIVAL_DATE]',
						'[NUMBER_ADULT_TICKET]',
						'[NUMBER_CHILDRENT_TICKET_1]',
						'[NUMBER_CHILDRENT_TICKET_2]',
						'[INFORMATION_ADULT]',
						'[INFORMATION_CHILD_1]',
						'[INFORMATION_CHILD_2]',
						'[NAME]',
						'[SURNAME]',
						'[PHONE]',
						'[ADDRESS]',
						'[ZIP_CODE]',
						'[CITY]',
						'[BIRTHDAY]',
						'[TICKET_PRICE]',
						'[TICKET_TOTAL]',
						'[DISCOUNT]',
						'[CREATION_DATE]',
						'[LINK_ADMIN]',
						'[LINK_USER]',
						'[DESTINATION]',
						'[EMAIL]',
						'[TICKET_TYPE]'
					);
					$modelDepartureCity = CkJModel::getInstance('Departurecity', 'PapiersdefamillesModel');
					$modelTicketType    = CkJModel::getInstance('Tickettype', 'PapiersdefamillesModel');

					$replaces                   = array();
					$replaces['ticket_type_id'] = $modelTicketType->getItem($item->ticket_type_id)->num_id;

					$modelDepartureCityId       = CkJModel::getInstance('Departurecity', 'PapiersdefamillesModel');
					$departureCity              = $modelDepartureCityId->getItem($item->departure_city_id);
					$replaces['departure_city'] = $departureCity->name;

					$replaces['departure_date']            = JFactory::getDate($item->departure_date)->format('d-m-Y');
					$replaces['arrival_date']              = JFactory::getDate($item->arrival_date)->format('d-m-Y');

					$replaces['number_adult_ticket']       = $item->number_adult_ticket;
					$replaces['number_childrent_ticket_1'] = ($item->number_childrent_ticket_1) ? $item->number_childrent_ticket_1 : '0';
					$replaces['number_childrent_ticket_2'] = ($item->number_childrent_ticket_2) ? $item->number_childrent_ticket_2 : '0';

					// information_adult
					$tmp              = '';
					$informationAdult = array();

					if (isset($data['information_adult']) && $data['information_adult'])
					{
						$informationAdult = $data['information_adult'];
					}
					elseif (isset($item->information_adult) && !empty($item->information_adult))
					{
						$informationAdult = json_decode($item->information_adult, true);
					}

					if (!empty($informationAdult))
					{
						foreach ($informationAdult as $promotion)
						{
							$tmp .= Jtext::_('PAPIERSDEFAMILLES_FIELD_NAME') . ': ' . $promotion['name'] . '</br>';
							$tmp .= Jtext::_('PAPIERSDEFAMILLES_FIELD_SURNAME') . ': ' . $promotion['surname'] . '</br>';
							$tmp .= Jtext::_('PAPIERSDEFAMILLES_FIELD_BIRTHDAY') . ': ' . $promotion['birthday'] . '</br>';
						}
					}

					$replaces['information_adult'] = $tmp;

					// information_child_1
					$tmp                  = '';
					$informationChildren1 = array();

					if (isset($data['information_child_1']) && $data['information_child_1'])
					{
						$informationChildren1 = $data['information_child_1'];
					}
					elseif (isset($item->information_child_1) && !empty($item->information_child_1))
					{
						$informationChildren1 = json_decode($item->information_child_1, true);
					}

					if (!empty($informationChildren1))
					{
						foreach ($informationChildren1 as $promotion)
						{
							$tmp .= Jtext::_('PAPIERSDEFAMILLES_FIELD_NAME') . ': ' . $promotion['name'] . '</br>';
							$tmp .= Jtext::_('PAPIERSDEFAMILLES_FIELD_SURNAME') . ': ' . $promotion['surname'] . '</br>';
							$tmp .= Jtext::_('PAPIERSDEFAMILLES_FIELD_BIRTHDAY') . ': ' . $promotion['birthday'] . '</br>';
						}
					}

					$replaces['information_child_1'] = $tmp;

					// information_child_2
					$tmp                  = '';
					$informationChildren2 = array();

					if (isset($data['information_child_2']) && $data['information_child_2'])
					{
						$informationChildren2 = $data['information_child_2'];
					}
					elseif (isset($item->information_child_2) && !empty($item->information_child_2))
					{
						$informationChildren2 = json_decode($item->information_child_2, true);
					}

					if (!empty($informationChildren2))
					{
						foreach ($informationChildren2 as $promotion)
						{
							$tmp .= Jtext::_('PAPIERSDEFAMILLES_FIELD_NAME') . ': ' . $promotion['name'] . '</br>';
							$tmp .= Jtext::_('PAPIERSDEFAMILLES_FIELD_SURNAME') . ': ' . $promotion['surname'] . '</br>';
							$tmp .= Jtext::_('PAPIERSDEFAMILLES_FIELD_BIRTHDAY') . ': ' . $promotion['birthday'] . '</br>';
						}
					}

					$replaces['information_child_2'] = $tmp;

					$replaces['name']     = $item->name;
					$replaces['surname']  = $item->surname;
					$replaces['phone']    = $item->phone;
					$replaces['address']  = $item->address;
					$replaces['zip_code'] = $item->zip_code;
					$replaces['city']     = $item->city;
					$replaces['birthday'] = JFactory::getDate($item->birthday)->format('d-m-Y');

					$replaces['ticket_price'] = '-';
					$replaces['ticket_total'] = '-';
					$replaces['discount']     = '-';

					if (!empty($priceTicketArray))
					{
						$replaces['ticket_price'] = $object->ticket_price;
						$replaces['ticket_total'] = $object->ticket_total;
						$replaces['discount']     = $object->discount;
					}

					$replaces['creation_date'] = JFactory::getDate($item->creation_date)->format('d-m-Y H:i');

					$replaces['link_admin'] = JUri::root() . 'administrator/index.php?option=com_papiersdefamilles&view=reservation&layout=reservation&cid=' . $item->id;
					$replaces['link_user']  = JUri::root() . 'index.php?option=com_papiersdefamilles&view=reservation&layout=reservation&cid=' . $item->id;


					// Desination

					$replaces['destination'] = $ticketType->destination;
					$replaces['email']       = $data['email'];

					$typeFlight              = PapiersdefamillesHelper::getTicketFlight($item->ticket_type_id, $item->departure_city_id, $item->departure_date);
					$replaces['ticket_type'] = '-';

					if ($typeFlight)
					{
						$replaces['ticket_type'] = Jtext::_(PapiersdefamillesHelperEnum::_('type_flight')[$typeFlight]['text']);
					}

					//Send email to user
					$user = JFactory::getUser($item->created_by);

					$params                   = json_decode(JComponentHelper::getParams('com_papiersdefamilles'));
					$params->user_email_body  = PapiersdefamillesHelper::replaceTags($params->user_email_body, $search, $replaces);
					$params->admin_email_body = PapiersdefamillesHelper::replaceTags($params->admin_email_body, $search, $replaces);

					$userEmail = $data['email'];

					PapiersdefamillesHelper::sendMail($userEmail, $params->user_email_subject, $params->user_email_body);

					//Send email to Admin
					$adminIds     = PapiersdefamillesHelper::getAdminGroup();
					$superUserIds = PapiersdefamillesHelper::getSuperUserGroup();

					foreach ($adminIds as $adminUser)
					{
						PapiersdefamillesHelper::sendMail($adminUser->email, $params->admin_email_subject, $params->admin_email_body);
					}

					foreach ($superUserIds as $superUser)
					{
						PapiersdefamillesHelper::sendMail($superUser->email, $params->admin_email_subject, $params->admin_email_body);
					}
				}

				// Redirect to paypal
				if ($this->getTask() == 'payment_paypal')
				{
					$object->is_quote = 0;

					$object->is_paypal        = 1;
					$object->is_paypal_refund = 0;
					$object->payment_status   = 0;
					$flagUpdate               = true;
				}

				if ($flagUpdate)
				{
					$object->id = $item->id;
					$model->update($object);
				}


				//die;
			}
		}
		else
			JError::raiseWarning(403, JText::sprintf('ACL_UNAUTORIZED_TASK', JText::_('PAPIERSDEFAMILLES_JTOOLBAR_SAVE')));

		$this->_result = $result;

		//Define the redirections
		switch ($this->getLayout() . '.' . $this->getTask())
		{
			case 'reservation.quotation_request':
				$app = JFactory::getApplication();
//				/$app->enqueueMessage(JText::_('PAPIERSDEFAMILLES_TEXT_BOOKING_SUCCESS'));
				//$app->redirect("index.php");
				$app->redirect(JRoute::_("index.php?option=com_content&view=article&id=24&Itemid=458", false));
				break;

			case 'reservation.payment_paypal':

				// Redirect to payment gateway
				if (isset($item->id))
				{
					self::redirectPaymentPaypal($item->id);

					return false;
				}
				else
				{
					$app = JFactory::getApplication();
					$app->enqueueMessage(JText::_('PAPIERSDEFAMILLES_TEXT_BOOKING_ERROR'), 'error');

					$app->redirect("index.php");
				}

				/*JFactory::getApplication()->enqueueMessage('PAPIERSDEFAMILLES_TEXT_BOOKING_SUCCESS');

				$this->setRedirect(
					JRoute::_("index.php", false)
				);*/
				break;

			/*case 'information.gotostep3':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.reservation.final'
				), array(
					'tickettype_id' => intval($ticketTypeId),
					'cid' => $model->getState('reservation.id')
				));
				break;*/

			//'com_papiersdefamilles.reservations.default'
			case 'reservation.save':
				/*$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.reservations.default'
				), array(
					'cid[]' => null
				));*/
				$app = JFactory::getApplication();
				//$app->enqueueMessage(JText::_('PAPIERSDEFAMILLES_TEXT_BOOKING_SUCCESS'));

				//$app->redirect("index.php");
				$app->redirect(JRoute::_("index.php?option=com_content&view=article&id=24&Itemid=458", false));
				break;

			case 'reservation.apply':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.reservation.reservation'
				), array(
					'cid[]' => $model->getState('reservation.id')
				));
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.reservations.default'
				));
				break;
		}
	}

	/**
	 * Method to ajax Get pricelist
	 *
	 * @access    public
	 *
	 * @return    void
	 */
	public function ajaxGetPriceList()
	{
		JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));

		$tickettypeId    = JRequest::getVar('tickettype_id', 0);
		$departureCityId = JRequest::getVar('selected_departure_city_id', 0);

		if (!$tickettypeId || !$departureCityId)
		{
			exit();
		}

		$modelTicketType = CkJModel::getInstance('tickettype', 'PapiersdefamillesModel');
		$ticketType      = $modelTicketType->getItem($tickettypeId);

		if (empty($ticketType->pricelist))
		{
			echo "0";
			exit();
		}

		if (!empty($ticketType->pricelist))
		{
			$priceList = json_decode($ticketType->pricelist);

			$priceFilterArr = array_filter(
				$priceList,
				function ($e) use ($departureCityId) {
					return ($e->departure_city_id == $departureCityId);
				}
			);

			if (empty($priceFilterArr))
			{
				echo "0";
				exit();
			}

			$config   = JFactory::getConfig();
			$fromname = $config->get('offset');
			date_default_timezone_set($fromname);

			$now      = date('Y-m-d');
			$nowDay   = date('d');
			$nowMonth = date('m');
			//$nowYear  = date('Y');
			$months = PapiersdefamillesHelperEnum::_('pricelists_month_id');


			// Find min price
			if (!empty($priceFilterArr) && isset($priceFilterArr[0]))
			{
				$min = ($nowDay < 16) ? $priceFilterArr[0]->price_1 : $priceFilterArr[0]->price_2;

				foreach ($priceFilterArr as $item)
				{
					if ($item->month_id)
					{
						$price = ($nowDay < 16) ? $item->price_1 : $item->price_2;

						if ($price < $min) $min = $price;
					}
				}
			}

			// Render pricelist
			$html = '<div class="pricelist-table">';


			foreach ($priceFilterArr as $item)
			{
				$class = (intval($item->month_id) === intval($nowMonth)) ? ' active' : '';

				if ($item->month_id)
				{
					$price = $item->price_2;

					if ($nowDay < 16) $price = $item->price_1;
					if (isset($min) && $min == $price) $class .= ' min_price';

					$html .= '<div class="pricelist-item ribbon' . $class . '">';
					$html .= '<span class="month">' . $months[$item->month_id]['text'] . '</span>';
					$html .= '<span class="year">.' . $item->year . '</span>';
					$html .= '<span class="position-right">';
					$html .= '<span class="price">' . $price . '</span>';
					$html .= '<span class="currency">€</span>';
					$html .= '<span class="last">TTC/<sub>pers</sub></span>';
					$html .= '</span>';
					$html .= '</div>';
				}
			}
			if (!empty($priceFilterArr) && isset($priceFilterArr[0]))
			{
				$html .= '<p class="note">' . JText::_('PAPIERSDEFAMILLES_TEXT_NOTICE_PRICE_BOOKING') . '</p>';
			}

			$html .= '</div>';


			echo $html;
		}

		exit();
	}


	/**
	 * Method to ajax Get pricelist
	 *
	 * @access    public
	 *
	 * @return    json (ticket_price, ticket_total, discount)
	 */
	public function ajaxGetTicketPrice()
	{
		JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));

		$jinput = JFactory::getApplication()->input;
		$data   = $jinput->get('jform', array(), 'ARRAY');

		if (!isset($data['tickettype_id']) || !isset($data['departure_city_id']) || !isset($data['departure_date']) || !isset($data['number_adult_ticket']) || !isset($data['type_flight']))
		{
			exit();
		}

		$priceTicketArray = PapiersdefamillesHelper::calculateTicketPrice($data['tickettype_id'], $data['departure_city_id'], $data['departure_date'],
			$data['number_adult_ticket'], $data['number_childrent_ticket_1'], $data['number_childrent_ticket_2']);

		if (!$priceTicketArray['ticket_price'])
		{
			echo 0;
			exit();
		}

		$arrTypeFlight = PapiersdefamillesHelper::getTicketFlight($data['tickettype_id'], $data['departure_city_id'], $data['departure_date']);

		// Not have list type flight
		if (empty($arrTypeFlight))
		{
			echo 1;
			exit();
		}

		// Not in list type flight
		if (!in_array(intval($data['type_flight']), $arrTypeFlight))
		{
			echo 2;
			exit();
		}

		$priceTicketText = array();

		$priceTicketText['ticket_price']       = Jtext::sprintf('PAPIERSDEFAMILLES_TEXT_TICKET_PRICE', $priceTicketArray['ticket_price']);
		$priceTicketText['ticket_price_total'] = Jtext::sprintf('PAPIERSDEFAMILLES_TEXT_TICKET_PRICE_TOTAL', $priceTicketArray['ticket_total'] - $priceTicketArray['discount']);
		$priceTicketText['ticket_total']       = Jtext::sprintf('PAPIERSDEFAMILLES_TEXT_TICKET_PRICE_GRAND_TOTAL', $priceTicketArray['ticket_total']);
		//$priceTicketText['ticket_type_flight'] = Jtext::sprintf('PAPIERSDEFAMILLES_TEXT_TICKET_TYPE_FLIGHT', $priceTicketArray['ticket_total']);

		echo json_encode($priceTicketText);

		exit();
	}

	/**
	 * Method to ajax Get Type Flight *
	 *
	 * @access    public
	 *
	 * @return    json (ticket_price, ticket_total, discount)
	 */
	public function ajaxGetTypeFlight()
	{
		JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));

		$jinput = JFactory::getApplication()->input;
		$data   = $jinput->get('jform', array(), 'ARRAY');

		if (!isset($data['tickettype_id']) || !isset($data['departure_city_id']) || !isset($data['departure_date']))
		{
			exit();
		}

		$priceTicket = PapiersdefamillesHelper::getTicketFlight($data['tickettype_id'], $data['departure_city_id'], $data['departure_date']);

		/*if ($priceTicket)
		{
			$priceTicket = Jtext::_(PapiersdefamillesHelperEnum::_('type_flight')[$priceTicket]['text']);
		}*/

		echo json_encode($priceTicket);

		exit();
	}

	/**
	 * Method to ajax Get pricelist
	 *
	 * @access    public
	 *
	 * @return    json (ticket_price, ticket_total, discount)
	 */
	public function ajaxGetInsuranceRateLuggage()
	{
		JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));

		$tickettypeId = JRequest::getVar('tickettype_id', 0);

		if (!$tickettypeId)
		{
			exit();
		}

		$modelTicketType = CkJModel::getInstance('tickettype', 'PapiersdefamillesModel');
		$ticketType      = $modelTicketType->getItem($tickettypeId);

		$priceTicketText['insurance_rate']           = Jtext::sprintf('PAPIERSDEFAMILLES_TEXT_TICKET_INSURANCE_RATE', $ticketType->insurance_rate);
		$priceTicketText['luggage_refund_rate_grid'] = Jtext::sprintf('PAPIERSDEFAMILLES_TEXT_TICKET_LUGGAGE_REFUND_RATE_GRID', $ticketType->luggage_refund_rate_grid);

		echo json_encode($priceTicketText);

		exit();
	}

	public function paymentPaypalExecute()
	{
		$config                    = JComponentHelper::getParams('com_papiersdefamilles');
		$merchant_id               = $config->get("merchant_id", '');
		$merchant_id_client_id     = $config->get("merchant_id_client_id", '');
		$merchant_id_client_secret = $config->get("merchant_id_client_secret", '');
		$sandbox                   = $config->get("sandbox", 'sandbox');

		if (empty($merchant_id_client_id) || empty($merchant_id_client_secret))
		{
			JFactory::getApplication()->enqueueMessage('PAPIERSDEFAMILLES_ERROR_CONFIG_PAYPAL');
			$app = JFactory::getApplication();
			$app->redirect("index.php");
		}

		$sdkConfig = array(
			"mode" => $sandbox
		);
		// After Step 1
		$apiContext = new \PayPal\Rest\ApiContext(
			new \PayPal\Auth\OAuthTokenCredential(
				$merchant_id_client_id,     // ClientID
				$merchant_id_client_secret      // ClientSecret
			),
			$sdkConfig
		);


		// Get payment object by passing paymentId
		$paymentId = $_GET['paymentId'];


		$payment = Payment::get($paymentId, $apiContext);
		$payerId = $_GET['PayerID'];

		// Execute payment with payer id
		$execution = new \PayPal\Api\PaymentExecution();
		$execution->setPayerId($payerId);

		$apiContext->resetRequestId();

		try
		{
			// Execute payment

			$result = $payment->execute($execution, $apiContext);


			$transactions  = $result->getTransactions();
			$transaction   = $transactions[0];
			$reservationId = $transaction->custom;

			// Update status and send Email
			$model = CkJModel::getInstance('Reservation', 'PapiersdefamillesModel');;

			$item = $model->getItem($reservationId);

			// Update
			$object->id             = $item->id;
			$object->payment_status = 1;
			$model->update($object);

			// Send Mail
			// Send Email
			$search             = array('[TICKET_TYPE_ID]',
				'[DEPARTURE_CITY]',
				'[DEPARTURE_DATE]',
				'[ARRIVAL_DATE]',
				'[NUMBER_ADULT_TICKET]',
				'[NUMBER_CHILDRENT_TICKET_1]',
				'[NUMBER_CHILDRENT_TICKET_2]',
				'[INFORMATION_ADULT]',
				'[INFORMATION_CHILD_1]',
				'[INFORMATION_CHILD_2]',
				'[NAME]',
				'[SURNAME]',
				'[PHONE]',
				'[ADDRESS]',
				'[ZIP_CODE]',
				'[CITY]',
				'[BIRTHDAY]',
				'[TICKET_PRICE]',
				'[TICKET_TOTAL]',
				'[DISCOUNT]',
				'[CREATION_DATE]',
				'[LINK_ADMIN]',
				'[LINK_USER]',
				'[DESTINATION]',
				'[EMAIL]',
				'[TICKET_TYPE]',
				'[IS_INSURANCE]',
				'[IS_BAGGAGE_INSURANCE]'
			);
			$modelDepartureCity = CkJModel::getInstance('Departurecity', 'PapiersdefamillesModel');
			$modelTicketType    = CkJModel::getInstance('Tickettype', 'PapiersdefamillesModel');

			$ticketType      = $modelTicketType->getItem($item->ticket_type_id);

			$replaces                              = array();
			$replaces['ticket_type_id']            = $ticketType->num_id;

			$modelDepartureCityId       = CkJModel::getInstance('Departurecity', 'PapiersdefamillesModel');
			$departureCity              = $modelDepartureCityId->getItem($item->departure_city_id);
			$replaces['departure_city'] = $departureCity->name;

			$replaces['departure_date']            = JFactory::getDate($item->departure_date)->format('d-m-Y');
			$replaces['arrival_date']              = JFactory::getDate($item->arrival_date)->format('d-m-Y');

			$replaces['number_adult_ticket']       = $item->number_adult_ticket;
			$replaces['number_childrent_ticket_1'] = ($item->number_childrent_ticket_1) ? $item->number_childrent_ticket_1 : '0';
			$replaces['number_childrent_ticket_2'] = ($item->number_childrent_ticket_2) ? $item->number_childrent_ticket_2 : '0';

			// information_adult
			$tmp              = '';
			$informationAdult = array();

			$replaces['information_adult'] = $tmp;

			// information_child_1
			$tmp                  = '';
			$replaces['information_child_1'] = $tmp;

			// information_child_2
			$tmp                  = '';
			$replaces['information_child_2'] = $tmp;

			$replaces['name']     = $item->name;
			$replaces['surname']  = $item->surname;
			$replaces['phone']    = $item->phone;
			$replaces['address']  = $item->address;
			$replaces['zip_code'] = $item->zip_code;
			$replaces['city']     = $item->city;
			$replaces['birthday'] = JFactory::getDate($item->birthday)->format('d-m-Y');

			$replaces['ticket_price'] = $item->ticket_price;
			$replaces['ticket_total'] = $item->ticket_total . '€';
			$replaces['discount']     = ($item->discount) ? $item->discount : 0;

			$replaces['creation_date'] = JFactory::getDate($item->creation_date)->format('d-m-Y H:i');

			$replaces['link_admin'] = JUri::root() . 'administrator/index.php?option=com_papiersdefamilles&view=reservation&layout=reservation&cid=' . $item->id;
			$replaces['link_user']  = JUri::root() . 'index.php?option=com_papiersdefamilles&view=reservation&layout=reservation&cid=' . $item->id;

			$replaces['destination'] = $ticketType->destination;
			$replaces['email']       = $item->email;

			$typeFlight              = PapiersdefamillesHelper::getTicketFlight($item->ticket_type_id, $item->departure_city_id, $item->departure_date);
			$replaces['ticket_type'] = '-';

			if ($typeFlight)
			{
				$replaces['ticket_type'] = Jtext::_(PapiersdefamillesHelperEnum::_('type_flight')[$typeFlight]['text']);
			}

			$replaces['is_insurance'] = ($item->is_insurance) ? Jtext::_('PAPIERSDEFAMILLES_FIELDS_BOOL_YES') : Jtext::_('PAPIERSDEFAMILLES_FIELDS_BOOL_NO');
			$replaces['is_baggage_insurance'] = ($item->is_baggage_insurance) ? Jtext::_('PAPIERSDEFAMILLES_FIELDS_BOOL_YES') : Jtext::_('PAPIERSDEFAMILLES_FIELDS_BOOL_NO');

			//Send email to user
			$user = JFactory::getUser($item->created_by);

			$params                   = json_decode(JComponentHelper::getParams('com_papiersdefamilles'));
			$params->user_email_paypal_body  = PapiersdefamillesHelper::replaceTags($params->user_email_paypal_body, $search, $replaces);
			$params->admin_email_paypal_body = PapiersdefamillesHelper::replaceTags($params->admin_email_paypal_body, $search, $replaces);

			$userEmail = $item->email;

			PapiersdefamillesHelper::sendMail($userEmail, $params->user_email_paypal_subject, $params->user_email_paypal_body);

			//Send email to Admin
			$adminIds     = PapiersdefamillesHelper::getAdminGroup();
			$superUserIds = PapiersdefamillesHelper::getSuperUserGroup();

			foreach ($adminIds as $adminUser)
			{
				PapiersdefamillesHelper::sendMail($adminUser->email, $params->admin_email_paypal_subject, $params->admin_email_paypal_body);
			}

			foreach ($superUserIds as $superUser)
			{
				PapiersdefamillesHelper::sendMail($superUser->email, $params->admin_email_paypal_subject, $params->admin_email_paypal_body);
			}

			//JFactory::getApplication()->enqueueMessage('PAPIERSDEFAMILLES_TEXT_BOOKING_SUCCESS');
			$app = JFactory::getApplication();
			//$app->redirect("index.php");
			$app->redirect(JRoute::_("index.php?option=com_content&view=article&id=24&Itemid=458", false));
		}
		catch (PayPal\Exception\PayPalConnectionException $ex)
		{
			echo $ex->getCode();
			echo $ex->getData();
			die($ex);
		}
		catch (Exception $ex)
		{
			die($ex);
		}
	}

	public function redirectPaymentPaypal($cid = 0)
	{
		$config                    = JComponentHelper::getParams('com_papiersdefamilles');
		$merchant_id               = $config->get("merchant_id", '');
		$merchant_id_client_id     = $config->get("merchant_id_client_id", '');
		$merchant_id_client_secret = $config->get("merchant_id_client_secret", '');
		$sandbox                   = $config->get("sandbox", 'sandbox');

		if (empty($merchant_id_client_id) || empty($merchant_id_client_secret) || $cid == 0)
		{
			JFactory::getApplication()->enqueueMessage('PAPIERSDEFAMILLES_ERROR_CONFIG_PAYPAL');
			$app = JFactory::getApplication();
			$app->redirect("index.php");
		}

		$model = $this->getModel();
		$item  = $model->getItem($cid);

		$desc = PapiersdefamillesHelper::generateInformationBooking($item->_ticket_type_id_num_id, $item->_ticket_type_id_destination, $item->_departurecity_id_name, $item->departure_date, $item->arrival_date);

		$sdkConfig = array(
			"mode" => $sandbox
		);
		// After Step 1
		$apiContext = new \PayPal\Rest\ApiContext(
			new \PayPal\Auth\OAuthTokenCredential(
				$merchant_id_client_id,     // ClientID
				$merchant_id_client_secret      // ClientSecret
			),
			$sdkConfig
		);

		// After Step 2
		$payer = new Payer();
		$payer->setPaymentMethod('paypal');

		$amount = new Amount();
		$amount->setTotal($item->ticket_total);
		$amount->setCurrency('USD');

		$transaction = new Transaction();
		$transaction->setAmount($amount);
		$transaction->setDescription($desc);
		$transaction->setCustom($item->id);

		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl(JUri::root() . "index.php?option=com_papiersdefamilles&view=reservation&layout=reservation&task=reservation.paymentPaypalExecute")
			//->setCancelUrl(JUri::root() . "index.php");
			->setCancelUrl(JUri::root() . "index.php?option=com_content&view=article&id=25&Itemid=459");

		$payment = new Payment();
		$payment->setIntent('sale')
			->setPayer($payer)
			->setTransactions(array($transaction))
			->setRedirectUrls($redirectUrls);

		$apiContext->resetRequestId();
		// After Step 3
		try
		{
			$payment->create($apiContext);

			/*echo "<pre>";
			print_r($payment);
			echo "</pre>";
			die;*/
			// Get PayPal redirect URL and redirect user
			$approvalUrl = $payment->getApprovalLink();

			header("Location: $approvalUrl");
			die;
		}
		catch (\PayPal\Exception\PayPalConnectionException $ex)
		{
			// This will print the detailed information on the exception.
			//REALLY HELPFUL FOR DEBUGGING
			echo $ex->getData();
		}
	}
}



