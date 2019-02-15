<?php
/**
 * @version
 * @package        Papiersdefamilles
 * @subpackage     Ticket Types
 * @copyright
 * @author         Harvey - timthoi
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
 * @package       Papiersdefamilles
 * @subpackage    Document
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
     * @access    protected
     *
     * @param    string $tpl The name of the template file to parse; automatically searches through the template paths.
     *
     *
     * @since     11.1
     *
     * @return    mixed    A string if successful, otherwise a JError object.
     */
    protected function displayDocument($tpl = null)
    {
        // Initialiase variables.
        $this->model = $model = $this->getModel();

        $model->loadRelations('categories');
        $model->loadRelations('typedocuments');

        $this->state  = $state = $this->get('State');
        $this->params = $state->get('params');
        $state->set('context', 'document.document');
        $this->item = $item = $this->get('Item');

        $this->form  = $form = $this->get('Form');
        $this->canDo = $canDo = PapiersdefamillesHelper::getActions($model->getId());
        $lists       = array();
        $this->lists = &$lists;

        // Define the title
        $this->_prepareDocument(JText::_('PAPIERSDEFAMILLES_LAYOUT_DOCUMENT'), $this->item, 'num_id');

        $user  = JFactory::getUser();
        $isNew = ($model->getId() == 0);

        //Check ACL before opening the form (prevent from direct access)
        if ( ! $model->canEdit($item, true)) {
            $model->setError(JText::_('JERROR_ALERTNOAUTHOR'));
        }

        // Check for errors.
        if (count($errors = $model->getErrors())) {
            JError::raiseError(500, implode(BR, array_unique($errors)));

            return false;
        }
        //Toolbar
        JToolBarHelper::title(JText::_('PAPIERSDEFAMILLES_LAYOUT_DOCUMENT'), 'pencil-2');

        // Save & Close
        if (($isNew && $model->canCreate()) || ( ! $isNew && $item->params->get('access-edit'))) {
            JToolBarHelper::save('document.save', "PAPIERSDEFAMILLES_JTOOLBAR_SAVE_CLOSE");
        }
        // Save
        if (($isNew && $model->canCreate()) || ( ! $isNew && $item->params->get('access-edit'))) {
            JToolBarHelper::apply('document.apply', "PAPIERSDEFAMILLES_JTOOLBAR_SAVE");
        }

        // Save & New
        if (($isNew && $model->canCreate()) || ( ! $isNew && $item->params->get('access-edit'))) {
            JToolBarHelper::save2new('document.save2new', "PAPIERSDEFAMILLES_JTOOLBAR_SAVE_NEW");
        }
        // Save to Copy
        if (($isNew && $model->canCreate()) || ( ! $isNew && $item->params->get('access-edit'))) {
            JToolBarHelper::save2copy('document.save2copy', "PAPIERSDEFAMILLES_JTOOLBAR_SAVE_TO_COPY");
        }

        // Cancel
        JToolBarHelper::cancel('document.cancel', "PAPIERSDEFAMILLES_JTOOLBAR_CANCEL");

        // FILTERs
        $mainPicName = '';
        $mainPicPath = '';

        $thumbPicName = '';
        $thumbPicPath = '';

        if ( ! empty($this->item->main_pic)) {
            $this->item->avatars = JFolder::files(JPATH_SITE . DS . json_decode($this->item->main_pic),
                '.jpg|.png|.jpeg|.pdf', false, false, array());

            if (isset($this->item->avatars[0])) {
                $mainPicName  = $this->item->avatars[0];
                $thumbPicName = $this->item->avatars[0];
                $mainPicPath  = JUri::root() . json_decode($this->item->main_pic) . DS . $mainPicName;
                $thumbPicPath = JUri::root() . json_decode($this->item->main_pic) . DS . 'thumb' . DS . $mainPicName;
            }
        }

        $this->mainPicName = $mainPicName;
        $this->mainPicPath = $mainPicPath;

        $this->thumbPicName = $thumbPicName;
        $this->thumbPicPath = $thumbPicPath;


        $pdfFileName = '';
        $pdfFilePath = '';
        $originalFileName = '';
        $originalFilePath = '';
        $tiffFileName = '';
        $tiffFilePath = '';

        if ( ! empty($this->item->gallery_pic)) {
            PapiersdefamillesHelper::migrateForOldDatabase($this->item->gallery_pic);

            $pdfFiles = JFolder::files(JPATH_SITE . DS . json_decode($this->item->gallery_pic) . DS . 'pdf',
                '.pdf', false, false, array());

            $originalFiles = JFolder::files(JPATH_SITE . DS . json_decode($this->item->gallery_pic) . DS . 'original',
                '.jpg|.png|.jpeg|.pdf', false, false, array());

            $tiffFiles = JFolder::files(JPATH_SITE . DS . json_decode($this->item->gallery_pic) . DS . 'tiff',
                '.pdf', false, false, array());

            if (isset($pdfFiles[0])) {
                $pdfFileName          = $pdfFiles[0];
                $pdfFilePath          = JUri::root() . json_decode($this->item->gallery_pic) . DS . 'pdf' . DS . $pdfFileName;
            }

            if (isset($originalFiles[0])) {
                $originalFileName          = $originalFiles[0];
                $originalFilePath          = JUri::root() . json_decode($this->item->gallery_pic) . DS . 'original' . DS . $originalFileName;
            }

            if (isset($tiffFiles[0])) {
                $tiffFileName          = $tiffFiles[0];
                $tiffFilePath          = JUri::root() . json_decode($this->item->gallery_pic) . DS . 'tiff' . DS . $tiffFileName;
            }
        }

        $this->pdfFileName = $pdfFileName;
        $this->pdfFilePath = $pdfFilePath;

        $this->originalFileName = $originalFileName;
        $this->originalFilePath = $originalFilePath;

        $this->tiffFileName = $tiffFileName;
        $this->tiffFilePath = $tiffFilePath;
    }
}



