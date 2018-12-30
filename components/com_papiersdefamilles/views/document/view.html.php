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
* HTML View class for the Papiersdefamilles component
*
* @package	Papiersdefamilles
* @subpackage	Document
*/
class PapiersdefamillesViewDocument extends PapiersdefamillesClassView
{
	/**
	* List of the reachables layouts. Fill this array in every view file.
	*
	* @var array
	*/
	protected $layouts = array('document');

	/**
	* Execute and display a template : Document
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	*
	* @since	11.1
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*/
	protected function displayDocument($tpl = null)
	{
		// Initialiase variables.
		$this->model	= $model	= $this->getModel();

        /*$model->loadRelations('categories');
        $model->loadRelations('typedocuments');*/

		$this->state	= $state	= $this->get('State');
		$this->params 	= $state->get('params');
		$state->set('context', 'document.document');
		$this->item		= $item		= $this->get('Item');

		$this->form		= $form		= $this->get('Form');
		$this->canDo	= $canDo	= PapiersdefamillesHelper::getActions($model->getId());
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('PAPIERSDEFAMILLES_LAYOUT_DOCUMENT'), $this->item, 'num_id');

		$user		= JFactory::getUser();
		$isNew		= ($model->getId() == 0);

		//Check ACL before opening the form (prevent from direct access)
		/*if (!$model->canEdit($item, true))
			$model->setError(JText::_('JERROR_ALERTNOAUTHOR'));*/

		// Check for errors.
		if (count($errors = $model->getErrors()))
		{
			JError::raiseError(500, implode(BR, array_unique($errors)));
			return false;
		}


		if (!empty($this->item->main_pic))
		{
			$this->item->avatars = JFolder::files(JPATH_SITE . DS .  json_decode($this->item->main_pic), '.jpg|.png|.jpeg|.pdf', false, false, array());
			
			if (isset($this->item->avatars[0]))
			{
				$this->item->avatars = json_encode($this->item->avatars[0]);
			}
			else
			{
				$this->item->avatars = '';
			}
		}
		else
		{
			$this->item->avatars = '';
		}

		if (!empty($this->item->gallery_pic))
		{
			$this->item->galleries = JFolder::files(JPATH_SITE . DS .  json_decode($this->item->gallery_pic), '.jpg|.png|.jpeg|.pdf', false, false, array());
			$this->item->galleries = json_encode($this->item->galleries);
		}
		else
		{
			$this->item->galleries = '';
		}


	}
}



