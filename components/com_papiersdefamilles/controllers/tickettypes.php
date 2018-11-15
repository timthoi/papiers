<?php
/** 
* @package		Papiersdefamilles
* @subpackage	Ticket Types
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
* Papiersdefamilles Tickettypes Controller
*
* @package	Papiersdefamilles
* @subpackage	Tickettypes
*/
class PapiersdefamillesControllerTickettypes extends PapiersdefamillesClassControllerList
{
	/**
	* The context for storing internal data, e.g. record.
	*
	* @var string
	*/
	protected $context = 'tickettypes';

	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'tickettype';

	/**
	* The URL view list variable.
	*
	* @var string
	*/
	protected $view_list = 'tickettypes';

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
	 * Method to set session search.
	 *
	 * @access	public
	 *
	 * @return	void
	 */
	public function setSessionSearch()
	{
		$jinput = JFactory::getApplication()->input;
		$countryId = $jinput->get('country_id', 0);
		$cityId = $jinput->get('city_id', 0);

		$mainframe =JFactory::getApplication();

		if (!empty($countryId))
		{
			$mainframe->setUserState("module.country_id", $countryId);
		}

		if (!empty($cityId))
		{
			$mainframe->setUserState("module.city_id", $cityId);
		}

		$sessionSearch = PapiersdefamillesHelper::getSearchSessionUser();

		switch($this->getLayout() . '.' . $this->getTask())
		{
			case 'default.setSessionSearch':
				if ($countryId && $cityId)
				{
					$this->applyRedirection($result, array(
						'stay',
						'com_papiersdefamilles.tickettypes.default'
					), array(
						'cid[]' => null,
						'Itemid' => 443,
						'filter_country_id' => $countryId,
						'filter_city_id' => $cityId
					));
				}
				elseif ($countryId)
				{
					$this->applyRedirection($result, array(
						'stay',
						'com_papiersdefamilles.tickettypes.default'
					), array(
						'cid[]' => null,
						'Itemid' => 443,
						'filter_country_id' => $countryId
					));
				}
				elseif ($cityId)
				{
					$this->applyRedirection($result, array(
						'stay',
						'com_papiersdefamilles.tickettypes.default'
					), array(
						'cid[]' => null,
						'Itemid' => 443,
						'filter_city_id' => $cityId
					));
				}
				else
				{
					$this->applyRedirection($result, array(
						'stay',
						'com_papiersdefamilles.tickettypes.default'
					), array(
						'cid[]' => null,
						'Itemid' => 443
					));
				}
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.tickettypes.default'
				), array(
					'cid[]' => null,
					'Itemid' => 443,
				));
				break;
		}
	}
}



