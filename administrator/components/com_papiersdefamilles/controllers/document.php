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
 * Papiersdefamilles Document Controller
 *
 * @package       Papiersdefamilles
 * @subpackage    Document
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
     * @access    public
     *
     * @param    array $config An optional associative array of configuration settings.
     *
     * @return    void
     */
    public function __construct($config = array())
    {
        parent::__construct($config);
        $app = JFactory::getApplication();

    }

    /**
     * Method to add an element.
     *
     * @access    public
     *
     * @return    void
     */
    public function add()
    {
        JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
        $this->_result = $result = parent::add();
        $model         = $this->getModel();

        //Define the redirections
        switch ($this->getLayout() . '.' . $this->getTask()) {
            case 'default.add':
                $this->applyRedirection($result, array(
                    'stay',
                    'com_papiersdefamilles.document.document'
                ), array());
                break;

            case 'modal.add':
                $this->applyRedirection($result, array(
                    'stay',
                    'com_papiersdefamilles.document.document'
                ), array());
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
     * @access    protected
     *
     * @param    array  $data An array of input data.
     * @param    string $key  The name of the key for the primary key; default is id..
     *
     * @return    boolean    True on success
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
     * @access    protected
     *
     * @param    array  $data An array of input data.
     * @param    string $key  The name of the key for the primary key; default is id..
     *
     * @return    boolean    True on success
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
     * @access    public
     *
     * @param    string $key The name of the primary key of the URL variable.
     *
     * @return    void
     */
    public function cancel($key = null)
    {
        $this->_result = $result = parent::cancel();
        $model         = $this->getModel();

        //Define the redirections
        switch ($this->getLayout() . '.' . $this->getTask()) {
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
     * @access    public
     *
     * @return    void
     */
    public function delete()
    {
        JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
        $this->_result = $result = parent::delete();
        $model         = $this->getModel();

        //Define the redirections
        switch ($this->getLayout() . '.' . $this->getTask()) {
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
     * @access    public
     *
     * @param    string $key    The name of the primary key of the URL variable.
     * @param    string $urlVar The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
     *
     * @return    void
     */
    public function edit($key = null, $urlVar = null)
    {
        JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
        $this->_result = $result = parent::edit();
        $model         = $this->getModel();

        //Define the redirections
        switch ($this->getLayout() . '.' . $this->getTask()) {
            case 'default.edit':
                $this->applyRedirection($result, array(
                    'stay',
                    'com_papiersdefamilles.document.document'
                ), array());
                break;

            case 'modal.edit':
                $this->applyRedirection($result, array(
                    'stay',
                    'com_papiersdefamilles.document.document'
                ), array());
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
     * @access    protected
     *
     * @param    bool $default If true, return the default layout.
     *
     * @return    string    Requested layout or default layout
     */
    protected function getLayout($default = null)
    {
        if ($default === 'edit') {
            return 'document';
        }

        if ($default) {
            return 'document';
        }

        $jinput = JFactory::getApplication()->input;

        return $jinput->get('layout', 'document', 'CMD');
    }

    /**
     * Method to save an element.
     *
     * @access    public
     *
     * @param    string $key    The name of the primary key of the URL variable.
     * @param    string $urlVar The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
     *
     * @return    void
     */
    public function save($key = null, $urlVar = null)
    {
        JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
        //Check the ACLs
        $model  = $this->getModel();
        $item   = $model->getItem();
        $result = false;

        $itemIdOld = (isset($item->id)) ? $item->id : 0;

        if ($model->canEdit($item, true)) {
            $result = parent::save();
            //Get the model through postSaveHook()
            if ($this->model) {
                $model = $this->model;
                $item  = $model->getItem();

                $object     = new stdClass();
                $flagUpdate = false;

                if ($item->id != $itemIdOld) {
                    //$object->published = 0;
                    $flagUpdate = true;
                }

                //Upload Image
                $avatarImages = JRequest::getVar('avatar_images');
                $pdfFiles = JRequest::getVar('pdf_file');

                $data                   = JRequest::getVar('jform');
                $uploadDirectoryMainPic = '';
                $uploadDirectoryPDF = '';

                if (isset($data['main_pic']) && ! empty($data['main_pic'])) {
                    $uploadDirectoryMainPic = $data['main_pic'];
                }

                if (isset($data['gallery_pic']) && ! empty($data['gallery_pic'])) {
                    $uploadDirectoryPDF = $data['gallery_pic'];
                }

                $task   = $this->getLayout() . '.' . $this->getTask();
                $length = 40;

                if (isset($item->main_pic)) {
                    // Create folder to save gallery image
                    // Create folder to save avatar image
                    $path = explode("/", json_decode($item->main_pic));

                    if (isset($path[1]) && ! empty($path[1]) && $task != 'document.save2copy') {
                        $mainPath    = $path[0];
                        $folderClean = $path[1];
                    } else {
                        $folderClean = JUserHelper::genRandomPassword($length);
                        $folderClean = preg_replace('/[^A-Za-z0-9 _\-\+\&]/', '', $folderClean);
                        $folderClean = strtolower($folderClean);

                        $mainPath = 'images_documents';
                    }

                    if ( ! file_exists(JURI::root() . $mainPath)) {
                        $restultCreate = JFolder::create(JPATH_SITE . '/' . $mainPath);
                    }

                    $rootPathItem = JPATH_SITE . '/' . $mainPath . '/' . $folderClean;

                    if ( ! file_exists($rootPathItem)) {
                        $restultCreate = JFolder::create($rootPathItem);

                        //5ccfedad413baa37af09caf72e264a5e7d672346
                        $token = JUserHelper::genRandomPassword($length);

                        chmod(JPATH_SITE . '/' . $mainPath, 0777);
                        chmod($rootPathItem, 0777);
                        chmod($rootPathItem . '/', 0777);
                        chmod(JPATH_SITE . '/' . $mainPath . 'dat-lich-hen/', 0777);
                        // Create 2 folder in this foldernum_id
                        if ($restultCreate) {
                            $flagUpdate             = true;
                            // Root path for this item
                            $object->gallery_pic       = json_encode($mainPath . '/' . $folderClean);
                            $object->main_pic       = json_encode($mainPath . '/' . $folderClean . '/document_avatar');
                            $uploadDirectoryMainPic = $object->main_pic;
                            $uploadDirectoryPDF = json_encode($mainPath . '/' . $folderClean);
                        }
                    }

                    $avatarPath    = $rootPathItem . '/document_avatar';

                    if ( ! file_exists($avatarPath)) {
                        $restultCreate = JFolder::create($avatarPath);
                        chmod($rootPathItem . '/document_avatar/', 0777);
                    }

                    $avatarPathThumb   = $rootPathItem . '/document_avatar/thumb';

                    if ( ! file_exists($avatarPathThumb)) {
                        $restultCreate = JFolder::create($avatarPathThumb);
                        chmod($rootPathItem . '/document_avatar/thumb', 0777);
                    }

                    $pdfPath    = $rootPathItem . '/pdf';

                    if ( ! file_exists($pdfPath)) {
                        $restultCreate = JFolder::create($pdfPath);
                        chmod($rootPathItem . '/pdf', 0777);
                    }

                    // Update ticket Number
                    $flagUpdate = true;
                }

                // Upload Images For Avatar
                if ( ! empty($avatarImages) && ! empty($uploadDirectoryMainPic)) {
                    $uploadDirectoryMainPic = json_decode($uploadDirectoryMainPic);

                    foreach ($avatarImages as $image) {
                        $fileName = uniqid('document', true);
                        $target   = JPATH_SITE . '/' . $uploadDirectoryMainPic . '/' . $fileName . '.jpg';
                        $targetThumb   = JPATH_SITE . '/' . $uploadDirectoryMainPic . '/thumb/' . $fileName . '.jpg';
                        $imagefile = JPATH_SITE . '/' . $image;

                        if ( ! empty($image)) {
                            $resource = imagecreatefromjpeg($imagefile);
                            imagejpeg($resource, $targetThumb, 0.1);
                            rename($imagefile, $target);
                        }

                    }
                }

                // Upload PDF
                if ( ! empty($pdfFiles) && ! empty($uploadDirectoryPDF)) {
                    var_dump($uploadDirectoryPDF);
                    $uploadDirectoryPDF = json_decode($uploadDirectoryPDF) . '/pdf';

                    foreach ($pdfFiles as $pdf) {
                        $fileName = uniqid('document', true);
                        $target   = JPATH_SITE . '/' . $uploadDirectoryPDF . '/' . $fileName . '.pdf';
                        $pdfFile = JPATH_SITE . '/' . $pdf;

                        if ( ! empty($pdf)) {
                            rename($pdfFile, $target);
                        }

                    }
                }

                // locations
                if (isset($data['locations']) && $data['locations']) {
                    // JSon Type [{"field1":"value1","field2":"value2"}, {"field1":"value1","field2":"value2"}]
                    $tmp = '[';

                    foreach ($data['locations'] as $promotion) {
                        $tmp .= '{"region_id":"' . $promotion['region_id'] . '", "city_id":"' . $promotion['city_id'] . '", "departement_id":"' . $promotion['departement_id'] . '", "country_id":"' . $promotion['country_id'] . '"},';
                    }

                    $tmp = rtrim($tmp, ",");
                    $tmp .= ']';

                    $object->locations = $tmp;
                    $flagUpdate        = true;

                    // Delete and Insert new db
                    $db = JFactory::getDbo();

                    $query = $db->getQuery(true)->delete($db->quoteName('#__papiersdefamilles_documentlocations'))
                        ->where($db->quoteName('document_id') . ' = ' . $item->id);

                    $db->setQuery($query)->execute();

                    // Create an object for the record we are going to update.
                    foreach ($data['locations'] as $promotion) {
                        if (empty($promotion['region_id']) && empty($promotion['city_id']) && empty($promotion['country_id'])) {
                            break;
                        }
                        $objectDocumentlocations                 = new stdClass();
                        $objectDocumentlocations->document_id    = $item->id;
                        $objectDocumentlocations->region_id      = $promotion['region_id'];
                        $objectDocumentlocations->city_id        = $promotion['city_id'];
                        $objectDocumentlocations->departement_id = $promotion['departement_id'];
                        $objectDocumentlocations->country_id     = $promotion['country_id'];
                        $resultInsertDocumentmainnames           = JFactory::getDbo()->insertObject('#__papiersdefamilles_documentlocations',
                            $objectDocumentlocations);
                    }
                }

                // main_persons
                if (isset($data['main_persons']) && $data['main_persons']) {
                    // JSon Type [{"field1":"value1","field2":"value2"}, {"field1":"value1","field2":"value2"}]
                    $tmp = '[';

                    foreach ($data['main_persons'] as $promotion) {
                        if (empty($promotion['name']) && empty($promotion['surname'])) {
                            break;
                        }
                        $tmp .= '{"ordering":"' . $promotion['ordering'] . '", "surname":"' . $promotion['surname'] . '", "name":"' . $promotion['name'] . '", "sex":"' . $promotion['sex'] . '"},';
                    }

                    $tmp = rtrim($tmp, ",");
                    $tmp .= ']';

                    $object->main_persons = $tmp;
                    $flagUpdate           = true;

                    // Delete and Insert new db
                    $db = JFactory::getDbo();

                    $query = $db->getQuery(true)->delete($db->quoteName('#__papiersdefamilles_documentmainnames'))
                        ->where($db->quoteName('document_id') . ' = ' . $item->id);

                    $db->setQuery($query)->execute();

                    // Create an object for the record we are going to update.
                    foreach ($data['main_persons'] as $promotion) {
                        if (empty($promotion['name']) && empty($promotion['surname'])) {
                            break;
                        }
                        $objectDocumentmainnames              = new stdClass();
                        $objectDocumentmainnames->document_id = $item->id;
                        $objectDocumentmainnames->name        = $promotion['name'];
                        $objectDocumentmainnames->sur_name    = $promotion['surname'];
                        $objectDocumentmainnames->sex         = $promotion['sex'];
                        $objectDocumentmainnames->ordering    = $promotion['ordering'];
                        $resultInsertDocumentmainnames        = JFactory::getDbo()->insertObject('#__papiersdefamilles_documentmainnames',
                            $objectDocumentmainnames);
                    }
                }

                // secondary_persons
                if (isset($data['secondary_persons']) && $data['secondary_persons']) {
                    // JSon Type [{"field1":"value1","field2":"value2"}, {"field1":"value1","field2":"value2"}]
                    $tmp = '[';

                    foreach ($data['secondary_persons'] as $promotion) {
                        if (empty($promotion['name']) && empty($promotion['first_name'])) {
                            break;
                        }
                        $tmp .= '{"name":"' . $promotion['name'] . '", "first_name":"' . $promotion['first_name'] . '"},';
                    }

                    $tmp = rtrim($tmp, ",");
                    $tmp .= ']';

                    $object->secondary_persons = $tmp;
                    $flagUpdate                = true;

                    // Delete and Insert new db
                    $db = JFactory::getDbo();

                    $query = $db->getQuery(true)->delete($db->quoteName('#__papiersdefamilles_documentsecondarynames'))
                        ->where($db->quoteName('document_id') . ' = ' . $item->id);

                    $db->setQuery($query)->execute();

                    // Create an object for the record we are going to update.
                    foreach ($data['secondary_persons'] as $promotion) {
                        if (empty($promotion['name']) && empty($promotion['first_name'])) {
                            break;
                        }
                        $objectDocumentsecondarynames              = new stdClass();
                        $objectDocumentsecondarynames->document_id = $item->id;
                        $objectDocumentsecondarynames->name        = $promotion['name'];
                        $objectDocumentsecondarynames->first_name  = $promotion['first_name'];
                        $resultInsertDocumentmainnames             = JFactory::getDbo()->insertObject('#__papiersdefamilles_documentsecondarynames',
                            $objectDocumentsecondarynames);
                    }
                }

                $categoryAlias     = '';
                $typeDocumentAlias = '';

                if (isset($data['typedocuments'][1])) {
                    $modelTypedocument = CkJModel::getInstance('typedocument', 'PapiersdefamillesModel');
                    $typedocumentItem  = $modelTypedocument->getItem($data['typedocuments'][1]);
                    $typeDocumentAlias = $typedocumentItem->alias;

                    $tmpType = array();
                    foreach ($data['typedocuments'] as $dataTypedocument) {
                        $modelTypedocument = CkJModel::getInstance('typedocument', 'PapiersdefamillesModel');
                        $typedocumentItem  = $modelTypedocument->getItem($dataTypedocument);

                        if ( ! empty($typedocumentItem->name)) {
                            $tmpType[] = $typedocumentItem->name;
                        }
                    }

                    $object->types = json_encode($tmpType);
                    $flagUpdate    = true;
                }

                if (isset($data['categories'][1])) {
                    $modelCategories = CkJModel::getInstance('category', 'PapiersdefamillesModel');
                    $categoryItem    = $modelCategories->getItem($data['categories'][1]);
                    $categoryAlias   = $categoryItem->alias;

                    $tmpCategory = array();
                    foreach ($data['categories'] as $dataCategory) {
                        $modelCategories = CkJModel::getInstance('category', 'PapiersdefamillesModel');
                        $categoryItem    = $modelCategories->getItem($dataCategory);

                        if ( ! empty($categoryItem->name)) {
                            $tmpCategory[] = $categoryItem->name;
                        }
                    }

                    $object->categories = json_encode($tmpCategory);
                    $flagUpdate         = true;
                }

                if (isset($data['num_id']) && ! empty($data['num_id']) && $task != 'document.save2copy') {
                    $nextNumId = intval(preg_replace('/[^0-9]+/', '', $data['num_id']), 10);
                } else {
                    $maxNumId  = PapiersdefamillesHelper::getMaxNumId();
                    $nextNumId = intval(preg_replace('/[^0-9]+/', '', $maxNumId), 10);
                }

                if ($flagUpdate) {
                    $object->id     = $item->id;
                    $object->num_id = $typeDocumentAlias . $categoryAlias . $nextNumId;
                    $model->update($object);
                }
            }
        } else {
            JError::raiseWarning(403,
                JText::sprintf('ACL_UNAUTORIZED_TASK', JText::_('PAPIERSDEFAMILLES_JTOOLBAR_SAVE')));
        }

        $this->_result = $result;

        //Define the redirections
        switch ($this->getLayout() . '.' . $this->getTask()) {
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

    public function renderAjaxListRegion()
    {
        JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));

        $jinput = JFactory::getApplication()->input;

        $regionId = $jinput->get('region_id');
        $isAll    = $jinput->get('all', 0);
        $html     = PapiersdefamillesHelper::getListRegion($regionId, $isAll);

        echo json_encode($html);
        exit();
    }

    public function renderAjaxListCity()
    {
        JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));

        $jinput = JFactory::getApplication()->input;

        $cityId = $jinput->get('city_id');
        $isAll  = $jinput->get('all', 0);
        $html   = PapiersdefamillesHelper::getListCity($cityId, $isAll);

        echo json_encode($html);
        exit();
    }

}



