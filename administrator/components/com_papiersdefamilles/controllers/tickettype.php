<?php
/**
* @version		
* @package		Papiersdefamilles
* @subpackage	Ticket Types
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
* Papiersdefamilles Tickettype Controller
*
* @package	Papiersdefamilles
* @subpackage	Tickettype
*/
class PapiersdefamillesControllerTickettype extends PapiersdefamillesClassControllerItem
{
	/**
	* The context for storing internal data, e.g. record.
	*
	* @var string
	*/
	protected $context = 'tickettype';

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
	* Method to add an element.
	*
	* @access	public
	*
	* @return	void
	*/
	public function add()
	{
		JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
		$this->_result = $result = parent::add();
		$model = $this->getModel();

		//Define the redirections
		switch($this->getLayout() .'.'. $this->getTask())
		{
			case 'default.add':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.tickettype.tickettype'
				), array(
			
				));
				break;

			case 'modal.add':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.tickettype.tickettype'
				), array(
			
				));
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.tickettype.tickettype'
				));
				break;
		}
	}

	/**
	* Override method when the author allowed to delete own.
	*
	* @access	protected
	* @param	array	$data	An array of input data.
	* @param	string	$key	The name of the key for the primary key; default is id..
	*
	* @return	boolean	True on success
	*/
	protected function allowDelete($data = array(), $key = id)
	{
		return parent::allowDelete($data, $key, array(
		'key_author' => 'created_by'
		));
	}

	/**
	* Override method when the author allowed to edit own.
	*
	* @access	protected
	* @param	array	$data	An array of input data.
	* @param	string	$key	The name of the key for the primary key; default is id..
	*
	* @return	boolean	True on success
	*/
	protected function allowEdit($data = array(), $key = id)
	{
		return parent::allowEdit($data, $key, array(
		'key_author' => 'created_by'
		));
	}

	/**
	* Method to cancel an element.
	*
	* @access	public
	* @param	string	$key	The name of the primary key of the URL variable.
	*
	* @return	void
	*/
	public function cancel($key = null)
	{
		$this->_result = $result = parent::cancel();
		$model = $this->getModel();

		//Define the redirections
		switch($this->getLayout() .'.'. $this->getTask())
		{
			case 'tickettype.cancel':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.tickettypes.default'
				), array(
					'cid[]' => null
				));
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.tickettypes.default'
				));
				break;
		}
	}

	/**
	* Method to delete an element.
	*
	* @access	public
	*
	* @return	void
	*/
	public function delete()
	{
		JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
		$this->_result = $result = parent::delete();
		$model = $this->getModel();

		//Define the redirections
		switch($this->getLayout() .'.'. $this->getTask())
		{
			case 'default.delete':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.tickettypes.default'
				), array(
					'cid[]' => null
				));
				break;

			case 'modal.delete':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.tickettypes.default'
				), array(
					'cid[]' => null
				));
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.tickettypes.default'
				));
				break;
		}
	}

	/**
	* Method to edit an element.
	*
	* @access	public
	* @param	string	$key	The name of the primary key of the URL variable.
	* @param	string	$urlVar	The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
	*
	* @return	void
	*/
	public function edit($key = null, $urlVar = null)
	{
		JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
		$this->_result = $result = parent::edit();
		$model = $this->getModel();

		//Define the redirections
		switch($this->getLayout() .'.'. $this->getTask())
		{
			case 'default.edit':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.tickettype.tickettype'
				), array(
			
				));
				break;

			case 'modal.edit':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.tickettype.tickettype'
				), array(
			
				));
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.tickettype.tickettype'
				));
				break;
		}
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
		if ($default === 'edit')
			return 'tickettype';

		if ($default)
			return 'tickettype';

		$jinput = JFactory::getApplication()->input;
		return $jinput->get('layout', 'tickettype', 'CMD');
	}

	/**
	* Method to save an element.
	*
	* @access	public
	* @param	string	$key	The name of the primary key of the URL variable.
	* @param	string	$urlVar	The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
	*
	* @return	void
	*/
	public function save($key = null, $urlVar = null)
	{
		JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
		//Check the ACLs
		$model = $this->getModel();
		$item = $model->getItem();
		$result = false;

		$itemIdOld = (isset($item->id)) ? : 0;

		if ($model->canEdit($item, true))
		{
			$result = parent::save();
			//Get the model through postSaveHook()
			if ($this->model)
			{
				$model = $this->model;
				$item = $model->getItem();

				$object = new stdClass();
				$flagUpdate = false;

                if ($item->id != $itemIdOld)
                {
                    $object->published = 0;
                    $flagUpdate = true;
                }

                //Upload Image
				$galleryImages = JRequest::getVar('gallery_images');
				$avatarImages = JRequest::getVar('avatar_images');

				$data = JRequest::getVar('jform');
				$uploadDirectory = '';

				if (isset($data['gallery_pic']) && !empty($data['gallery_pic']))
				{
					$uploadDirectory = $data['gallery_pic'];	
				}

				if (isset($data['main_pic']) && !empty($data['main_pic']))
				{
					$uploadDirectory2 = $data['main_pic'];	
				}

				if (isset($item->id))
				{					
					// Create folder to save gallery image
					// Create folder to save avatar image

					$folderClean = preg_replace('/\s+/', '_', $item->id);
					$folderClean = preg_replace('/[^A-Za-z0-9 _\-\+\&]/', '', $folderClean);
					$folderClean = strtolower($folderClean);

					if (!file_exists(JURI::root() . 'images/tickettype'))
					{
						$restultCreate = JFolder::create(JPATH_SITE . DS . "images/tickettype");
					}

					$ticketPath = JPATH_SITE . DS . 'images/tickettype/' . $folderClean;

					if (!file_exists($ticketPath))
					{
						$restultCreate = JFolder::create($ticketPath);
						
						chmod(JPATH_SITE . DS . 'images/tickettype/', 0777);
						chmod($ticketPath, 0777);

						// Create 2 folder in this foldernum_id
						if ($restultCreate)
						{
							$avatarPath = $ticketPath . '/ticketype_avatar';
							$restultCreate = JFolder::create($avatarPath);

							$galleryPath = $ticketPath . '/ticketype_gallery';
							$restultCreate = JFolder::create($galleryPath);


							chmod(JPATH_SITE . DS . 'images/tickettype/', 0777);
							chmod($ticketPath . '/ticketype_avatar/', 0777);
							chmod($ticketPath . '/ticketype_gallery/', 0777);

							$flagUpdate = true;
							$object->gallery_pic = json_encode('images/tickettype/' . $folderClean . '/ticketype_gallery');
							$object->main_pic = json_encode('images/tickettype/' . $folderClean . '/ticketype_avatar');
							$uploadDirectory = $object->gallery_pic;
							$uploadDirectory2 = $object->main_pic;
						}
					}

					// Update ticket Number
					$flagUpdate = true;
					$tmpNum = 'TK' . sprintf('%05d', $item->id);
					
					if ($tmpNum != $item->num_id)
					{
						$flagUpdate = true;
						$object->num_id = $tmpNum;
					}
					
				}

				// Upload Images For Avatar
				if (!empty($avatarImages) && !empty($uploadDirectory2))
				{
					$uploadDirectory2 = json_decode($uploadDirectory2);

					foreach ($avatarImages as $image)
					{
						$fileName = uniqid('tickettype', true);
						$target = JPATH_SITE . DS . $uploadDirectory2 . '/' . $fileName . '.jpg';

						if (!empty($image))
						{
							if (isset($galleryImages) && !empty($galleryImages) && in_array($image, $galleryImages))
							{
								copy(JPATH_SITE . DS . $image, $target );
							}
							else
							{
								rename(JPATH_SITE . DS . $image, $target);
							}
						}
						
					}
				}

				// Upload Images For Gallery
				if (!empty($galleryImages) && !empty($uploadDirectory))
				{
					$uploadDirectory = json_decode($uploadDirectory);

					foreach ($galleryImages as $image)
					{
						if (!empty($image))
						{
							$fileName = uniqid('tickettype', true);
							$target = JPATH_SITE . DS . $uploadDirectory . DS . $fileName . '.jpg';

							$tmp = rename(JPATH_SITE . DS . $image, $target);
							
						}
						
					}
				}

				if (isset($data['pricelist']) && $data['pricelist'])
				{
					// JSon Type [{"field1":"value1","field2":"value2"}, {"field1":"value1","field2":"value2"}]
					$tmp = '[';
					
					foreach ($data['pricelist'] as $promotion)
					{
						$tmp .= '{"departure_city_id":"' . $promotion['departure_city_id'] . '", "type_flight":"' . $promotion['type_flight'] . '", "month_id":"' . $promotion['month_id'] . '", "year":"' . $promotion['year'] . '", "price_1":"' . $promotion['price_1'] . '", "price_2":"' . $promotion['price_2'] . '"},';
					}

					$tmp  = rtrim($tmp, ",");
					$tmp .= ']';
					
					$object->pricelist = $tmp;
					$flagUpdate = true;
				}



				if ($flagUpdate)
				{
					$object->id = $item->id;
					$model->update($object);
				}
			}
		}
		else
			JError::raiseWarning( 403, JText::sprintf('ACL_UNAUTORIZED_TASK', JText::_('PAPIERSDEFAMILLES_JTOOLBAR_SAVE')) );

		$this->_result = $result;

		//Define the redirections
		switch($this->getLayout() .'.'. $this->getTask())
		{
			case 'tickettype.save':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.tickettypes.default'
				), array(
					'cid[]' => null
				));
				break;

			case 'tickettype.apply':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.tickettype.tickettype'
				), array(
					'cid[]' => $model->getState('tickettype.id')
				));
				break;

			case 'tickettype.save2new':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.tickettype.tickettype'
				), array(
					'cid[]' => null
				));
				break;

			case 'tickettype.save2copy':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.tickettype.tickettype'
				), array(
					'cid[]' => $model->getState('tickettype.id')
				));
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.tickettypes.default'
				));
				break;
		}
	}


}



