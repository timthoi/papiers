<?php
/**
 * @version		v.1.0
 * @package		Papiersdefamilles
 * @subpackage	documenttype
 * @copyright  Copyright (C) 2017 - 2018 redCOMPONENT.com. All rights reserved.
 * @license    GNU General Public License version 2 or later, see LICENSE.
 */

// No direct access
defined('_JEXEC') or die('Restricted access');



/**
 * Papiersdefamilles Item Model
 *
 * @package	Papiersdefamilles
 * @subpackage	documenttype
 * @since	v.1.0
 */
class PapiersdefamillesModelDocumenttype extends PapiersdefamillesClassModelItem
{
	/**
	 * View list alias
	 *
	 * @var string
	 */
	protected $view_item = 'documenttype';

	/**
	 * View list alias
	 *
	 * @var string
	 */
	protected $view_list = 'documenttypes';

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
		parent::__construct();
	}

	/**
	 * Method to delete item(s).
	 *
	 * @access	public
	 * @param	array	&$pks	Ids of the items to delete.
	 *
	 * @return	boolean	True on success.
	 */
	public function delete(&$pks)
	{
		if (!count( $pks ))
		{
			return true;
		}

		if (!parent::delete($pks))
		{
			return false;
		}

		return true;
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

		return $jinput->get('layout', '', 'STRING');
	}

	/**
	 * Returns a Table object, always creating it.
	 *
  	 * @access	public
	 * @param	string	$type	The table type to instantiate.
	 * @param	string	$prefix	A prefix for the table class name. Optional.
	 * @param	array	$config	Configuration array for model. Optional.
	 *
	 *
	 * @since	1.6
	 *
	 * @return	JTable	A database object
	 */
	public function getTable($type = 'documenttype', $prefix = 'PapiersdefamillesTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to increment hits (check session and layout)
	 *
	 * @access	public
	 * @param	array	$layouts	List of authorized layouts for hitting the object.
	 *
	 *
	 * @since	11.1
	 *
	 * @return	boolean	Null if skipped. True when incremented. False if error.
	 */
	public function hit($layouts = null)
	{
		return parent::hit(array());
	}

	/**
	 * Method to get the data that should be injected in the form.
	  *
	 * @access	protected
	 *
	 * @return	mixed	The data for the form.
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_papiersdefamilles.edit.documenttype.data', array());

		if (empty($data)) 
		{
			// Default values shown in the form for new item creation
			$data = $this->getItem();

			// Prime some default values.
			if ($this->getState('documenttype.id') == 0)
			{
				$jinput = JFactory::getApplication()->input;

				$data->id = 0;
				$data->document_id = $jinput->get('filter_hotel_id', $this->getState('filter.document_id'), 'INT');
				$data->type_document_id = $jinput->get('filter_type_document_id', $this->getState('filter.type_document_id'), 'INT');

			}
		}

		return $data;
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
	 *
	 *
	 * @since	11.1
	 *
	 * @return	void
	 */
	protected function populateState()
	{
		$app = JFactory::getApplication();
		$session = JFactory::getSession();
		$acl = PapiersdefamillesHelper::getActions();

		parent::populateState();
	}

	/**
	 * Preparation of the query.
	 *
 	 * @access	protected
	 * @param	object	&$query	returns a filled query object.
	 * @param	integer	$pk	The primary id key of the documenttype
	 *
	 * @return	void
	 */
	protected function prepareQuery(&$query, $pk)
	{

		$acl = PapiersdefamillesHelper::getActions();

		//FROM : Main table
		$query->from('#__papiersdefamilles_documenttypes AS a');

		//IMPORTANT REQUIRED FIELDS
		$this->addSelect(	'a.id');

		switch ($this->getState('context', 'all'))
		{

			case 'all':
				//SELECT : raw complete query without joins
				$query->select('a.*');
				break;
		}

		// WHERE : Item layout (based on $pk)
		$query->where('a.id = ' . (int) $pk);		//TABLE KEY

		// FILTER - Access for : Root table


		// Apply all SQL directives to the query
		$this->applySqlStates($query);
	}


}