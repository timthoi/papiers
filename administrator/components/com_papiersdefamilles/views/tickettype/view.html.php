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
* @subpackage	Tickettype
*/
class PapiersdefamillesViewTickettype extends PapiersdefamillesClassView
{
	/**
	* List of the reachables layouts. Fill this array in every view file.
	*
	* @var array
	*/
	protected $layouts = array('tickettype');

	/**
	* Execute and display a template : Ticket Type
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	*
	* @since	11.1
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*/
	protected function displayTickettype($tpl = null)
	{
		// Initialiase variables.
		$this->model	= $model	= $this->getModel();
		$this->state	= $state	= $this->get('State');
		$this->params 	= $state->get('params');
		$state->set('context', 'tickettype.tickettype');
		$this->item		= $item		= $this->get('Item');

		$this->form		= $form		= $this->get('Form');
		$this->canDo	= $canDo	= PapiersdefamillesHelper::getActions($model->getId());
		$lists = array();
		$this->lists = &$lists;

		// Define the title
		$this->_prepareDocument(JText::_('PAPIERSDEFAMILLES_LAYOUT_TICKET_TYPE'), $this->item, 'num_id');

		$user		= JFactory::getUser();
		$isNew		= ($model->getId() == 0);

		//Check ACL before opening the form (prevent from direct access)
		if (!$model->canEdit($item, true))
			$model->setError(JText::_('JERROR_ALERTNOAUTHOR'));

		// Check for errors.
		if (count($errors = $model->getErrors()))
		{
			JError::raiseError(500, implode(BR, array_unique($errors)));
			return false;
		}
		//Toolbar
		JToolBarHelper::title(JText::_('PAPIERSDEFAMILLES_LAYOUT_TICKET_TYPE'), 'pencil-2');

		// Save & Close
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			JToolBarHelper::save('tickettype.save', "PAPIERSDEFAMILLES_JTOOLBAR_SAVE_CLOSE");
		// Save
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			JToolBarHelper::apply('tickettype.apply', "PAPIERSDEFAMILLES_JTOOLBAR_SAVE");
		
		// Save & New
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			JToolBarHelper::save2new('tickettype.save2new', "PAPIERSDEFAMILLES_JTOOLBAR_SAVE_NEW");
		// Save to Copy
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			JToolBarHelper::save2copy('tickettype.save2copy', "PAPIERSDEFAMILLES_JTOOLBAR_SAVE_TO_COPY");

		// Cancel
		JToolBarHelper::cancel('tickettype.cancel', "PAPIERSDEFAMILLES_JTOOLBAR_CANCEL");

		// FILTERs
		// Continents
		$modelContinents = CkJModel::getInstance('Continents', 'PapiersdefamillesModel');
		$modelContinents->set('context', $model->get('context'));
		$lists['fk']['continent_id'] = $modelContinents->getItems();


		// Countries
		$modelCountries = CkJModel::getInstance('Countries', 'PapiersdefamillesModel');
		$modelCountries->set('context', $model->get('context'));
		$lists['fk']['country_id'] = $modelCountries->getItems();

		// Cities
		$modelCities = CkJModel::getInstance('Cities', 'PapiersdefamillesModel');
		$modelCities->set('context', $model->get('context'));
		$lists['fk']['city_id'] = $modelCities->getItems();
		
		$modelDepartureCityId = CkJModel::getInstance('Departurecities', 'PapiersdefamillesModel');
		$modelDepartureCityId->addGroupOrder("a.name");
		$lists['fk']['departure_city_id'] = $modelDepartureCityId->getItems();

		if (!empty($this->item->main_pic))
		{
			$this->item->avatars = JFolder::files(JPATH_SITE . DS .  json_decode($this->item->main_pic), '.jpg|.png|.jpeg', false, false, array());
			
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
			$this->item->galleries = JFolder::files(JPATH_SITE . DS .  json_decode($this->item->gallery_pic), '.jpg|.png|.jpeg', false, false, array());
			$this->item->galleries = json_encode($this->item->galleries);
		}
		else
		{
			$this->item->galleries = '';
		}
	}


}



