<?php
/** 
* @package		Papiersdefamilles
* @subpackage	Subcategories
* @copyright	
* @author		 -  - 
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
* Papiersdefamilles Subcategories Controller
*
* @package	Papiersdefamilles
* @subpackage	Subcategories
*/
class PapiersdefamillesControllerSubcategories extends PapiersdefamillesClassControllerList
{
	/**
	* The context for storing internal data, e.g. record.
	*
	* @var string
	*/
	protected $context = 'subcategories';

	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'subcategory';

	/**
	* The URL view list variable.
	*
	* @var string
	*/
	protected $view_list = 'subcategories';

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
		parent::__construct($config);
		$app = JFactory::getApplication();

	}

	/**
	* Return the current layout.
	*
	* @access	protected
	* @param	bool	$default	If true, return the default layout.
	*
	* @return	string	Requested layout or default layout
	*/
	protected function getLayout($default = null)
	{
		if ($default)
			return 'default';

		$jinput = JFactory::getApplication()->input;
		return $jinput->get('layout', 'default', 'CMD');
	}


}



