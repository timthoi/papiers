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
* Enumerations Helper. Create the static lists.
*
* @package	Papiersdefamilles
*/
class PapiersdefamillesHelperEnum
{
	/**
	* Stores the lists in cache for optimization.
	*
	* @var array
	*/
	protected static $_cache = array();

	/**
	* Instanced name. aa
	*
	* @var string
	*/
	protected $enumName;

	/**
	* Instanced list.
	*
	* @var array
	*/
	public $list = array();

	/**
	* Instanced optional options.
	*
	* @var array
	*/
	protected $options = array();

	/**
	* Entry function to load a list.
	*
	* @access	public static
	* @param	string	$enumName	Name of the enumeration : [triad]_[field]
	* @param	array	$options	Optional config array for developer custom.
	*
	* @return	array	Associative array containing the list. Indexes are doubled (array index + value field).
	*/
	public static function _($enumName, $options = array())
	{
		$enumeration = self::getInstance($enumName);

		// Enumeration not found
		if (!$enumeration)
			return array();

		return $enumeration->getList($options);
	}


	/**
	 * Construct the list : type subscription plan
	 *
	 * @access	protected
	 * @param	array	$options	Optional config array for developer custom.
	 *
	 * @return	array	Associative array containing the list. Indexes are doubled (array index + value field).
	 */
	protected function ___type_subscription_plans($options = array())
	{
		return array(
			'1' => array(
				'value' => '1',
				'text' => 'PAPIERSDEFAMILLES_ENUM_TYPE_SUBSCRIPTION_PLAN_1'
			),
			'2' => array(
				'value' => '2',
				'text' => 'PAPIERSDEFAMILLES_ENUM_TYPE_SUBSCRIPTION_PLAN_2'
			),
			'3' => array(
				'value' => '3',
				'text' => 'PAPIERSDEFAMILLES_ENUM_TYPE_SUBSCRIPTION_PLAN_3'
			)
		);
	}

	/**
	 * Construct the list : format documents
	 *
	 * @access	protected
	 * @param	array	$options	Optional config array for developer custom.
	 *
	 * @return	array	Associative array containing the list. Indexes are doubled (array index + value field).
	 */
	protected function ___format_documents($options = array())
	{
		return array(
			'1' => array(
				'value' => '1',
				'text' => 'PAPIERSDEFAMILLES_ENUM_FORMAT_DOCUMENT_1'
			),
			'2' => array(
				'value' => '2',
				'text' => 'PAPIERSDEFAMILLES_ENUM_FORMAT_DOCUMENT_2'
			),
            '3' => array(
                'value' => '3',
                'text' => 'PAPIERSDEFAMILLES_ENUM_FORMAT_DOCUMENT_3'
            )
		);
	}

    /**
     * Construct the list : sex
     *
     * @access	protected
     * @param	array	$options	Optional config array for developer custom.
     *
     * @return	array	Associative array containing the list. Indexes are doubled (array index + value field).
     */
    protected function ___sex($options = array())
    {
        return array(
            '1' => array(
                'value' => '1',
                'text' => 'PAPIERSDEFAMILLES_ENUM_SEX_1'
            ),
            '2' => array(
                'value' => '2',
                'text' => 'PAPIERSDEFAMILLES_ENUM_SEX_2'
            )
        );
    }

    /**
     * Construct the list : qualities
     * @access	protected
     * @param	array	$options	Optional config array for developer custom.
     *
     * @return	array	Associative array containing the list. Indexes are doubled (array index + value field).
     */
    protected function ___qualities($options = array())
    {
        return array(
            '1' => array(
                'value' => '1',
                'text' => 'PAPIERSDEFAMILLES_ENUM_QUALITY_1'
            ),
            '2' => array(
                'value' => '2',
                'text' => 'PAPIERSDEFAMILLES_ENUM_QUALITY_2'
            ),
            '3' => array(
                'value' => '3',
                'text' => 'PAPIERSDEFAMILLES_ENUM_QUALITY_3'
            ),
            '4' => array(
                'value' => '4',
                'text' => 'PAPIERSDEFAMILLES_ENUM_QUALITY_4'
            ),
            '5' => array(
                'value' => '5',
                'text' => 'PAPIERSDEFAMILLES_ENUM_QUALITY_5'
            )

        );
    }
	/**
	 * Construct the list : gender
	 *
	 * @access	protected
	 * @param	array	$options	Optional config array for developer custom.
	 *
	 * @return	array	Associative array containing the list. Indexes are doubled (array index + value field).
	 */
	protected function ___gender($options = array())
	{
		return array(
			'1' => array(
				'value' => '1',
				'text' => 'PAPIERSDEFAMILLES_ENUM_GENDER_1'
			),
			'2' => array(
				'value' => '2',
				'text' => 'PAPIERSDEFAMILLES_ENUM_GENDER_2'
			)
		);
	}

	/**
	* Enumeration constructor.
	*
	* @access	public
	* @param	string	$enumName	Name of the enumeration
	*
	* @return	void
	*/
	public function __construct($enumName)
	{
		$this->enumName = $enumName;
	}

	/**
	* Get an enumeration instance.
	*
	* @access	public static
	* @param	string	$enumName	Name of the enumeration
	*
	* @return	object	Enumeration instance (PapiersdefamillesHelperEnum)
	*/
	public static function getInstance($enumName)
	{
		if (empty($enumName))
			return null;

		if (isset(static::$_cache[$enumName]))
			return static::$_cache[$enumName];

		$enumeration = new PapiersdefamillesHelperEnum($enumName);

		static::$_cache[$enumName] = $enumeration;

		return $enumeration;
	}

	/**
	* Get an enumeration item (from enumeration instance).
	*
	* @access	public
	* @param	string	$value	Index value
	*
	* @return	array	Enumeration item
	*/
	public function getItem($value)
	{
		if (!isset($this->list[$value]))
			return null;

		return $this->list[$value];
	}

	/**
	* Load the list and return it.
	*
	* @access	protected
	* @param	array	$options	Optional configuration. (Advanced custom, not used in native)
	*
	* @return	array	Associative enumeration list.
	*/
	protected function getList($options = array())
	{
		$enumName = '___' . $this->enumName;

		if (!method_exists($this, $enumName))
			return null;

		$this->list = $this->$enumName($options);

		$this->translate();

		return $this->list;
	}

	/**
	* Get an item text (from enumeration instance).
	*
	* @access	public
	* @param	string	$value	Index value
	*
	* @return	string	Item text
	*/
	public function getText($value)
	{
		if (!$item = $this->getItem($value))
			return '';

		return $item['text'];
	}

	/**
	* Get the item of an enumeration.
	*
	* @access	public static
	* @param	string	$enumName	Name of the enumeration
	* @param	string	$value	Value index of the list.
	*
	* @return	array	Found item.
	*/
	public static function item($enumName, $value)
	{
		$enumeration = self::getInstance($enumName);

		// Enumeration not found
		if (!$enumeration)
			return null;

		// Load the enumeration
		$enumeration->getList();

		return $enumeration->getItem($value);
	}

	/**
	* Get the text value of an enumeration.
	*
	* @access	public static
	* @param	string	$enumName	Name of the enumeration
	* @param	string	$value	Value index of the list.
	*
	* @return	string	Translated text value of the found item.
	*/
	public static function text($enumName, $value)
	{
		$enumeration = self::getInstance($enumName);

		// Enumeration not found
		if (!$enumeration)
			return '';

		// Load the enumeration
		$enumeration->getList();

		return $enumeration->getText($value);
	}

	/**
	* Translate the list.
	*
	* @access	protected
	* @param	string	$source	Text field.
	* @param	string	$target	Translated Text field.
	*
	* @return	void
	*/
	protected function translate($source = 'text', $target = 'text')
	{
		if (empty($this->list))
			return;

		// Translate the texts
		foreach ($this->list as $value => $item)
			$this->list[$value][$target] = JText::_($item[$source]);
	}


}



