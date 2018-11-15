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

if (!class_exists('PapiersdefamillesHelper'))
	require_once(JPATH_ADMINISTRATOR . '/components/com_papiersdefamilles/helpers/loader.php');


/**
* Form field for Papiersdefamilles.
*
* @package	Papiersdefamilles
* @subpackage	Form
*/
class JFormFieldCktime extends PapiersdefamillesClassFormField
{
	/**
	* The form field type.
	*
	* @var string
	*/
	public $type = 'cktime';

	/**
	* Method to get the field input markup.
	*
	* @access	public
	*
	*
	* @since	11.1
	*
	* @return	string	The field input markup.
	*/
	public function getInput()
	{

		$this->input = JDom::_('html.form.input.clock', array_merge(array(
				'dataKey' => $this->getOption('name'),
				'domClass' => $this->getOption('class'),
				'domId' => $this->id,
				'domName' => $this->name,
				'dataValue' => $this->value,
				'filter' => $this->getOption('filter'),
				'prefix' => $this->getOption('prefix'),
				'responsive' => $this->getOption('responsive'),
				'size' => 6,
				'suffix' => $this->getOption('suffix'),
				'timeFormat' => $this->getOption('format'),
				'timezone' => $this->getOption('filter')
			), $this->jdomOptions));

		return parent::getInput();
	}


}



