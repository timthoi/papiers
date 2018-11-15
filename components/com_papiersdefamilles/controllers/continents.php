<?php
/**
* @version		
* @package		Papiersdefamilles
* @subpackage	Continents
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
* Papiersdefamilles Continents Controller
*
* @package	Papiersdefamilles
* @subpackage	Continents
*/
class PapiersdefamillesControllerContinents extends PapiersdefamillesClassControllerList
{
	/**
	* The context for storing internal data, e.g. record.
	*
	* @var string
	*/
	protected $context = 'continents';

	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'continent';

	/**
	* The URL view list variable.
	*
	* @var string
	*/
	protected $view_list = 'continents';

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

	/**
	* Method to publish an element.
	*
	* @access	public
	*
	* @return	void
	*/
	public function publish()
	{
		JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
		$this->_result = $result = parent::publish();
		$model = $this->getModel();

		//Define the redirections
		switch($this->getLayout() .'.'. $this->getTask())
		{
			case 'default.publish':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.continents.default'
				), array(
					'cid[]' => null
				));
				break;

			case 'default.unpublish':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.continents.default'
				), array(
					'cid[]' => null
				));
				break;

			case 'modal.publish':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.continents.default'
				), array(
					'cid[]' => null
				));
				break;

			case 'modal.unpublish':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.continents.default'
				), array(
					'cid[]' => null
				));
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'stay'
				));
				break;
		}
	}

	
	/**
	* Method to get list countries of continent_id
	*
	* @access	public
	*
	* @return	string	json subcontinents
	*/
	public function ajaxGetListCountries()
	{
        $continentId = JRequest::getVar('continent_id');
    	$modelCountries = CkJModel::getInstance('Countries', 'PapiersdefamillesModel');
		$modelCountries->setState('filter.published', 1);
		$modelCountries->setState('filter.continent', $continentId);

		$countries = $modelCountries->getItems();

        echo json_encode($countries);
        exit();
       
    }
    /**
	* Method to get list cities of city_id
	*
	* @access	public
	*
	* @return	string	json subcontinents
	*/
	public function ajaxGetListCities()
	{
        $countryId = JRequest::getVar('country_id');
        $continentId = JRequest::getVar('continent_id');
        
    	$modelCities = CkJModel::getInstance('Cities', 'PapiersdefamillesModel');
		$modelCities->setState('filter.published', 1);
		$modelCities->setState('filter.continent', $continentId);
		$modelCities->setState('filter.country', $countryId);

		$cities = $modelCities->getItems();

        echo json_encode($cities);
        exit();
       
    }
}



