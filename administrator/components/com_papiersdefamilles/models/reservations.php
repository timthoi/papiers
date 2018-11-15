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
* Papiersdefamilles List Model
*
* @package	Papiersdefamilles
* @subpackage	Classes
*/
class PapiersdefamillesModelReservations extends PapiersdefamillesClassModelList
{
	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'reservation';

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
		// Define the sortables fields (in lists)
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'ordering', 'a.ordering',
				'creation_date', 'a.creation_date',
				'_departure_city_id_name', '_departure_city_id_.name',

			);
		}

		//Define the filterable fields
		$this->set('filter_vars', array(
			'published' => 'cmd',
			'sortTable' => 'cmd',
			'directionTable' => 'cmd',
			'limit' => 'cmd',
			'departure_date' => 'date:Y-m-d',
			'arrival_date' => 'date:Y-m-d',
			'ticket_type_id' => 'cmd',
			'departure_city_id' => 'cmd',
			'created_by' => 'cmd',
			'modification_date_from' => 'varchar',
			'modification_date_to' => 'varchar',
			'creation_date_from' => 'varchar',
			'creation_date_to' => 'varchar'
				));

		//Define the searchable fields
		$this->set('search_vars', array(
			'search' => 'string'
				));


		parent::__construct($config);

		$this->hasOne('ticket_type_id', // name
			'documents', // foreignModelClass
			'ticket_type_id', // localKey
			'id', // foreignKey
			array() // selectFields
		);

		$this->hasOne('departure_city_id', // name
			'typedocuments', // foreignModelClass
			'departure_city_id', // localKey
			'id', // foreignKey
			array() // selectFields
		);
	}

	/**
	* Method to get a list of items.
	*
	* @access	public
	*
	*
	* @since	11.1
	*
	* @return	mixed	An array of data items on success, false on failure.
	*/
	public function getItems()
	{

		$items	= parent::getItems();
		$app	= JFactory::getApplication();


		$this->populateParams($items);

		//Create linked objects
		$this->populateObjects($items);

		return $items;
	}

	/**
	* Method to get the layout (including default).
	*
	* @access	public
	*
	* @return	string	The layout alias.
	*/
	public function getLayout()
	{
		$jinput = JFactory::getApplication()->input;
		return $jinput->get('layout', 'default', 'STRING');
	}

	/**
	* Method to get a store id based on model configuration state.
	* 
	* This is necessary because the model is used by the component and different
	* modules that might need different sets of data or differen ordering
	* requirements.
	*
	* @access	protected
	* @param	string	$id	A prefix for the store id.
	*
	*
	* @since	1.6
	*
	* @return	void
	*/
	protected function getStoreId($id = '')
	{
		// Compile the store id.

		$id	.= ':'.$this->getState('sortTable');
		$id	.= ':'.$this->getState('directionTable');
		$id	.= ':'.$this->getState('limit');
		$id	.= ':'.$this->getState('filter.published');
		$id	.= ':'.$this->getState('filter.departure_date');
		$id	.= ':'.$this->getState('filter.arrival_date');
		$id	.= ':'.$this->getState('filter.ticket_type_id');
		$id	.= ':'.$this->getState('filter.created_by');
		$id	.= ':'.$this->getState('filter.modification_date');
		$id	.= ':'.$this->getState('filter.creation_date');
		$id	.= ':'.$this->getState('search.search');
		$id	.= ':'.$this->getState('filter.departure_city_id');
		return parent::getStoreId($id);
	}

	/**
	* Method to auto-populate the model state.
	* 
	* This method should only be called once per instantiation and is designed to
	* be called on the first call to the getState() method unless the model
	* configuration flag to ignore the request is set.
	* 
	* Note. Calling getState in this method will result in recursion.
	*
	* @access	protected
	* @param	string	$ordering	
	* @param	string	$direction	
	*
	*
	* @since	11.1
	*
	* @return	void
	*/
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication();
		$session = JFactory::getSession();
		$acl = PapiersdefamillesHelper::getActions();


		parent::populateState(
			($ordering?$ordering:'a.creation_date'),
			($direction?$direction:'desc')
		);

		// Only show the published items
		if (!$acl->get('core.admin') && !$acl->get('core.edit.state'))
		{
			$this->setState('filter.published', 1);
		}
	}

	/**
	* Preparation of the list query.
	*
	* @access	protected
	* @param	object	&$query	returns a filled query object.
	*
	* @return	void
	*/
	protected function prepareQuery(&$query)
	{

		$acl = PapiersdefamillesHelper::getActions();

		// FROM : Main table
		$query->from('#__papiersdefamilles_reservations AS a');



		// IMPORTANT REQUIRED FIELDS
		$this->addSelect(	'a.id,'
						.	'a.created_by,'
						.	'a.departure_city_id,'
						.	'a.published');

		// BASE FIELDS
		$this->addSelect(	'a.arrival_date,'
						.	'a.creation_date,'
						.	'a.departure_date,'
						.	'a.email,'
						.	'a.is_paypal,'
						.	'a.is_paypal_refund,'
						.	'a.is_quote,'
						.	'a.modification_date,'
						.	'a.modified_by,'
						.	'a.name,'
						.	'a.ordering,'
						.	'a.payment_status,'
						.	'a.phone,'
						.	'a.surname,'
						.	'a.ticket_price,'
						.	'a.is_insurance,'
						.	'a.gender,'
						.	'a.insurance_price,'
						.	'a.is_baggage_insurance,'
						.	'a.baggage_insurance_price,'
						.	'a.ticket_total,'
						.	'a.ticket_type_id');

		// SELECT
		$this->addSelect('_ticket_type_id_.num_id AS `_ticket_type_id_num_id`');
		$this->addSelect('_created_by_.name AS `_created_by_name`');
		$this->addSelect('_modified_by_.name AS `_modified_by_name`');
		// SELECT
		$this->addSelect('_departure_city_id_.name AS `_departure_city_id_name`');

		// JOIN
		$this->addJoin('`#__papiersdefamilles_departurecities` AS _departure_city_id_ ON _departure_city_id_.id = a.departure_city_id', 'LEFT');
		$this->addJoin('`#__papiersdefamilles_tickettypes` AS _ticket_type_id_ ON _ticket_type_id_.id = a.ticket_type_id', 'LEFT');
		$this->addJoin('`#__users` AS _created_by_ ON _created_by_.id = a.created_by', 'LEFT');
		$this->addJoin('`#__users` AS _modified_by_ ON _modified_by_.id = a.modified_by', 'LEFT');


		switch($this->getState('context', 'all'))
		{
			case 'reservations.default':

				
				break;

			case 'reservations.modal':

				// BASE FIELDS
				$this->addSelect(	'a.departure_date');


				break;
			case 'all':
				// SELECT : raw complete query without joins
				$this->addSelect('a.*');

				// Disable the pagination
				$this->setState('list.limit', null);
				$this->setState('list.start', null);
				break;
		}

		// FILTER - Access for : Root table
		$wherePublished = $allowAuthor = true;
		$whereAccess = false;
		$this->prepareQueryAccess('a', $whereAccess, $wherePublished, $allowAuthor);
		$query->where("($allowAuthor OR $wherePublished)");

		// WHERE - FILTER : Publish state
		$published = $this->getState('filter.published');
		if (is_numeric($published))
		{
			$allowAuthor = '';
			if (($published == 1) && !$acl->get('core.edit.state')) //ACL Limit to publish = 1
			{
				//Allow the author to see its own unpublished/archived/trashed items
				if ($acl->get('core.edit.own') || $acl->get('core.view.own'))
					$allowAuthor = ' OR a.created_by = ' . (int)JFactory::getUser()->get('id');
			}
			$query->where('(a.published = ' . (int) $published . $allowAuthor . ')');
		}
		elseif (!$published)
		{
			$query->where('(a.published = 0 OR a.published = 1 OR a.published IS NULL)');
		}

		if ($filter_departure_city_id = $this->getState('filter.departure_city_id'))
		{
			if ($filter_departure_city_id > 0)
			{
				$this->addWhere("a.departure_city_id = " . (int)$filter_departure_city_id);
			}
		}

		if ($filter_departure_date = $this->getState('filter.departure_date'))
		{
		if ($filter_departure_date !== null){
				$this->addWhere("a.departure_date = " . $this->_db->Quote($filter_departure_date));
		}
		}

		if ($filter_arrival_date = $this->getState('filter.arrival_date'))
		{
		if ($filter_arrival_date !== null){
				$this->addWhere("a.arrival_date = " . $this->_db->Quote($filter_arrival_date));
		}
		}

		if ($filter_ticket_type_id = $this->getState('filter.ticket_type_id'))
		{
		if ($filter_ticket_type_id > 0){
				$this->addWhere("a.ticket_type_id = " . (int)$filter_ticket_type_id);
		}
		}

		if ($filterCreatedBy = $this->getState('filter.created_by'))
		{
		if ($filterCreatedBy == 'auto'){
		$this->addWhere('a.created_by = ' . (int)JFactory::getUser()->get('id'));
		}
		else 
		if ($filterCreatedBy > 0){
				$this->addWhere("a.created_by = " . (int)$filterCreatedBy);
		}
		}

		if ($filter_modification_date_from = $this->getState('filter.modification_date_from'))
		{
		if ($filter_modification_date_from !== null){
				$this->addWhere("a.modification_date >= " . $this->_db->Quote($filter_modification_date_from));
		}
		}

		if ($filter_modification_date_to = $this->getState('filter.modification_date_to'))
		{
		if ($filter_modification_date_to !== null){
				$this->addWhere("a.modification_date <= " . $this->_db->Quote($filter_modification_date_to));
		}
		}

		if ($filterCreationDateFrom = $this->getState('filter.creation_date_from'))
		{
		if ($filterCreationDateFrom !== null){
				$this->addWhere("a.creation_date >= " . $this->_db->Quote($filterCreationDateFrom));
		}
		}

		if ($filterCreationDateTo = $this->getState('filter.creation_date_to'))
		{
		if ($filterCreationDateTo !== null){
				$this->addWhere("a.creation_date <= " . $this->_db->Quote($filterCreationDateTo));
		}
		}

		// WHERE - SEARCH : search_search : search on Number Adult Ticket + Number Childrent Ticket 1 + Number Childrent Ticket 2 + Information Adult + Information Child 1 + Information Child 2 + Name + Surname + Phone + Address + Zip Code + City + Email + Ticket Price + Ticket Total
		$search_search = $this->getState('search.search');
		$this->addSearch('search', 'a.number_adult_ticket', 'like');
		$this->addSearch('search', 'a.number_childrent_ticket_1', 'like');
		$this->addSearch('search', 'a.number_childrent_ticket_2', 'like');
		$this->addSearch('search', 'a.information_adult', 'like');
		$this->addSearch('search', 'a.information_child_1', 'like');
		$this->addSearch('search', 'a.information_child_2', 'like');
		$this->addSearch('search', 'a.name', 'like');
		$this->addSearch('search', 'a.surname', 'like');
		$this->addSearch('search', 'a.phone', 'like');
		$this->addSearch('search', 'a.address', 'like');
		$this->addSearch('search', 'a.zip_code', 'like');
		$this->addSearch('search', 'a.city', 'like');
		$this->addSearch('search', 'a.email', 'like');
		$this->addSearch('search', 'a.ticket_price', 'like');
		$this->addSearch('search', 'a.ticket_total', 'like');
		if (($search_search != '') && ($search_search_val = $this->buildSearch('search', $search_search)))
			$this->addWhere($search_search_val);

		// Apply all SQL directives to the query
		$this->applySqlStates($query);
	}


}



