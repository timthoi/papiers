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
* @subpackage	Documents
*/
class PapiersdefamillesViewDocuments extends PapiersdefamillesClassView
{
	/**
	* List of the reachables layouts. Fill this array in every view file.
	*
	* @var array
	*/
	protected $layouts = array('default');

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
        // Solve session search
        PapiersdefamillesHelper::setInitSessionSearch();
        $sessionSearch = PapiersdefamillesHelper::getSearchSessionUser();

		$this->model		= $model	= $this->getModel();

    /*    $model->loadRelations('categories');
        $model->loadRelations('types');*/

		$this->state		= $state	= $this->get('State');
		$this->params 		= JComponentHelper::getParams('com_papiersdefamilles', true);
		$state->set('context', 'documents.default');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= PapiersdefamillesHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$this->filters = $filters = $model->getForm('default.filters');
		$this->menu = PapiersdefamillesHelper::addSubmenu('documents', 'default');
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('PAPIERSDEFAMILLES_LAYOUT_DOCUMENTS'));

		// FILTERs

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

        // Region > Title
        $modelRegions = CkJModel::getInstance('regions', 'PapiersdefamillesModel');
        $modelRegions->set('context', $modelRegions->get('context'));
        $filters['filter_region_id']->jdomOptions = array(
            'list' => $modelRegions->getItems()
        );

        // Countries > Title
        $modelCountries = CkJModel::getInstance('countries', 'PapiersdefamillesModel');
        $modelCountries->set('context', $modelCountries->get('context'));
        $filters['filter_country_id']->jdomOptions = array(
            'list' => $modelCountries->getItems()
        );

        // Districts > Title
        $modelDistricts = CkJModel::getInstance('districts', 'PapiersdefamillesModel');
        $modelDistricts->set('context', $modelDistricts->get('context'));
        $filters['filter_district_id']->jdomOptions = array(
            'list' => $modelDistricts->getItems()
        );

        // Categories > Title
        $modelCategories = CkJModel::getInstance('categories', 'PapiersdefamillesModel');
        $modelCategories->set('context', $modelCategories->get('context'));
        $filters['filter_category_id']->jdomOptions = array(
            'list' => $modelCategories->getItems()
        );

        // Typedocuments > Title
        $modelTypedocuments = CkJModel::getInstance('typedocuments', 'PapiersdefamillesModel');
        $modelTypedocuments->set('context', $modelTypedocuments->get('context'));
        $filters['filter_typedocument_id']->jdomOptions = array(
            'list' => $modelTypedocuments->getItems()
        );

		// Toolbar
		JToolBarHelper::title(JText::_('PAPIERSDEFAMILLES_LAYOUT_DOCUMENTS'), 'list');

		// New
		if ($model->canCreate())
			JToolBarHelper::addNew('document.add', "PAPIERSDEFAMILLES_JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
			JToolBarHelper::editList('document.edit', "PAPIERSDEFAMILLES_JTOOLBAR_EDIT");

		// Delete
		if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('PAPIERSDEFAMILLES_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'document.delete', "PAPIERSDEFAMILLES_JTOOLBAR_DELETE");

		// Publish
		if ($model->canEditState())
			JToolBarHelper::publishList('documents.publish', "PAPIERSDEFAMILLES_JTOOLBAR_PUBLISH");

		// Unpublish
		if ($model->canEditState())
			JToolBarHelper::unpublishList('documents.unpublish', "PAPIERSDEFAMILLES_JTOOLBAR_UNPUBLISH");
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
			'a.id' => JText::_('PAPIERSDEFAMILLES_FIELD_SORTABLE_ID'),
            'a.birthday' => JText::_('PAPIERSDEFAMILLES_FIELD_SORTABLE_DATE'),
            'a.locations' => JText::_('PAPIERSDEFAMILLES_FIELD_SORTABLE_DEPARTEMENT'),
            'a.main_persons' => JText::_('PAPIERSDEFAMILLES_FIELD_SORTABLE_MAIN_NAME'),
            'a.secondary_persons' => JText::_('PAPIERSDEFAMILLES_FIELD_SORTABLE_SECOND_NAME')
		);
	}


}



