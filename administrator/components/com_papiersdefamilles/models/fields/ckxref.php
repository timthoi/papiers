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
class JFormFieldCkxref extends PapiersdefamillesClassFormField
{
	/**
	* The form field type.
	*
	* @var string
	*/
	public $type = 'ckxref';

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

		$this->input = JDom::_('html.form.input.select', array_merge(array(
				'dataKey' => $this->getOption('name'),
				'domClass' => $this->getOption('class'),
				'domId' => $this->id,
				'domName' => $this->name,
				'dataValue' => $this->value,
				'labelKey' => $this->getOption('labelKey'),
				'multiple' => true,
				'prefix' => $this->getOption('prefix'),
				'responsive' => $this->getOption('responsive'),
				'size' => $this->getOption('size', 4, 'int'),
				'suffix' => $this->getOption('suffix'),
				'valueKey' => $this->getOption('valueKey')
			), $this->jdomOptions));

		return parent::getInput();
	}


}



