<?php
/**
 * @version		v.1.0
 * @package		papiersdefamilles
 * @subpackage	papiersdefamilles
 * @copyright  Copyright (C) 2017 - 2018 redCOMPONENT.com. All rights reserved.
 * @license    GNU General Public License version 2 or later, see LICENSE.
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

if (!class_exists('papiersdefamillesHelper'))
	require_once(JPATH_ADMINISTRATOR . '/components/com_papiersdefamilles/helpers/loader.php');


/**
* Form field for papiersdefamilles.
*
* @package	papiersdefamilles
 * @subpackage	Form
 */
class JFormFieldCkeditor extends PapiersdefamillesClassFormField
{
	/**
	* The form field type.
	*
	* @var string
	*/
	public $type = 'ckeditor';

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

		$this->input = JDom::_('html.form.input.editor', array_merge(array(
				'dataKey' => $this->getOption('name'),
				'domClass' => $this->getOption('class'),
				'domId' => $this->id,
				'domName' => $this->name,
				'cols' => $this->getOption('cols'),
				'dataValue' => $this->value,
				'height' => $this->getOption('height'),
				'prefix' => $this->getOption('prefix'),
				'responsive' => $this->getOption('responsive'),
				'rows' => $this->getOption('rows'),
				'suffix' => $this->getOption('suffix'),
				'width' => $this->getOption('width')
			), $this->jdomOptions));

		return parent::getInput();
	}


}



