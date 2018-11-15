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



/**
* Papiersdefamilles Reservation Controller
*
* @package	Papiersdefamilles
* @subpackage	Reservation
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
	* @access	public
	* @param	array	$config	An optional associative array of configuration settings.
	*
	* @return	void
	*/
	public function __construct($config = array())
	{
		parent::__construct($config);
		$app = JFactory::getApplication();

	}

	/**
	* Method to add an element.
	*
	* @access	public
	*
	* @return	void
	*/
	public function add()
	{
		JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
		$this->_result = $result = parent::add();
		$model = $this->getModel();

		//Define the redirections
		switch($this->getLayout() .'.'. $this->getTask())
		{
			case 'default.add':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.reservation.reservation'
				), array(
			
				));
				break;

			case 'modal.add':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.reservation.reservation'
				), array(
			
				));
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.reservation.reservation'
				));
				break;
		}
	}

	/**
	* Override method when the author allowed to delete own.
	*
	* @access	protected
	* @param	array	$data	An array of input data.
	* @param	string	$key	The name of the key for the primary key; default is id..
	*
	* @return	boolean	True on success
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
	* @access	protected
	* @param	array	$data	An array of input data.
	* @param	string	$key	The name of the key for the primary key; default is id..
	*
	* @return	boolean	True on success
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
	* @access	public
	* @param	string	$key	The name of the primary key of the URL variable.
	*
	* @return	void
	*/
	public function cancel($key = null)
	{
		$this->_result = $result = parent::cancel();
		$model = $this->getModel();

		//Define the redirections
		switch($this->getLayout() .'.'. $this->getTask())
		{
			case 'reservation.cancel':
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
	* Method to delete an element.
	*
	* @access	public
	*
	* @return	void
	*/
	public function delete()
	{
		JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
		$this->_result = $result = parent::delete();
		$model = $this->getModel();

		//Define the redirections
		switch($this->getLayout() .'.'. $this->getTask())
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
	* Method to edit an element.
	*
	* @access	public
	* @param	string	$key	The name of the primary key of the URL variable.
	* @param	string	$urlVar	The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
	*
	* @return	void
	*/
	public function edit($key = null, $urlVar = null)
	{
		JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
		$this->_result = $result = parent::edit();
		$model = $this->getModel();

		//Define the redirections
		switch($this->getLayout() .'.'. $this->getTask())
		{
			case 'default.edit':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.reservation.reservation'
				), array(
			
				));
				break;

			case 'modal.edit':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.reservation.reservation'
				), array(
			
				));
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.reservation.reservation'
				));
				break;
		}
	}

	/**
	* Return the current layout.
	*
	* @access	protected
	* @param	bool	$default	If true, return the default layout.
	*
	* @return	string	Requested layout or default layout
	*/
	protected function getLayout($default = null)
	{
		if ($default === 'edit')
			return 'reservation';

		if ($default)
			return 'reservation';

		$jinput = JFactory::getApplication()->input;
		return $jinput->get('layout', 'reservation', 'CMD');
	}

	/**
	* Method to save an element.
	*
	* @access	public
	* @param	string	$key	The name of the primary key of the URL variable.
	* @param	string	$urlVar	The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
	*
	* @return	void
	*/
	public function save($key = null, $urlVar = null)
	{
		JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
		//Check the ACLs
		$model = $this->getModel();
		$item = $model->getItem();
		$result = false;
		$itemIdOld = (isset($item->id)) ? : 0;

		if ($model->canEdit($item, true))
		{
			$result = parent::save();
			//Get the model through postSaveHook()
			if ($this->model)
			{
				$model = $this->model;
				$item = $model->getItem();
				$data = JRequest::getVar('jform');

				$object = new stdClass();
				$flagUpdate = false;

				$priceTicketArray = PapiersdefamillesHelper::calculateTicketPrice($item->ticket_type_id, $item->departure_city_id, $item->departure_date, $item->number_adult_ticket, $item->number_childrent_ticket_1, $item->number_childrent_ticket_2);

				if (!empty($priceTicketArray))
				{
					$flagUpdate = true;
					$object->ticket_price = $priceTicketArray['ticket_price'];
					$object->ticket_total = $priceTicketArray['ticket_total'];
					$object->discount = $priceTicketArray['discount'];
				}
				
				if (isset($data['information_adult']) && $data['information_adult'])
				{
					// JSon Type [{"field1":"value1","field2":"value2"}, {"field1":"value1","field2":"value2"}]
					$tmp = '[';
					
					foreach ($data['information_adult'] as $promotion)
					{
						$tmp .= '{"name":"' . $promotion['name'] . '", "surname":"' . $promotion['surname'] . '", "birthday":"' . $promotion['birthday'] . '"},';
					}

					$tmp  = rtrim($tmp, ",");
					$tmp .= ']';
					
					$object->information_adult = $tmp;
					$flagUpdate = true;
				}

				if (isset($data['information_child_1']) && $data['information_child_1'])
				{
					// JSon Type [{"field1":"value1","field2":"value2"}, {"field1":"value1","field2":"value2"}]
					$tmp = '[';
					
					foreach ($data['information_child_1'] as $promotion)
					{
						$tmp .= '{"name":"' . $promotion['name'] . '", "surname":"' . $promotion['surname'] . '", "birthday":"' . $promotion['birthday'] . '"},';
					}

					$tmp  = rtrim($tmp, ",");
					$tmp .= ']';
					
					$object->information_child_1 = $tmp;
					$flagUpdate = true;
				}

				if (isset($data['information_child_2']) && $data['information_child_2'])
				{
					// JSon Type [{"field1":"value1","field2":"value2"}, {"field1":"value1","field2":"value2"}]
					$tmp = '[';
					
					foreach ($data['information_child_2'] as $promotion)
					{
						$tmp .= '{"name":"' . $promotion['name'] . '", "surname":"' . $promotion['surname'] . '", "birthday":"' . $promotion['birthday'] . '"},';
					}

					$tmp  = rtrim($tmp, ",");
					$tmp .= ']';
					
					$object->information_child_2 = $tmp;
					$flagUpdate = true;
				}


				//var_dump($priceTicket);die;
				if ($flagUpdate)
				{
					$object->id = $item->id;
					$model->update($object);
				}

			}
		}
		else
			JError::raiseWarning( 403, JText::sprintf('ACL_UNAUTORIZED_TASK', JText::_('PAPIERSDEFAMILLES_JTOOLBAR_SAVE')) );

		$this->_result = $result;

		//Define the redirections
		switch($this->getLayout() .'.'. $this->getTask())
		{
			case 'reservation.save':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.reservations.default'
				), array(
					'cid[]' => null
				));
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


}



