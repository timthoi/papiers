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
* Papiersdefamilles Document Controller
*
* @package	Papiersdefamilles
* @subpackage	Document
*/
class PapiersdefamillesControllerDocument extends PapiersdefamillesClassControllerItem
{
	/**
	* The context for storing internal data, e.g. record.
	*
	* @var string
	*/
	protected $context = 'document';

	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'document';

	/**
	* The URL view list variable.
	*
	* @var string
	*/
	protected $view_list = 'documents';

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
					'com_papiersdefamilles.document.document'
				), array(
			
				));
				break;

			case 'modal.add':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.document.document'
				), array(
			
				));
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.document.document'
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
			case 'document.cancel':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.documents.default'
				), array(
					'cid[]' => null
				));
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.documents.default'
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
					'com_papiersdefamilles.documents.default'
				), array(
					'cid[]' => null
				));
				break;

			case 'modal.delete':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.documents.default'
				), array(
					'cid[]' => null
				));
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.documents.default'
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
					'com_papiersdefamilles.document.document'
				), array(
			
				));
				break;

			case 'modal.edit':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.document.document'
				), array(
			
				));
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.document.document'
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
			return 'document';

		if ($default)
			return 'document';

		$jinput = JFactory::getApplication()->input;
		return $jinput->get('layout', 'document', 'CMD');
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

					if (!file_exists(JURI::root() . 'images/document'))
					{
						$restultCreate = JFolder::create(JPATH_SITE . DS . "images/document");
					}

					$ticketPath = JPATH_SITE . DS . 'images/document/' . $folderClean;

					if (!file_exists($ticketPath))
					{
						$restultCreate = JFolder::create($ticketPath);
						
						chmod(JPATH_SITE . DS . 'images/document/', 0777);
						chmod($ticketPath, 0777);

						// Create 2 folder in this foldernum_id
						if ($restultCreate)
						{
							$avatarPath = $ticketPath . '/document_avatar';
							$restultCreate = JFolder::create($avatarPath);

							$galleryPath = $ticketPath . '/document_gallery';
							$restultCreate = JFolder::create($galleryPath);


							chmod(JPATH_SITE . DS . 'images/document/', 0777);
							chmod($ticketPath . '/document_avatar/', 0777);
							chmod($ticketPath . '/document_gallery/', 0777);

							$flagUpdate = true;
							$object->gallery_pic = json_encode('images/document/' . $folderClean . '/document_gallery');
							$object->main_pic = json_encode('images/document/' . $folderClean . '/document_avatar');
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
						$fileName = uniqid('document', true);
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
							$fileName = uniqid('document', true);
							$target = JPATH_SITE . DS . $uploadDirectory . DS . $fileName . '.jpg';

							$tmp = rename(JPATH_SITE . DS . $image, $target);
							
						}
						
					}
				}

				// locations
				if (isset($data['locations']) && $data['locations'])
				{
					// JSon Type [{"field1":"value1","field2":"value2"}, {"field1":"value1","field2":"value2"}]
					$tmp = '[';

					foreach ($data['locations'] as $promotion)
					{
						$tmp .= '{"region_id":"' . $promotion['region_id'] . '", "city_id":"' . $promotion['city_id'] . '", "country_id":"' . $promotion['country_id'] . '"},';
					}

					$tmp  = rtrim($tmp, ",");
					$tmp .= ']';
					
					$object->locations = $tmp;
					$flagUpdate = true;
				}

                // main_persons
                if (isset($data['main_persons']) && $data['main_persons'])
                {
                    // JSon Type [{"field1":"value1","field2":"value2"}, {"field1":"value1","field2":"value2"}]
                    $tmp = '[';

                    foreach ($data['main_persons'] as $promotion)
                    {
                        $tmp .= '{"ordering":"' . $promotion['ordering'] . '", "surname":"' . $promotion['surname'] . '", "name":"' . $promotion['name'] . '", "sex":"' . $promotion['sex'] . '"},';
                    }

                    $tmp  = rtrim($tmp, ",");
                    $tmp .= ']';

                    $object->main_persons = $tmp;
                    $flagUpdate = true;
                }

                // secondary_persons
                if (isset($data['secondary_persons']) && $data['secondary_persons'])
                {
                    // JSon Type [{"field1":"value1","field2":"value2"}, {"field1":"value1","field2":"value2"}]
                    $tmp = '[';

                    foreach ($data['secondary_persons'] as $promotion)
                    {
                        $tmp .= '{"name":"' . $promotion['name'] . '"},';
                    }

                    $tmp  = rtrim($tmp, ",");
                    $tmp .= ']';

                    $object->secondary_persons = $tmp;
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
			case 'document.save':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.documents.default'
				), array(
					'cid[]' => null
				));
				break;

			case 'document.apply':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.document.document'
				), array(
					'cid[]' => $model->getState('document.id')
				));
				break;

			case 'document.save2new':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.document.document'
				), array(
					'cid[]' => null
				));
				break;

			case 'document.save2copy':
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.document.document'
				), array(
					'cid[]' => $model->getState('document.id')
				));
				break;

			default:
				$this->applyRedirection($result, array(
					'stay',
					'com_papiersdefamilles.documents.default'
				));
				break;
		}
	}
}



