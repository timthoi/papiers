<?php
/**
* @version		
* @package		Papiersdefamilles
* @subpackage	Regions
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
* @subpackage	Regions
*/
class PapiersdefamillesViewRegions extends PapiersdefamillesClassView
{
	/**
	* List of the reachables layouts. Fill this array in every view file.
	*
	* @var array
	*/
	protected $layouts = array('default');

	/**
	* Execute and display a template : Regions
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
		$state->set('context', 'regions.default');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= PapiersdefamillesHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$this->filters = $filters = $model->getForm('default.filters');
		$this->menu = PapiersdefamillesHelper::addSubmenu('regions', 'default');
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('PAPIERSDEFAMILLES_LAYOUT_REGIONS'));

		

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
		JToolBarHelper::title(JText::_('PAPIERSDEFAMILLES_LAYOUT_REGIONS'), 'list');

		// New
		if ($model->canCreate())
			JToolBarHelper::addNew('region.add', "PAPIERSDEFAMILLES_JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
			JToolBarHelper::editList('region.edit', "PAPIERSDEFAMILLES_JTOOLBAR_EDIT");

		// Delete
		if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('PAPIERSDEFAMILLES_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'region.delete', "PAPIERSDEFAMILLES_JTOOLBAR_DELETE");

		// Publish
		if ($model->canEditState())
			JToolBarHelper::publishList('regions.publish', "PAPIERSDEFAMILLES_JTOOLBAR_PUBLISH");

		// Unpublish
		if ($model->canEditState())
			JToolBarHelper::unpublishList('regions.unpublish', "PAPIERSDEFAMILLES_JTOOLBAR_UNPUBLISH");
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
			'a.name' => JText::_('PAPIERSDEFAMILLES_FIELD_NAME'),
			'_continent_.name' => JText::_('PAPIERSDEFAMILLES_FIELD_CONTINENT_NAME'),
			'_country_.name' => JText::_('PAPIERSDEFAMILLES_FIELD_COUNTRY_NAME')
		);
	}


}


