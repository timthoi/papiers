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
* Papiersdefamilles List Model
*
* @package	Papiersdefamilles
* @subpackage	Classes
*/
class PapiersdefamillesModelTickettypes extends PapiersdefamillesClassModelList
{
	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'tickettype';

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

			);
		}

		//Define the filterable fields
		$this->set('filter_vars', array(
			'published' => 'cmd',
			'sortTable' => 'cmd',
			'directionTable' => 'cmd',
			'limit' => 'cmd',
			'city_id' => 'cmd',
			'country_id' => 'cmd',
			'continent_id' => 'cmd',
			
			'creation_date_from' => 'varchar',
			'creation_date_to' => 'varchar',
			'created_by' => 'cmd'
				));

		//Define the searchable fields
		$this->set('search_vars', array(
			'search' => 'string'
				));


		parent::__construct($config);

		$this->hasOne('city_id', // name
			'cities', // foreignModelClass
			'city_id', // localKey
			'id', // foreignKey
			array() // selectFields
		);

		$this->hasOne('country_id', // name
			'countries', // foreignModelClass
			'country_id', // localKey
			'id', // foreignKey
			array() // selectFields
		);

		$this->hasOne('continent_id', // name
			'continents', // foreignModelClass
			'continent_id', // localKey
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
		$id	.= ':'.$this->getState('filter.city_id');
		$id	.= ':'.$this->getState('filter.country_id');
		$id	.= ':'.$this->getState('filter.continent_id');
		
		$id	.= ':'.$this->getState('filter.creation_date');
		$id	.= ':'.$this->getState('filter.created_by');
		$id	.= ':'.$this->getState('search.search');
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
			($ordering?$ordering:'a.ordering'),
			($direction?$direction:'asc')
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
		$query->from('#__PAPIERSDEFAMILLES_tickettypes AS a');



		// IMPORTANT REQUIRED FIELDS
		$this->addSelect(	'a.id,'
						.	'a.created_by,'
						.	'a.published');

		// BASE FIELDS
		$this->addSelect(	'a.city_id,'
						.	'a.creation_date,'
						.	'a.pricelist,'
						.	'a.destination,'
						.	'a.insurance_rate,'
						.	'a.is_good_plan,'
						.	'a.is_online,'
						.	'a.is_online_quote,'
						.	'a.lowest_price,'
						.	'a.luggage_refund_rate_grid,'
						.	'a.main_pic,'
						.	'a.num_id,'
						.	'a.ordering,'
						.	'a.short_presentation,'
						.	'a.continent_id,'
						.	'a.country_id');

		// SELECT
		$this->addSelect('_created_by_.name AS `_created_by_name`');

		$this->addSelect('_city_id_.name AS `_city_id_name`');
		$this->addSelect('_country_id_.name AS `_country_id_name`');
		$this->addSelect('_continent_id_.name AS `_continent_id_name`');
		

		// JOIN
		$this->addJoin('`#__PAPIERSDEFAMILLES_cities` AS _city_id_ ON _city_id_.id = a.city_id', 'LEFT');
		$this->addJoin('`#__PAPIERSDEFAMILLES_countries` AS _country_id_ ON _country_id_.id = a.country_id', 'LEFT');
		$this->addJoin('`#__PAPIERSDEFAMILLES_continents` AS _continent_id_ ON _continent_id_.id = a.continent_id', 'LEFT');
		
		$this->addJoin('`#__users` AS _created_by_ ON _created_by_.id = a.created_by', 'LEFT');


		switch($this->getState('context', 'all'))
		{
			case 'tickettypes.default':

				
				break;

			case 'tickettypes.modal':

				// BASE FIELDS
				$this->addSelect(	'a.num_id');


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

		if ($filterCityId = $this->getState('filter.city_id'))
		{
			if ($filterCityId > 0)
			{
					$this->addWhere("a.city_id = " . (int)$filterCityId);
			}
		}

		if ($filterCountryId = $this->getState('filter.country_id'))
		{
			if ($filterCountryId > 0)
			{
				$this->addWhere("a.country_id = " . (int)$filterCountryId);
			}
		}

		if ($filterContinentId = $this->getState('filter.continent_id'))
		{
			if ($filterContinentId > 0)
			{
				$this->addWhere("a.continent_id = " . (int)$filterContinentId);
			}
		}

		
		if ($filterCreationDateFrom = $this->getState('filter.creation_date_from'))
		{
			if ($filterCreationDateFrom !== null)
			{
					$this->addWhere("a.creation_date >= " . $this->_db->Quote($filterCreationDateFrom));
			}
		}

		if ($filterCreationDateTo = $this->getState('filter.creation_date_to'))
		{
			if ($filterCreationDateTo !== null)
			{
					$this->addWhere("a.creation_date <= " . $this->_db->Quote($filterCreationDateTo));
			}
		}

		if ($filterCreatedBy = $this->getState('filter.created_by'))
		{
			if ($filterCreatedBy == 'auto')
			{
				$this->addWhere('a.created_by = ' . (int)JFactory::getUser()->get('id'));
			}
			elseif ($filterCreatedBy > 0)
			{
				$this->addWhere("a.created_by = " . (int)$filterCreatedBy);
			}
		}

		// WHERE - SEARCH : search_search : search on Num ID + Main Pic + Gallery Pic + Alias
		$search_search = $this->getState('search.search');
		$this->addSearch('search', 'a.num_id', 'like');
		$this->addSearch('search', 'a.main_pic', 'like');
		$this->addSearch('search', 'a.gallery_pic', 'like');
		$this->addSearch('search', 'a.alias', 'like');
		if (($search_search != '') && ($search_search_val = $this->buildSearch('search', $search_search)))
		{
			$this->addWhere($search_search_val);
		}

		// Apply all SQL directives to the query
		$this->applySqlStates($query);
	}


}



