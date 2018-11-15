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
* @subpackage	Reservations
*/
class PapiersdefamillesViewReservations extends PapiersdefamillesClassView
{
	/**
	* List of the reachables layouts. Fill this array in every view file.
	*
	* @var array
	*/
	protected $layouts = array('default', 'modal');

	/**
	* Execute and display a template : Reservations
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
		$this->model		= $model	= $this->getModel();
		$this->state		= $state	= $this->get('State');
		$this->params 		= JComponentHelper::getParams('com_papiersdefamilles', true);
		$state->set('context', 'reservations.default');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= PapiersdefamillesHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$this->filters = $filters = $model->getForm('default.filters');
		$this->menu = PapiersdefamillesHelper::addSubmenu('reservations', 'default');
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('PAPIERSDEFAMILLES_LAYOUT_RESERVATIONS'));

		

		// FILTERs
		// Ticket Type > Num ID
		$modelTicket_type_id = CkJModel::getInstance('documents', 'PapiersdefamillesModel');
		$modelTicket_type_id->set('context', $model->get('context'));
		$filters['filter_ticket_type_id']->jdomOptions = array(
			'list' => $modelTicket_type_id->getItems()
		);

		// Departure City > Name
		$modelDepartureCityId = CkJModel::getInstance('typedocuments', 'PapiersdefamillesModel');
		$modelDepartureCityId->set('context', $model->get('context'));
		$filters['filter_departure_city_id']->jdomOptions = array(
			'list' => $modelDepartureCityId->getItems()
		);

		// Created By > Name
		$modelCreatedBy = CkJModel::getInstance('thirdusers', 'PapiersdefamillesModel');
		$modelCreatedBy->set('context', $model->get('context'));
		$filters['filter_created_by']->jdomOptions = array(
			'list' => $modelCreatedBy->getItems()
		);

		// Sort by
		$filters['sortTable']->jdomOptions = array(
			'list' => $this->getSortFields('default')
		);

		// Limit
		$filters['limit']->jdomOptions = array(
			'pagination' => $this->pagination
		);

		// Toolbar
		JToolBarHelper::title(JText::_('PAPIERSDEFAMILLES_LAYOUT_RESERVATIONS'), 'list');

		// New
		if ($model->canCreate())
			JToolBarHelper::addNew('reservation.add', "PAPIERSDEFAMILLES_JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
			JToolBarHelper::editList('reservation.edit', "PAPIERSDEFAMILLES_JTOOLBAR_EDIT");

		// Delete
		if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('PAPIERSDEFAMILLES_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'reservation.delete', "PAPIERSDEFAMILLES_JTOOLBAR_DELETE");

		// Publish
		if ($model->canEditState())
			JToolBarHelper::publishList('reservations.publish', "PAPIERSDEFAMILLES_JTOOLBAR_PUBLISH");

		// Unpublish
		if ($model->canEditState())
			JToolBarHelper::unpublishList('reservations.unpublish', "PAPIERSDEFAMILLES_JTOOLBAR_UNPUBLISH");
	}

	/**
	* Execute and display a template : Reservations
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	*
	* @since	11.1
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*/
	protected function displayModal($tpl = null)
	{
		$this->model		= $model	= $this->getModel();
		$this->state		= $state	= $this->get('State');
		$this->params 		= JComponentHelper::getParams('com_papiersdefamilles', true);
		$state->set('context', 'reservations.modal');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= PapiersdefamillesHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$this->filters = $filters = $model->getForm('modal.filters');
		$this->menu = PapiersdefamillesHelper::addSubmenu('reservations', 'modal');
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('PAPIERSDEFAMILLES_LAYOUT_RESERVATIONS'));

		

		// FILTERs
		// Limit
		$filters['limit']->jdomOptions = array(
			'pagination' => $this->pagination
		);

		// Toolbar
		JToolBarHelper::title(JText::_('PAPIERSDEFAMILLES_LAYOUT_RESERVATIONS'), 'list');

		// Delete
		if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('PAPIERSDEFAMILLES_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'reservation.delete', "PAPIERSDEFAMILLES_JTOOLBAR_DELETE");

		// Publish
		if ($model->canEditState())
			JToolBarHelper::publishList('reservations.publish', "PAPIERSDEFAMILLES_JTOOLBAR_PUBLISH");

		// Unpublish
		if ($model->canEditState())
			JToolBarHelper::unpublishList('reservations.unpublish', "PAPIERSDEFAMILLES_JTOOLBAR_UNPUBLISH");
	}

	/**
	* Returns an array of fields the table can be sorted by.
	*
	* @access	protected
	* @param	string	$layout	The name of the called layout. Not used yet
	*
	*
	* @since	3.0
	*
	* @return	array	Array containing the field name to sort by as the key and display text as value.
	*/
	protected function getSortFields($layout = null)
	{
		return array(
			'a.ordering' => JText::_('PAPIERSDEFAMILLES_FIELD_ORDERING'),
			'a.creation_date' => JText::_('PAPIERSDEFAMILLES_FIELD_CREATION_DATE')
		);
	}


}



