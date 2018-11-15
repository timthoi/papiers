<?php
/**
* @version		
* @package		Papiersdefamilles
* @subpackage	cities
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
class PapiersdefamillesModelCities extends PapiersdefamillesClassModelList
{
	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'city';

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
				'name', 'a.name',
				'_continent_name', '_continent_.name',
				'_country_name', '_country_.name',

			);
		}

		//Define the filterable fields
		$this->set('filter_vars', array(
			'published' => 'cmd',
			'sortTable' => 'cmd',
			'directionTable' => 'cmd',
			'limit' => 'cmd',
			'continent' => 'cmd',
			'country' => 'cmd'
		));

		//Define the searchable fields
		$this->set('search_vars', array(
			'search' => 'string'
				));


		parent::__construct($config);

		$this->hasOne('continent', // name
			'continents', // foreignModelClass
			'continent_id', // localKey
			'id', // foreignKey
			array() // selectFields
		);

		$this->hasOne('country', // name
			'countries', // foreignModelClass
			'country_id', // localKey
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
		$id	.= ':'.$this->getState('filter.continent');
		$id	.= ':'.$this->getState('filter.country');
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
		$query->from('#__PAPIERSDEFAMILLES_cities AS a');



		// IMPORTANT REQUIRED FIELDS
		$this->addSelect(	'a.id,'
						.	'a.published');

		// BASE FIELDS
		$this->addSelect(	'a.alias,'
						.	'a.continent_id,'
						.	'a.country_id,'
						.	'a.name,'
						.	'a.ordering');

		// SELECT
		$this->addSelect('_continent_.name AS `_continent_name`');
		$this->addSelect('_country_.name AS `_country_name`');

		// JOIN
		$this->addJoin('`#__PAPIERSDEFAMILLES_continents` AS _continent_ ON _continent_.id = a.continent_id', 'LEFT');
		$this->addJoin('`#__PAPIERSDEFAMILLES_countries` AS _country_ ON _country_.id = a.country_id', 'LEFT');

		switch($this->getState('context', 'all'))
		{
			case 'cities.default':


				break;

			case 'tickettypes.mod_ticketsearch':
				$this->setState('filter.published', 1);
				$this->setState('list.start', null);

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
		$wherePublished = true;
		$whereAccess = $allowAuthor = false;
		$this->prepareQueryAccess('a', $whereAccess, $wherePublished, $allowAuthor);
		$query->where("$wherePublished");

		// WHERE - FILTER : Publish state
		$published = $this->getState('filter.published');

		if (is_numeric($published))
		{
			$query->where('a.published = ' . (int) $published);
		}
		elseif (!$published)
		{
			$query->where('(a.published = 0 OR a.published = 1 OR a.published IS NULL)');
		}


		if ($filterContinent = $this->getState('filter.continent'))
		{
			if ($filterContinent > 0)
			{
				$this->addWhere("a.continent_id = " . (int)$filterContinent);
			}
		}

		if ($filterCountry = $this->getState('filter.country'))
		{
			if ($filterCountry > 0)
			{
				$this->addWhere("a.country_id = " . (int)$filterCountry);
			}
		}

		// WHERE - SEARCH : search_search : search on Name + Alias + continent > Name
		$search_search = $this->getState('search.search');
		$this->addSearch('search', 'a.name', 'like');
		$this->addSearch('search', 'a.alias', 'like');
		$this->addSearch('search', '_continent_.name', 'like');
		$this->addSearch('search', '_country_.name', 'like');

		if (($search_search != '') && ($search_search_val = $this->buildSearch('search', $search_search)))
		{
			$this->addWhere($search_search_val);
		}

		// Apply all SQL directives to the query
		$this->applySqlStates($query);/*

		echo $query->__tostring();
		die;*/
	}


}


