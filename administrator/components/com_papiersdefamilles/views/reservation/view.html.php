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
	protected $layouts = array('reservation');

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
		$this->_prepareDocument(JText::_('PAPIERSDEFAMILLES_LAYOUT_RESERVATION'), $this->item, 'departure_date');

		$user		= JFactory::getUser();
		$isNew		= ($model->getId() == 0);

		//Check ACL before opening the form (prevent from direct access)
		if (!$model->canEdit($item, true))
			$model->setError(JText::_('JERROR_ALERTNOAUTHOR'));

		// Check for errors.
		if (count($errors = $model->getErrors()))
		{
			JError::raiseError(500, implode(BR, array_unique($errors)));
			return false;
		}
		//Toolbar
		JToolBarHelper::title(JText::_('PAPIERSDEFAMILLES_LAYOUT_RESERVATION'), 'pencil-2');

		// Save & Close
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			JToolBarHelper::save('reservation.save', "PAPIERSDEFAMILLES_JTOOLBAR_SAVE_CLOSE");
		// Save
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			JToolBarHelper::apply('reservation.apply', "PAPIERSDEFAMILLES_JTOOLBAR_SAVE");
		// Cancel
		JToolBarHelper::cancel('reservation.cancel', "PAPIERSDEFAMILLES_JTOOLBAR_CANCEL");

		$modelTicketTypeId = CkJModel::getInstance('Tickettypes', 'PapiersdefamillesModel');
		$modelTicketTypeId->addGroupOrder("a.num_id");
		$lists['fk']['ticket_type_id'] = $modelTicketTypeId->getItems();


		$modelDepartureCityId = CkJModel::getInstance('Departurecities', 'PapiersdefamillesModel');
		$modelDepartureCityId->addGroupOrder("a.name");
		$lists['fk']['departure_city_id'] = $modelDepartureCityId->getItems();

		$modelUserId = CkJModel::getInstance('ThirdUsers', 'PapiersdefamillesModel');
		$modelUserId->addGroupOrder("a.name");
		$lists['fk']['user_id'] = $modelUserId->getItems();
	}


}



