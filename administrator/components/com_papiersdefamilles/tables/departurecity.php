<?php
/**
* @version		
* @package		Papiersdefamilles
* @subpackage	Departure Cities
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
* Papiersdefamilles Table class
*
* @package	Papiersdefamilles
* @subpackage	Departurecity
*/
class PapiersdefamillesTableDeparturecity extends PapiersdefamillesClassTable
{
	/**
	* Constructor
	*
	* @access	public
	* @param	object	&$db	Database connector object
	* @param	string	$tbl	Table name
	* @param	string	$key	Primary key
	*
	* @return	void
	*/
	public function __construct(&$db, $tbl = '#__PAPIERSDEFAMILLES_departurecities', $key = 'id')
	{
		parent::__construct($tbl, $key, $db);
	}


}



