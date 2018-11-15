<?php
/**
* @version		
* @package		Papiersdefamilles
* @subpackage	Type documents
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
* @subpackage	Typedocuments
*/
class PapiersdefamillesViewTypedocuments extends PapiersdefamillesClassView
{
	/**
	* List of the reachables layouts. Fill this array in every view file.
	*
	* @var array
	*/
	protected $layouts = array('default', 'modal');

	/**
	* Execute and display a template : Type documents
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
		$state->set('context', 'typedocuments.default');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= PapiersdefamillesHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$this->filters = $filters = $model->getForm('default.filters');
		$this->menu = PapiersdefamillesHelper::addSubmenu('typedocuments', 'default');
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('PAPIERSDEFAMILLES_LAYOUT_TYPEDOCUMENTS'));

		// FILTERs
		// Sort by
		$filters['sortTable']->jdomOptions = array(
			'list' => $this->getSortFields('default')
		);

		// Limit
		$filters['limit']->jdomOptions = array(
			'pagination' => $this->pagination
		);

		// Toolbar
		JToolBarHelper::title(JText::_('PAPIERSDEFAMILLES_LAYOUT_TYPEDOCUMENTS'), 'list');

		// New
		if ($model->canCreate())
			JToolBarHelper::addNew('typedocument.add', "PAPIERSDEFAMILLES_JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
			JToolBarHelper::editList('typedocument.edit', "PAPIERSDEFAMILLES_JTOOLBAR_EDIT");

		// Delete
		if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('PAPIERSDEFAMILLES_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'typedocument.delete', "PAPIERSDEFAMILLES_JTOOLBAR_DELETE");

		// Publish
		if ($model->canEditState())
			JToolBarHelper::publishList('typedocuments.publish', "PAPIERSDEFAMILLES_JTOOLBAR_PUBLISH");

		// Unpublish
		if ($model->canEditState())
			JToolBarHelper::unpublishList('typedocuments.unpublish', "PAPIERSDEFAMILLES_JTOOLBAR_UNPUBLISH");
	}

	/**
	* Execute and display a template : Type documents
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
		$state->set('context', 'typedocuments.modal');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= PapiersdefamillesHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$this->filters = $filters = $model->getForm('modal.filters');
		$this->menu = PapiersdefamillesHelper::addSubmenu('typedocuments', 'modal');
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('PAPIERSDEFAMILLES_LAYOUT_TYPEDOCUMENTS'));

		

		// FILTERs
		// Limit
		$filters['limit']->jdomOptions = array(
			'pagination' => $this->pagination
		);

		// Toolbar
		JToolBarHelper::title(JText::_('PAPIERSDEFAMILLES_LAYOUT_TYPEDOCUMENTS'), 'list');


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
			'a.name' => JText::_('PAPIERSDEFAMILLES_FIELD_NAME')
		);
	}


}



