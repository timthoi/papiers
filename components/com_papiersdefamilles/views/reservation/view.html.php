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



/**
* HTML View class for the Papiersdefamilles component
*
* @package	Papiersdefamilles
* @subpackage	Reservation
*/
class PapiersdefamillesViewReservation extends PapiersdefamillesClassView
{
	/**
	* List of the reachables layouts. Fill this array in every view file.
	*
	* @var array
	*/
	protected $layouts = array('default', 'reservation', 'information', 'final');

	/**
	* Execute and display a template : Reservation
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	*
	* @since	11.1
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*/
	protected function displayDefault($tpl = null)
	{
		// Initialiase variables.
		$this->model	= $model	= $this->getModel();
		$this->state	= $state	= $this->get('State');
		$this->params 	= $state->get('params');
		$state->set('context', 'reservation.default');
		$this->item		= $item		= $this->get('Item');
		$this->canDo	= $canDo	= PapiersdefamillesHelper::getActions($model->getId());
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('PAPIERSDEFAMILLES_LAYOUT_RESERVATION'), $this->item, 'departure_date');

		$user		= JFactory::getUser();
		$isNew		= ($model->getId() == 0);

		//Check ACL before opening the view (prevent from direct access)
		if (!$model->canAccess($item))
			$model->setError(JText::_('JERROR_ALERTNOAUTHOR'));

		// Check for errors.
		if (count($errors = $model->getErrors()))
		{
			JError::raiseError(500, implode(BR, array_unique($errors)));
			return false;
		}
		//Toolbar

		// Save & Close
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			JToolBarHelper::save('reservation.save', "PAPIERSDEFAMILLES_JTOOLBAR_SAVE_CLOSE");
		// Save
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			JToolBarHelper::apply('reservation.apply', "PAPIERSDEFAMILLES_JTOOLBAR_SAVE");
		// Cancel
		JToolBarHelper::cancel('reservation.cancel', "PAPIERSDEFAMILLES_JTOOLBAR_CANCEL");
		// Publish
		if (!$isNew && $model->canEditState($item) && ($item->published != 1))
			JToolBarHelper::publish('reservations.publish', "PAPIERSDEFAMILLES_JTOOLBAR_PUBLISH");
		// Unpublish
		if (!$isNew && $model->canEditState($item) && ($item->published != 0))
			JToolBarHelper::unpublish('reservations.unpublish', "PAPIERSDEFAMILLES_JTOOLBAR_UNPUBLISH");
		// Trash
		if (!$isNew && $model->canEditState($item) && ($item->published != -2))
			JToolBarHelper::trash('reservations.trash', "PAPIERSDEFAMILLES_JTOOLBAR_TRASH", false);
		// Archive
		if (!$isNew && $model->canEditState($item) && ($item->published != 2))
			JToolBarHelper::custom('reservations.archive', 'archive', 'archive',  "PAPIERSDEFAMILLES_JTOOLBAR_ARCHIVE", false);



		$this->toolbar = JToolbar::getInstance();

	}

	/**
	* Execute and display a template : Reservation
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	*
	* @since	11.1
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*/
	protected function displayReservation($tpl = null)
	{
		$tickettypeId = JRequest::getVar('tickettype_id', 0);
		$this->tickettypeId = $tickettypeId;

		$user		= JFactory::getUser();
		$userId		= $user->get('id');


		// Redirect for direct link
		if (!$tickettypeId)
		{
			$app = JFactory::getApplication();
			$app->enqueueMessage(JText::_('PAPIERSDEFAMILLES_ERROR_ACCESS_PERMISSION'), 'error');

			$app->redirect("index.php");
			return false;
		}

		$modelTicketType = CkJModel::getInstance('Tickettype', 'PapiersdefamillesModel');
		$ticketDetail = $modelTicketType->getItem($tickettypeId);
		// Increase hits
		$modelTicketType->setState('context', 'tickettype.tickettype');
		$hits = $modelTicketType->hitFake($tickettypeId);


		// Initialiase variables.
		$this->model	= $model	= $this->getModel();
		$this->state	= $state	= $this->get('State');
		$this->params 	= $state->get('params');
		$state->set('context', 'reservation.reservation');
		$this->item		= $item		= $this->get('Item');


		$reservationIds = PapiersdefamillesHelper::getIdReservationOfUser($userId);

		if (isset($item->id) && !in_array($item->id, $reservationIds))
		{
			$app = JFactory::getApplication();
			$app->enqueueMessage(JText::_('PAPIERSDEFAMILLES_ERROR_ACCESS_PERMISSION'), 'error');

			$app->redirect("index.php");
			return false;
		}

		$this->form		= $form		= $this->get('Form');
		$this->canDo	= $canDo	= PapiersdefamillesHelper::getActions($model->getId());
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('PAPIERSDEFAMILLES_LAYOUT_RESERVATION'), $this->item, 'departure_date');

		$user		= JFactory::getUser();
		$isNew		= ($model->getId() == 0);

		//Check ACL before opening the view (prevent from direct access)
		if (!$model->canAccess($item))
			$model->setError(JText::_('JERROR_ALERTNOAUTHOR'));

		// Check for errors.
		if (count($errors = $model->getErrors()))
		{
			JError::raiseError(500, implode(BR, array_unique($errors)));
			return false;
		}
		//Toolbar

		// Cancel
		JToolBarHelper::cancel('reservation.cancelDelete', "PAPIERSDEFAMILLES_JTOOLBAR_CANCEL");

		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
		{
			JToolBarHelper::save('reservation.save', "PAPIERSDEFAMILLES_JTOOLBAR_SAVE");
		}


		$this->toolbar = JToolbar::getInstance();

		$modelTicketTypes = CkJModel::getInstance('Tickettypes', 'PapiersdefamillesModel');
		$modelTicketTypes->addGroupOrder("a.num_id");
		$lists['fk']['ticket_type_id'] = $modelTicketTypes->getItems();


		$modelDepartureCityId = CkJModel::getInstance('Departurecities', 'PapiersdefamillesModel');
		$modelDepartureCityId->addGroupOrder("a.name");
		$lists['fk']['departure_city_id'] = $modelDepartureCityId->getItems();


		$modelTicketType = CkJModel::getInstance('Tickettype', 'PapiersdefamillesModel');
		$ticketDetail = $modelTicketType->getItem($tickettypeId);

		// Group by departure_city_id
		$pricelist = json_decode($ticketDetail->pricelist);
		$tmp = array();

		foreach($pricelist as $key => $value)
		{
		   $tmp[$value->departure_city_id][] = $value;
		}

		$this->pricelist = $tmp;


		// Get image gallery
		$this->item->gallery  = json_decode($ticketDetail->gallery_pic);
		$this->item->galleries = JFolder::files($this->item->gallery , '.jpg|.png|.jpeg', false, false, array());

		$this->ticketDetail = $ticketDetail;

		$this->item->main_pic  = ($ticketDetail->main_pic);

		// Add to recent hotels
		if (isset($tickettypeId) && $tickettypeId)
		{
			PapiersdefamillesHelper::setSessionRecentTickets($tickettypeId);
		}

		$this->ticketPriceArray = PapiersdefamillesHelper::geTicketPriceArray($tickettypeId);

	}


	/**
	* Execute and display a template : Information
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	*
	* @since	11.1
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*/
	protected function displayInformation($tpl = null)
	{

		$cid = JRequest::getVar('cid', 0);
		$tickettypeId = JRequest::getVar('tickettype_id', 0);

		$this->tickettypeId = $tickettypeId;
		
		// Redirect for direct link
		if (!$cid || !$tickettypeId)
		{
			$app = JFactory::getApplication();
			$app->enqueueMessage(JText::_('PAPIERSDEFAMILLES_ERROR_ACCESS_PERMISSION'), 'error');

			$app->redirect("index.php");
			return false;
		}
	
		// Initialiase variables.
		$this->model	= $model	= $this->getModel();
		$this->state	= $state	= $this->get('State');
		$this->params 	= $state->get('params');
		$state->set('context', 'reservation.reservation');
		$this->item		= $item		= $this->get('Item');

		$this->form		= $form		= $this->get('Form');
		$this->canDo	= $canDo	= PapiersdefamillesHelper::getActions($model->getId());
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('PAPIERSDEFAMILLES_LAYOUT_RESERVATION_INFORMATION'), $this->item, 'destination_name');

		$user		= JFactory::getUser();
		$isNew		= ($model->getId() == 0);

		//Check ACL before opening the view (prevent from direct access)
		if (!$model->canAccess($item))
			$model->setError(JText::_('JERROR_ALERTNOAUTHOR'));

		// Check for errors.
		if (count($errors = $model->getErrors()))
		{
			JError::raiseError(500, implode(BR, array_unique($errors)));
			return false;
		}
		//Toolbar

		// Cancel
		JToolBarHelper::cancel('reservation.cancelDelete', "PAPIERSDEFAMILLES_JTOOLBAR_CANCEL");

		// Save - redirect step1 = destination
		// step2 = input information of passenger
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			JToolBarHelper::apply('reservation.gotostep3', "PAPIERSDEFAMILLES_JTOOLBAR_SAVE");



		$this->toolbar = JToolbar::getInstance();

		$tickettypeId = JRequest::getVar('tickettype_id', 0);

		$modelTicketType = CkJModel::getInstance('Tickettype', 'PapiersdefamillesModel');
		$ticketDetail = $modelTicketType->getItem($tickettypeId);

		$this->item->gallery  = json_decode($ticketDetail->gallery_pic);
		$this->item->galleries = JFolder::files($this->item->gallery , '.jpg|.png|.jpeg', false, false, array());
		$this->ticketDetail = $ticketDetail;
		$this->cid = $cid;
		$this->$tickettypeId = $tickettypeId;
	}

	/**
	 * Execute and display a template : Final Checkout
	 *
	 * @access	protected
	 * @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	 *
	 *
	 * @since	11.1
	 *
	 * @return	mixed	A string if successful, otherwise a JError object.
	 */
	protected function displayFinal($tpl = null)
	{

		$cid = JRequest::getVar('cid', 0);
		$tickettypeId = JRequest::getVar('tickettype_id', 0);

		$this->tickettypeId = $tickettypeId;

		// Redirect for direct link
		if (!$cid || !$tickettypeId)
		{
			$app = JFactory::getApplication();
			$app->enqueueMessage(JText::_('PAPIERSDEFAMILLES_ERROR_ACCESS_PERMISSION'), 'error');

			$app->redirect("index.php");
			return false;
		}

		// Initialiase variables.
		$this->model	= $model	= $this->getModel();
		$this->state	= $state	= $this->get('State');
		$this->params 	= $state->get('params');
		$state->set('context', 'reservation.reservation');
		$this->item		= $item		= $this->get('Item');

		$this->form		= $form		= $this->get('Form');
		$this->canDo	= $canDo	= PapiersdefamillesHelper::getActions($model->getId());
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('PAPIERSDEFAMILLES_LAYOUT_RESERVATION_FINAL'), $this->item, 'destination_name');

		$user		= JFactory::getUser();
		$isNew		= ($model->getId() == 0);

		//Check ACL before opening the view (prevent from direct access)
		if (!$model->canAccess($item))
			$model->setError(JText::_('JERROR_ALERTNOAUTHOR'));

		// Check for errors.
		if (count($errors = $model->getErrors()))
		{
			JError::raiseError(500, implode(BR, array_unique($errors)));
			return false;
		}
		//Toolbar

		// Cancel
		JToolBarHelper::cancel('reservation.cancelDelete', "PAPIERSDEFAMILLES_JTOOLBAR_CANCEL");
		// Save - redirect step1 = destination
		// step2 = input information of passenger
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
		{
			JToolBarHelper::apply('reservation.sendQuote', "PAPIERSDEFAMILLES_JTOOLBAR_SEND_QUOTE");
			JToolBarHelper::apply('reservation.checkout', "PAPIERSDEFAMILLES_JTOOLBAR_PAY_ORDER");
		}


		$this->toolbar = JToolbar::getInstance();

		$tickettypeId = JRequest::getVar('tickettype_id', 0);

		$modelTicketType = CkJModel::getInstance('Tickettype', 'PapiersdefamillesModel');
		$ticketDetail = $modelTicketType->getItem($tickettypeId);

		$this->item->gallery  = json_decode($ticketDetail->gallery_pic);
		$this->item->galleries = JFolder::files($this->item->gallery , '.jpg|.png|.jpeg', false, false, array());
		$this->ticketDetail = $ticketDetail;
		$this->cid = $cid;
		$this->$tickettypeId = $tickettypeId;

		$departureDate = JFactory::getDate($this->item->departure_date)->format('l, d M Y');
		$arrivalDate = JFactory::getDate($this->item->arrival_date)->format('l, d M Y');

		$modelDepartureCityId = CkJModel::getInstance('Departurecity', 'PapiersdefamillesModel');
		$departureCity = $modelDepartureCityId->getItem($this->item->departure_city_id);

		$this->departureCity    = $departureCity->name;
		$this->departureDate    = $departureDate;
		$this->arrivalDate      = $arrivalDate;

	}

}



