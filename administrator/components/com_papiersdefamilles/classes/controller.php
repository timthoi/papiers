<?php
/**
* @version		
* @package		Papiersdefamilles
* @subpackage	Papiersdefamilles
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
* Papiersdefamilles  Controller
*
* @package	Papiersdefamilles
* @subpackage	
*/
class PapiersdefamillesClassController extends CkJController
{
	/**
	* Call the parent display function. Trick for forking overrides.
	*
	* @access	protected
	*
	*
	* @since	Cook 2.0
	*
	* @return	void
	*/
	protected function _parentDisplay()
	{
		//Add the fork views path (LIFO) instead of FIFO
		array_push($this->paths['view'], JPATH_PAPIERSDEFAMILLES . '/fork/views');

		parent::display();
	}


}



