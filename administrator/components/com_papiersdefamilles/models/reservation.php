<?php
/**
 * @version
 * @package        Papiersdefamilles
 * @subpackage     Reservations
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
 * Papiersdefamilles Item Model
 *
 * @package       Papiersdefamilles
 * @subpackage    Classes
 */
class PapiersdefamillesModelReservation extends PapiersdefamillesClassModelItem
{
    /**
     * View list alias
     *
     * @var string
     */
    protected $view_item = 'reservation';

    /**
     * View list alias
     *
     * @var string
     */
    protected $view_list = 'reservations';

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
        parent::__construct();
    }

    /**
     * Method to delete item(s).
     *
     * @access    public
     *
     * @param    array &$pks Ids of the items to delete.
     *
     * @return    boolean    True on success.
     */
    public function delete(&$pks)
    {
        if ( ! count($pks)) {
            return true;
        }


        if ( ! parent::delete($pks)) {
            return false;
        }


        return true;
    }

    /**
     * Method to get the layout (including default).
     *
     * @access    public
     *
     * @return    string    The layout alias.
     */
    public function getLayout()
    {
        $jinput = JFactory::getApplication()->input;

        return $jinput->get('layout', 'reservation', 'STRING');
    }

    /**
     * Returns a Table object, always creating it.
     *
     * @access    public
     *
     * @param    string $type   The table type to instantiate.
     * @param    string $prefix A prefix for the table class name. Optional.
     * @param    array  $config Configuration array for model. Optional.
     *
     *
     * @since     1.6
     *
     * @return    JTable    A database object
     */
    public function getTable($type = 'reservation', $prefix = 'PapiersdefamillesTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }

    /**
     * Method to increment hits (check session and layout)
     *
     * @access    public
     *
     * @param    array $layouts List of authorized layouts for hitting the object.
     *
     *
     * @since     11.1
     *
     * @return    boolean    Null if skipped. True when incremented. False if error.
     */
    public function hit($layouts = null)
    {
        return parent::hit(array());
    }

    /**
     * Method to get the data that should be injected in the form.
     *
     * @access    protected
     *
     * @return    mixed    The data for the form.
     */
    protected function loadFormData()
    {
        // Check the session for previously entered form data.
        $data = JFactory::getApplication()->getUserState('com_papiersdefamilles.edit.reservation.data', array());

        if (empty($data)) {
            //Default values shown in the form for new item creation
            $data = $this->getItem();

            // Prime some default values.
            if ($this->getState('reservation.id') == 0) {
                $jinput = JFactory::getApplication()->input;

                $data->id                      = 0;
                $data->joomla_user_id          = $jinput->get('filter_joomla_user_id',
                    $this->getState('filter.joomla_user_id'), 'INT');
                $data->subscriptionplan_id     = $jinput->get('filter_subscriptionplan_id',
                    $this->getState('filter.subscriptionplan_id'), 'INT');
                $data->subscriptionplan_price = null;

                $data->price_total = null;
                $data->name        = null;
                $data->surname     = null;
                $data->phone       = null;
                $data->address     = null;
                $data->zip_code    = null;
                $data->city        = null;
                $data->email       = null;
                $data->birthday    = null;
                $data->price_total = null;
                $data->discount    = null;

                $data->is_paypal         = null;
                $data->is_paypal_refund  = null;
                $data->payment_status    = null;
                $data->created_by        = $jinput->get('filter_created_by',
                    $this->getState('filter.created_by'), 'INT');
                $data->modified_by       = $jinput->get('filter_modified_by',
                    $this->getState('filter.modified_by'), 'INT');
                $data->creation_date     = null;
                $data->modification_date = null;
                $data->ordering          = null;
                $data->published         = 1;
            }
        }

        return $data;
    }

    /**
     * Method to auto-populate the model state.
     *
     * This method should only be called once per instantiation and is designed to
     * be called on the first call to the getState() method unless the model
     * configuration flag to ignore the request is set.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @access    protected
     *
     *
     * @since     11.1
     *
     * @return    void
     */
    protected function populateState()
    {
        $app     = JFactory::getApplication();
        $session = JFactory::getSession();
        $acl     = PapiersdefamillesHelper::getActions();


        parent::populateState();

        // Only show the published items
        if ( ! $acl->get('core.admin') && ! $acl->get('core.edit.state')) {
            $this->setState('filter.published', 1);
        }
    }

    /**
     * Preparation of the query.
     *
     * @access    protected
     *
     * @param    object  &$query returns a filled query object.
     * @param    integer $pk     The primary id key of the reservation
     *
     * @return    void
     */
    protected function prepareQuery(&$query, $pk)
    {

        $acl = PapiersdefamillesHelper::getActions();

        // FROM : Main table
        $query->from('#__papiersdefamilles_reservations AS a');


        // IMPORTANT REQUIRED FIELDS
        $this->addSelect('a.id,'
            . 'a.created_by,'
            . 'a.joomla_user_id,'
            . 'a.published,'
            . 'a.name,'
            . 'a.surname,'
            . 'a.address,'
            . 'a.email,'
            . 'a.birthday,'
            . 'a.city,'
            . 'a.phone,'
            . 'a.subscriptionplan_id,'
            . 'a.subscriptionplan_price,'
            . 'a.price_total,'
            . 'a.discount,'
            . 'a.is_paypal,'
            . 'a.is_paypal_refund,'
            . 'a.note,'
            . 'a.payment_status,'
            . 'a.zip_code');

// SELECT

        $this->addSelect('_created_by_.name AS `_created_by_name`');
        $this->addSelect('_modified_by_.name AS `_modified_by_name`');
        // SELECT

        // JOIN

        $this->addJoin('`#__users` AS _created_by_ ON _created_by_.id = a.created_by', 'LEFT');
        $this->addJoin('`#__users` AS _modified_by_ ON _modified_by_.id = a.modified_by', 'LEFT');

        switch ($this->getState('context', 'all')) {
            case 'reservation.reservation':


                break;
            case 'all':
                // SELECT : raw complete query without joins
                $query->select('a.*');
                break;
        }

        // WHERE : Item layout (based on $pk)
        $query->where('a.id = ' . (int)$pk);        //TABLE KEY

        // FILTER - Access for : Root table
        $wherePublished = $allowAuthor = true;
        $whereAccess    = false;
        $this->prepareQueryAccess('a', $whereAccess, $wherePublished, $allowAuthor);
        $query->where("($allowAuthor OR $wherePublished)");

        // Apply all SQL directives to the query
        $this->applySqlStates($query);

    }

    /**
     * Prepare and sanitise the table prior to saving.
     *
     * @access    protected
     *
     * @param    JTable $table A JTable object.
     *
     *
     * @since     1.6
     *
     * @return    void
     */
    protected function prepareTable($table)
    {
        $date = JFactory::getDate();


        if (empty($table->id)) {
            //Defines automatically the author of this element
            $table->created_by = JFactory::getUser()->get('id');

            //Creation date
            if (empty($table->creation_date)) {
                $table->creation_date = JFactory::getDate()->toSql();
            }

            // Set ordering to the last item if not set
            $conditions      = $this->getReorderConditions($table);
            $conditions      = (count($conditions) ? implode(" AND ", $conditions) : '');
            $table->ordering = $table->getNextOrder($conditions);
        } else {
            //Defines automatically the editor of this element
            $table->modified_by = JFactory::getUser()->get('id');

            //Modification date
            $table->modification_date = JFactory::getDate()->toSql();
        }

    }

    /**
     * Save an item.
     *
     * @access    public
     *
     * @param    array $data The post values.
     *
     * @return    boolean    True on success.
     */
    public function save($data)
    {
        //Convert from a non-SQL formated date (birthday)
        $data['birthday'] = PapiersdefamillesHelperDates::getSqlDate($data['birthday'], array('Y-m-d'), true,
            'USER_UTC');

        //Convert from a non-SQL formated date (creation_date)
        $data['creation_date'] = PapiersdefamillesHelperDates::getSqlDate($data['creation_date'], array('Y-m-d H:i'),
            true, 'USER_UTC');

        //Convert from a non-SQL formated date (modification_date)
        $data['modification_date'] = PapiersdefamillesHelperDates::getSqlDate($data['modification_date'],
            array('Y-m-d H:i'), true, 'USER_UTC');
        //Some security checks
        $acl = PapiersdefamillesHelper::getActions();

        //Secure the author key if not allowed to change
        if (isset($data['created_by']) && ! $acl->get('core.edit')) {
            unset($data['created_by']);
        }

        //Secure the published tag if not allowed to change
        if (isset($data['published']) && ! $acl->get('core.edit.state')) {
            unset($data['published']);
        }

        if (parent::save($data)) {
            return true;
        }

        return false;
    }

    /**
     * Method to upate an element.
     *
     * @access    public
     *
     * @param    object $object Object booking update
     *
     * @return    void
     */
    public function update($object)
    {
        $result = JFactory::getDbo()->updateObject('#__papiersdefamilles_reservations', $object, 'id');
    }
}



