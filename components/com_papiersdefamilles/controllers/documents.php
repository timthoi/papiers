<?php
/**
 * @version
 * @package        Papiersdefamilles
 * @subpackage     Documents
 * @copyright
 * @author         Harvey - timthoi
 * @license        Harvey - timthoi
 */

// no direct access
defined('_JEXEC') or die('Restricted access');


/**
 * Papiersdefamilles Documents Controller
 *
 * @package       Papiersdefamilles
 * @subpackage    Documents
 */
class PapiersdefamillesControllerDocuments extends PapiersdefamillesClassControllerList
{
    /**
     * The context for storing internal data, e.g. record.
     *
     * @var string
     */
    protected $context = 'documents';

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
        if ($default) {
            return 'default';
        }

        $jinput = JFactory::getApplication()->input;

        return $jinput->get('layout', 'default', 'CMD');
    }

    /**
     * Method to publish an element.
     *
     * @access    public
     *
     * @return    void
     */
    public function publish()
    {
        JSession::checkToken() or JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));
        $this->_result = $result = parent::publish();
        $model         = $this->getModel();

        //Define the redirections
        switch ($this->getLayout() . '.' . $this->getTask()) {
            case 'default.publish':
                $this->applyRedirection($result, array(
                    'stay',
                    'com_papiersdefamilles.documents.default'
                ), array(
                    'cid[]' => null
                ));
                break;

            case 'default.unpublish':
                $this->applyRedirection($result, array(
                    'stay',
                    'com_papiersdefamilles.documents.default'
                ), array(
                    'cid[]' => null
                ));
                break;

            case 'modal.publish':
                $this->applyRedirection($result, array(
                    'stay',
                    'com_papiersdefamilles.documents.default'
                ), array(
                    'cid[]' => null
                ));
                break;

            case 'modal.unpublish':
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
                    'stay'
                ));
                break;
        }
    }

    /**
     * Method to set session search.
     *
     * @access    public
     *
     * @return    void
     */
    public function setSessionSearch()
    {
        $jinput = JFactory::getApplication()->input;

        $main_person = $jinput->get('search_main_person', '', 'STRING');
        $join         = $jinput->get('search_join', '', 'STRING');
        $country      = $jinput->get('search_country', '', 'STRING');
        $region       = $jinput->get('search_region', '', 'STRING');

        $isStay = 0;

        $mainframe = JFactory::getApplication();

        $mainframe->setUserState("module.main_person", $main_person);

        $mainframe->setUserState("module.join", $join);

        $mainframe->setUserState("module.country", $country);

        $mainframe->setUserState("module.region", $region);

        $documentId = $jinput->get('document_id', 0, 'INT');

        if ($documentId && $isStay) {
            $this->applyRedirection($result, array(
                'stay',
                'com_papiersdefamilles.document.documentdetail'
            ), array(
                'cid'           => $documentId,
                'Itemid'        => 136,
                'search_search' => $main_person
            ));
        } else {
            switch ($this->getLayout() . '.' . $this->getTask()) {
                case 'default.setSessionSearch':
                    $this->applyRedirection($result, array(
                        'stay',
                        'com_papiersdefamilles.documents.default'
                    ), array(
                        'cid[]'         => null,
                        'Itemid'        => 136,
                        'search_search' => $main_person
                    ));
                    break;

                default:
                    $this->applyRedirection($result, array(
                        'stay',
                        'com_papiersdefamilles.documents.default'
                    ), array(
                        'cid[]'         => null,
                        'Itemid'        => 136,
                    ));
                    break;
            }
        }
    }
}



