<?php
/**
* @version		
* @package		Papiersdefamilles
* @subpackage	Ticket Types
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
* @subpackage	Tickettypes
*/
class PapiersdefamillesViewTickettypes extends PapiersdefamillesClassView
{
	/**
	* List of the reachables layouts. Fill this array in every view file.
	*
	* @var array
	*/
	protected $layouts = array('default', 'modal');

	/**
	* Execute and display a template : Ticket Types
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
		$state->set('context', 'tickettypes.default');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= PapiersdefamillesHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$this->filters = $filters = $model->getForm('default.filters');
		$this->menu = PapiersdefamillesHelper::addSubmenu('tickettypes', 'default');
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('PAPIERSDEFAMILLES_LAYOUT_TICKET_TYPES'));

		

		// FILTERs
		// Continents
		$modelContinents = CkJModel::getInstance('Continents', 'PapiersdefamillesModel');
		$modelContinents->set('context', $model->get('context'));
		$filters['filter_continent_id']->jdomOptions = array(
			'list' => $modelContinents->getItems()
		);

		// Countries
		$modelCountries = CkJModel::getInstance('Countries', 'PapiersdefamillesModel');
		$modelCountries->set('context', $model->get('context'));
		$filters['filter_country_id']->jdomOptions = array(
			'list' => $modelCountries->getItems()
		);

		// Cities
		$modelCities = CkJModel::getInstance('Cities', 'PapiersdefamillesModel');
		$modelCities->set('context', $model->get('context'));
		$filters['filter_city_id']->jdomOptions = array(
			'list' => $modelCities->getItems()
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
		JToolBarHelper::title(JText::_('PAPIERSDEFAMILLES_LAYOUT_TICKET_TYPES'), 'list');

		// New
		if ($model->canCreate())
			JToolBarHelper::addNew('tickettype.add', "PAPIERSDEFAMILLES_JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
			JToolBarHelper::editList('tickettype.edit', "PAPIERSDEFAMILLES_JTOOLBAR_EDIT");

		// Delete
		if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('PAPIERSDEFAMILLES_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'tickettype.delete', "PAPIERSDEFAMILLES_JTOOLBAR_DELETE");

		// Publish
		if ($model->canEditState())
			JToolBarHelper::publishList('tickettypes.publish', "PAPIERSDEFAMILLES_JTOOLBAR_PUBLISH");

		// Unpublish
		if ($model->canEditState())
			JToolBarHelper::unpublishList('tickettypes.unpublish', "PAPIERSDEFAMILLES_JTOOLBAR_UNPUBLISH");
	}

	/**
	* Execute and display a template : Ticket Types
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
		$state->set('context', 'tickettypes.modal');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= PapiersdefamillesHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$this->filters = $filters = $model->getForm('modal.filters');
		$this->menu = PapiersdefamillesHelper::addSubmenu('tickettypes', 'modal');
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('PAPIERSDEFAMILLES_LAYOUT_TICKET_TYPES'));

		

		// FILTERs
		// Limit
		$filters['limit']->jdomOptions = array(
			'pagination' => $this->pagination
		);

		// Toolbar
		JToolBarHelper::title(JText::_('PAPIERSDEFAMILLES_LAYOUT_TICKET_TYPES'), 'list');


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
			'a.ordering' => JText::_('PAPIERSDEFAMILLES_FIELD_ORDERING')
		);
	}


}



