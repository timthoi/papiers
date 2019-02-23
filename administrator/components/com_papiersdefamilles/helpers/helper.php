<?php
/**
 * @version
 * @package        Papiersdefamilles
 * @subpackage     Papiersdefamilles
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
 * Papiersdefamilles Helper functions.
 *
 * @package       Papiersdefamilles
 * @subpackage    Helper
 */
class PapiersdefamillesHelper
{
    /**
     * Cache for ACL actions
     *
     * @var object
     */
    protected static $acl = null;

    /**
     * Directories aliases.
     *
     * @var array
     */
    protected static $directories;

    /**
     * Determines when requirements have been loaded.
     *
     * @var boolean
     */
    protected static $loaded = null;

    /**
     * Call a JS file. Manage fork files.
     *
     * @access    protected static
     *
     * @param    string  $base    Component base from site root.
     * @param    string  $file    Script file.
     * @param    boolean $replace Replace the file or override. (Default : Replace)
     *
     *
     * @since     Cook 2.0
     *
     * @return    void
     */
    protected static function addScript($base, $file, $replace = true)
    {
        $doc = JFactory::getDocument();

        $url = JURI::root(true) . '/' . $base . '/' . $file;
        $url = str_replace(DS, '/', $url);

        $urlFork = null;
        if (file_exists(JPATH_SITE . DS . $base . DS . 'fork' . DS . $file)) {
            $urlFork = JURI::root(true) . '/' . $base . '/fork/' . $file;
            $urlFork = str_replace(DS, '/', $urlFork);
        }

        if ($replace && $urlFork) {
            $url = $urlFork;
        }

        $doc->addScript($url);

        if ( ! $replace && $urlFork) {
            $doc->addScript($urlFork);
        }
    }

    /**
     * Call a CSS file. Manage fork files.
     *
     * @access    protected static
     *
     * @param    string  $base    Component base from site root.
     * @param    string  $file    Stylesheet file.
     * @param    boolean $replace Replace the file or override. (Default : Override)
     *
     *
     * @since     Cook 2.0
     *
     * @return    void
     */
    protected static function addStyleSheet($base, $file, $replace = false)
    {
        $doc = JFactory::getDocument();

        $url = JURI::root(true) . '/' . $base . '/' . $file;
        $url = str_replace(DS, '/', $url);

        $urlFork = null;
        if (file_exists(JPATH_SITE . '/' . $base . '/fork/' . $file)) {
            $urlFork = JURI::root(true) . '/' . $base . '/fork/' . $file;
            $urlFork = str_replace(DS, '/', $urlFork);
        }

        if ($replace && $urlFork) {
            $url = $urlFork;
        }

        $doc->addStyleSheet($url);

        if ( ! $replace && $urlFork) {
            $doc->addStyleSheet($urlFork);
        }
    }

    /**
     * Configure the Linkbar
     *
     * @access    public static
     *
     * @param    varchar $view   The name of the active view.
     * @param    varchar $layout The name of the active layout.
     * @param    varchar $alias  The name of the menu. Default : 'menu'
     *
     *
     * @since     1.6
     *
     * @return    void
     */
    public static function addSubmenu($view, $layout, $alias = 'menu')
    {
        $items = static::getMenuItems();

        // Will be handled in XML in future (or/and with the Joomla native menus)
        // -> give your opinion on j-cook.pro/forum


        $client = 'admin';
        if (JFactory::getApplication()->isSite()) {
            $client = 'site';
        }

        $links = array();
        switch ($client) {
            case 'admin':
                switch ($alias) {
                    case 'cpanel':
                    case 'menu':
                    default:
                        $links = array(
                            'admin.countries.default',
                            'admin.provinces.default',
                            'admin.regions.default',
                            'admin.subscriptionplans.default',
                            'admin.categories.default',
                            'admin.typedocuments.default',
                            'admin.documents.default',
                            'admin.reservations.default'
                        );

                        if ($alias != 'cpanel') {
                            array_unshift($links, 'admin.cpanel');
                        }

                        break;
                }
                break;

            case 'site':
                switch ($alias) {
                    case 'cpanel':
                    case 'menu':
                    default:
                        $links = array(
                            'site.reservations.default'
                        );

                        if ($alias != 'cpanel') {
                            array_unshift($links, 'site.cpanel');
                        }

                        break;
                }
                break;
        }


        //Compile with selected items in the right order
        $menu = array();
        foreach ($links as $link) {
            if ( ! isset($items[$link])) {
                continue;
            }    // Not found

            $item = $items[$link];

            // Menu link
            $extension = 'com_papiersdefamilles';
            if (isset($item['extension'])) {
                $extension = $item['extension'];
            }

            $url = 'index.php?option=' . $extension;
            if (isset($item['view'])) {
                $url .= '&view=' . $item['view'];
            }
            if (isset($item['layout'])) {
                $url .= '&layout=' . $item['layout'];
            }

            // Is active
            $active = ($item['view'] == $view);
            if (isset($item['layout'])) {
                $active = $active && ($item['layout'] == $layout);
            }

            // Reconstruct it the Joomla format
            $menu[] = array(JText::_($item['label']), $url, $active, $item['icon']);

        }

        return $menu;
    }

    /**
     * Method to a model from a namespace.
     *
     * @access    public static
     *
     * @param    string  $model The namespaced model.
     * @param    boolean $item  Sibling model. true: return ITEM model. false: return LIST model.
     *
     *
     * @since     Cook 3.0.10
     *
     * @return    JModel    The model.
     */
    public static function componentModel($model, $item = null)
    {
        $extension = 'papiersdefamilles';

        $parts = explode('.', $model);
        if (count($parts) > 1) {
            if ($parts[0] != $extension) {
                $extension = $parts[0];
                self::loadComponentModels($extension);
            }
            $model = $parts[1];
        }

        $model = CkJModel::getInstance($model, ucfirst($extension) . 'Model');

        // Return a sibling model
        if ($item === true && method_exists($model, 'getNameItem')) {
            $model = JModelLegacy::getInstance($model->getNameItem(), ucfirst($extension) . 'Model');
        } else {
            if ($item === false && method_exists($model, 'getNameList')) {
                $model = JModelLegacy::getInstance($model->getNameList(), ucfirst($extension) . 'Model');
            }
        }

        return $model;
    }

    /**
     * Deprecated function. Prepare the enumeration static lists.
     * Use Instead : XxxxHelperEnum::_('my_list')
     *
     * @access    public static
     *
     * @param    string $ctrl      The model in wich to find the list.
     * @param    string $fieldName The field reference for this list.
     *
     * @return    array    Prepared arrays to fill lists.
     */
    public static function enumList($ctrl, $fieldName)
    {
        // Proxy to the enumeration helper
        return PapiersdefamillesHelperEnum::_($ctrl . '_' . $fieldName);
    }

    /**
     * Gets a list of the actions that can be performed.
     *
     * @access        public static
     *
     *
     * @deprecated    Cook 2.0
     *
     * @return    JObject    An ACL object containing authorizations
     */
    public static function getAcl()
    {
        return self::getActions();
    }

    /**
     * Gets a list of the actions that can be performed.
     *
     * @access    public static
     *
     * @param    integer $itemId The item ID.
     *
     *
     * @since     1.6
     *
     * @return    JObject    An ACL object containing authorizations
     */
    public static function getActions($itemId = 0)
    {
        if (isset(self::$acl)) {
            return self::$acl;
        }

        $user   = JFactory::getUser();
        $result = new JObject;

        $actions = array(
            'core.enter',
            'core.admin',
            'core.manage',
            'core.create',
            'core.edit',
            'core.edit.state',
            'core.edit.own',
            'core.delete',
            'core.delete.own',
            'core.view.own',
        );

        foreach ($actions as $action) {
            $result->set($action, $user->authorise($action, COM_PAPIERSDEFAMILLES));
        }

        self::$acl = $result;

        return $result;
    }

    /**
     * Return the directories aliases full paths
     *
     * @access    public static
     *
     *
     * @since     Cook 2.6.4
     *
     * @return    array    Arrays of aliases relative path from site root.
     */
    public static function getDirectories()
    {
        if ( ! empty(self::$directories)) {
            return self::$directories;
        }

        $comAlias     = "com_papiersdefamilles";
        $configMedias = JComponentHelper::getParams('com_media');
        $config       = JComponentHelper::getParams($comAlias);

        $directories = array(

            'DIR_FILES' => "[COM_SITE]" . DS . "files",
            'DIR_TRASH' => $config->get("trash_dir", 'images' . DS . "trash"),
            'IMAGES'    => '[IMAGES]',
        );

        $bases = array(
            'COM_ADMIN' => "administrator" . DS . 'components' . DS . $comAlias,
            'ADMIN'     => "administrator",
            'COM_SITE'  => 'components' . DS . $comAlias,
            'IMAGES'    => $config->get('image_path', 'images'),
            'MEDIAS'    => $configMedias->get('file_path', 'images'),
            'ROOT'      => '',

        );


        // Parse the directory aliases
        foreach ($directories as $alias => $directory) {
            // Parse the component base folders
            foreach ($bases as $aliasBase => $directoryBase) {
                $directories[$alias] = preg_replace("/\[" . $aliasBase . "\]/", $directoryBase, $directories[$alias]);
            }

            // Clean tags if remains
            $directories[$alias] = preg_replace("/\[.+\]/", "", $directories[$alias]);
        }

        self::$directories = $directories;

        return self::$directories;

    }

    /**
     * JDom helper. Get a file path or url depending of the method
     *
     * @access    public static
     *
     * @param    string $path    File path. Can contain directories aliases.
     * @param    string $method  Method to access the file : [direct,indirect,physical]
     * @param    array  $attribs Image thumb attributes. Can handle legacy array options.
     *
     *
     * @since     Cook 2.9
     *
     * @return    string    File path or url
     */
    public static function getFile($path, $method = 'physical', $attribs = null)
    {
        if (is_array($attribs)) {
            $attribs = PapiersdefamillesHelperFile::getAttributesFromLegacy($attribs);
        }

        return PapiersdefamillesHelperFile::getFileUrl($path, $method, $attribs);
    }

    /**
     * Load all menu items.
     *
     * @access    public static
     *
     *
     * @since     Cook 2.0
     *
     * @return    void
     */
    public static function getMenuItems()
    {
        // Will be handled in XML in future (or/and with the Joomla native menus)
        // -> give your opinion on j-cook.pro/forum

        $items = array();

        $items['admin.countries.default'] = array(
            'label'  => 'PAPIERSDEFAMILLES_LAYOUT_COUNTRIES',
            'view'   => 'countries',
            'layout' => 'default',
            'icon'   => 'papiersdefamilles_countries'
        );

        $items['admin.regions.default'] = array(
            'label'  => 'PAPIERSDEFAMILLES_LAYOUT_REGIONS',
            'view'   => 'regions',
            'layout' => 'default',
            'icon'   => 'papiersdefamilles_regions'
        );

        $items['admin.provinces.default'] = array(
            'label'  => 'PAPIERSDEFAMILLES_LAYOUT_PROVINCES',
            'view'   => 'provinces',
            'layout' => 'default',
            'icon'   => 'papiersdefamilles_provinces'
        );

        $items['admin.subscriptionplans.default'] = array(
            'label'  => 'PAPIERSDEFAMILLES_LAYOUT_SUBSCRIPTIONPLANS',
            'view'   => 'subscriptionplans',
            'layout' => 'default',
            'icon'   => 'papiersdefamilles_subscriptionplans'
        );

        $items['admin.categories.default'] = array(
            'label'  => 'PAPIERSDEFAMILLES_LAYOUT_CATEGORIES',
            'view'   => 'categories',
            'layout' => 'default',
            'icon'   => 'papiersdefamilles_categories'
        );

        $items['admin.typedocuments.default'] = array(
            'label'  => 'PAPIERSDEFAMILLES_LAYOUT_TYPEDOCUMENTS',
            'view'   => 'typedocuments',
            'layout' => 'default',
            'icon'   => 'papiersdefamilles_typedocuments'
        );

        $items['admin.documents.default'] = array(
            'label'  => 'PAPIERSDEFAMILLES_LAYOUT_DOCUMENTS',
            'view'   => 'documents',
            'layout' => 'default',
            'icon'   => 'papiersdefamilles_documents'
        );

        $items['admin.reservations.default'] = array(
            'label'  => 'PAPIERSDEFAMILLES_LAYOUT_RESERVATIONS',
            'view'   => 'reservations',
            'layout' => 'default',
            'icon'   => 'papiersdefamilles_reservations'
        );

        $items['admin.cpanel.default'] = array(
            'label'  => 'PAPIERSDEFAMILLES_LAYOUT_CONTROL_PANEL',
            'view'   => 'cpanel',
            'layout' => 'default',
            'icon'   => 'papiersdefamilles_cpanel'
        );

        $items['site.cpanel.default'] = array(
            'label'  => 'PAPIERSDEFAMILLES_LAYOUT_CONTROL_PANEL',
            'view'   => 'cpanel',
            'layout' => 'default',
            'icon'   => 'papiersdefamilles_cpanel'
        );

        return $items;
    }

    /**
     * Defines the headers of your template.
     *
     * @access    public static
     *
     * @return    void
     */
    public static function headerDeclarations()
    {
        if (self::$loaded) {
            return;
        }

        $app = JFactory::getApplication();
        $doc = JFactory::getDocument();

        $siteUrl = JURI::root(true);

        $baseSite  = 'components/' . COM_PAPIERSDEFAMILLES;
        $baseAdmin = 'administrator/components/' . COM_PAPIERSDEFAMILLES;

        $componentUrl      = $siteUrl . '/' . $baseSite;
        $componentUrlAdmin = $siteUrl . '/' . $baseAdmin;

        JHtml::_('jquery.framework');
        JHtml::_('formbehavior.chosen', 'select');

        //JDom::_('framework.hook');
        JDom::_('html.icon.glyphicon');


        //Load the jQuery-Validation-Engine (MIT License, Copyright(c) 2011 Cedric Dugas http://www.position-absolute.com)
        self::addScript($baseAdmin, 'js/jquery.validationEngine.js');
        self::addStyleSheet($baseAdmin, 'css/validationEngine.jquery.css');
        PapiersdefamillesHelperHtmlValidator::loadLanguageScript();
        PapiersdefamillesHelperHtmlValidator::attachForm();


        //CSS
        if ($app->isAdmin()) {


            self::addStyleSheet($baseAdmin, 'css/papiersdefamilles.css');
            self::addStyleSheet($baseAdmin, 'css/toolbar.css');

        } else {
            if ($app->isSite()) {
                self::addStyleSheet($baseSite, 'css/papiersdefamilles.css');
                self::addStyleSheet($baseSite, 'css/toolbar.css');

            }
        }


        self::$loaded = true;
    }

    /**
     * Method to include the model paths in the loader.
     *
     * @access    public static
     *
     * @param    string $extension The component alias.
     *
     *
     * @since     Cook 3.0.10
     *
     * @return    void
     */
    public static function loadComponentModels($extension)
    {
        $basePath = (JFactory::getApplication()->isSite() ? JPATH_SITE : JPATH_ADMINISTRATOR);
        CkJModel::addIncludePath($basePath . '/components/com_' . $extension . '/models');
    }

    /**
     * Load the fork file. (Cook Self Service concept)
     *
     * @access    public static
     *
     * @param    string $file Current file to fork.
     *
     *
     * @since     Cook 2.6.3
     *
     * @return    void
     */
    public static function loadFork($file)
    {
        //Transform the file path to reach the fork directory
        $file = preg_replace("#com_papiersdefamilles#", 'com_papiersdefamilles/fork', $file);

        // Load the fork file.
        if ( ! empty($file) && file_exists($file)) {
            include_once($file);
        }
    }

    /**
     * Method to parse a field value.
     *
     * @access    public static
     *
     * @param    Object $item     The item data object.
     * @param    string $labelKey The field key. For concat : {field1} {field2}.
     *
     *
     * @since     Cook 3.0.10
     *
     * @return    mixed    Parsed value.
     */
    public static function parseValue($item, $labelKey)
    {
        preg_match_all('/{([a-zA-Z0-9_]+)}/', $labelKey, $matches);

        if ( ! count($matches[0])) {
            return $item->$labelKey;
        }

        $replaceFrom = array();
        $replaceTo   = array();

        foreach ($matches[1] as $key) {
            $replaceFrom[] = '{' . $key . '}';
            $replaceTo[]   = $item->$key;
        }

        $text = str_replace($replaceFrom, $replaceTo, $labelKey);

        return $text;
    }

    /**
     * Recreate the URL with a redirect in order to : -> keep an good SEF ->
     * always kill the post -> precisely control the request
     *
     * @access    public static
     *
     * @param    array $vars The array to override the current request.
     *
     * @return    string    Routed URL.
     */
    public static function urlRequest($vars = array())
    {
        $parts = array();

        // Authorisated followers
        $authorizedInUrl = array(
            'option' => null,
            'view'   => null,
            'layout' => null,
            'format' => null,
            'Itemid' => null,
            'tmpl'   => null,
            'object' => null,
            'lang'   => null,
            'field'  => null,
        );

        $jinput = JFactory::getApplication()->input;

        $request = $jinput->getArray($authorizedInUrl);

        foreach ($request as $key => $value) {
            if ( ! empty($value)) {
                $parts[] = $key . '=' . $value;
            }
        }

        $cid = $jinput->get('cid', array(), 'ARRAY');
        if ( ! empty($cid)) {
            $cidVals = implode(",", $cid);
            if ($cidVals != '0') {
                $parts[] = 'cid[]=' . $cidVals;
            }
        }

        if (count($vars)) {
            foreach ($vars as $key => $value) {
                $parts[] = $key . '=' . $value;
            }
        }

        return JRoute::_("index.php?" . implode("&", $parts), false);
    }

    /**
     * Method to get price of one ticket
     *
     * @access    public static
     *
     * @param    int    $ticketTypeId    Ticket type item.
     * @param    int    $departureCityId Departure City ID
     * @param    string $departureDate   Departure Date
     *
     *
     * @since     Cook 3.0.10
     *
     * @return    float    Ticket PRice.
     */
    public static function getTicketPrice($ticketTypeId, $departureCityId, $departureDate)
    {
        $modelTicketTypeId = CkJModel::getInstance('Tickettype', 'PapiersdefamillesModel');
        $ticketType        = $modelTicketTypeId->getItem($ticketTypeId);

        $config   = JFactory::getConfig();
        $fromname = $config->get('offset');
        $timezone = new DateTimeZone($fromname);

        $date = new JDate(strtotime($departureDate));
        $date->setTimezone($timezone);

        //$dayOfWeek = $date->format('l');
        $day = intval($date->format('d'));
        //$monthYear = $date->format('F');
        $month = intval($date->format('m'));
        $year  = intval($date->format('Y'));

        $pricelist = json_decode($ticketType->pricelist);
        foreach ($pricelist as $price) {
            //var_dump($price);
        }

        $priceFilterArr = array_filter(
            $pricelist,
            function ($e) use ($departureCityId, $month, $year) {
                return ($e->departure_city_id == $departureCityId && $e->month_id == $month && $e->year == $year);
            }
        );

        if ( ! empty($priceFilterArr)) {
            $priceOject = reset($priceFilterArr);
            // 1st forthnight

            if ($day < 16 && $day >= 1) {
                return $priceOject->price_1;
            }

            if ($day >= 16 && $day <= 31) {
                return $priceOject->price_2;
            }
        }

        return 0;
    }

    /**
     * Method to get type Flight
     *
     * @access    public static
     *
     * @param    int    $ticketTypeId    Ticket type item.
     * @param    int    $departureCityId Departure City ID
     * @param    string $departureDate   Departure Date
     *
     *
     * @since     Cook 3.0.10
     *
     * @return    float    Ticket PRice.
     */
    public static function getTicketFlight($ticketTypeId, $departureCityId, $departureDate)
    {
        $modelTicketTypeId = CkJModel::getInstance('Tickettype', 'PapiersdefamillesModel');
        $ticketType        = $modelTicketTypeId->getItem($ticketTypeId);

        $config   = JFactory::getConfig();
        $fromname = $config->get('offset');
        $timezone = new DateTimeZone($fromname);

        $date = new JDate(strtotime($departureDate));
        $date->setTimezone($timezone);

        //$dayOfWeek = $date->format('l');
        $day = intval($date->format('d'));
        //$monthYear = $date->format('F');
        $month = intval($date->format('m'));
        $year  = intval($date->format('Y'));

        $pricelist = json_decode($ticketType->pricelist);

        $priceFilterArr = array_filter(
            $pricelist,
            function ($e) use ($departureCityId, $month, $year) {
                return ($e->departure_city_id == $departureCityId && $e->month_id == $month && $e->year == $year && $e->type_flight);
            }
        );

        if ( ! empty($priceFilterArr)) {
            $tmp = array();
            foreach ($priceFilterArr as $item) {
                $tmp[] = (int)$item->type_flight;
            }

            return $tmp;
        }

        return 0;
    }

    /**
     * Method to calculate ticket pirce, ticket total, discount
     *
     * @access    public static
     *
     * @param    int    $ticketTypeId    Ticket type item.
     * @param    int    $departureCityId Departure City ID
     * @param    string $departureDate   Departure Date
     *
     *
     * @since     Cook 3.0.10
     *
     * @return    array    (ticket_price, ticket_total, discount).
     */
    public static function calculateTicketPrice(
        $ticketTypeId,
        $departureCityId,
        $departureDate,
        $numberAdultTicket,
        $numberChildrentTicket1,
        $numberChildrentTicket2
    ) {
        if ( ! $ticketTypeId || ! $departureCityId || empty($departureDate) || ! $numberAdultTicket) {
            return array('ticket_price' => 0, 'ticket_total' => 0, 'discount' => 0);
        }


        $ticketPrice = self::getTicketPrice($ticketTypeId, $departureCityId, $departureDate);
        $ticketTotal = round($ticketPrice * $numberAdultTicket + $ticketPrice * $numberChildrentTicket1 + $ticketPrice * $numberChildrentTicket1 * 0.75,
            2);
        $discount    = round($ticketPrice * $numberChildrentTicket1 * 0.15, 2);

        return array('ticket_price' => $ticketPrice, 'ticket_total' => $ticketTotal, 'discount' => $discount);
    }

    /**
     * Get Avatar Image
     *
     * @access    public static
     *
     * @param    int $userId user id
     *
     *
     * @since     v.1.0
     *
     * @return    intg
     */
    public static function getAvatarImage($path)
    {
        $path = json_decode($path);

        $avatars = JFolder::files($path, '.jpg|.png|.jpeg', false, false, array());
        //$avatars = json_encode($avatars);
        if ( ! empty($avatars)) {
            return $path . '/' . $avatars[0];
        }

        return '';
    }

    /**
     * Send Email
     *
     * @access    public static
     *
     * @param    int    $mailto
     * @param    string $subject
     * @param    string $body
     * @param    string $attachFileName
     *
     *
     *
     * @since     v.1.0
     *
     * @return    boolean
     */
    public static function sendMail($mailto, $subject, $body, $attachFileName = "")
    {
        $app    = JFactory::getApplication();
        $mailer = JFactory::getMailer();
        $config = JFactory::getConfig();

        $sender = array(
            $config->get('mailfrom'),
            $config->get('fromname')
        );

        if ($mailto) {
            $recipient = explode(',', $mailto);
        } else {
            $recipient = array($mailto); //$user->email;
        }

        $mailer->setSubject($subject);
        $mailer->isHTML(true);
        $mailer->setBody($body);
        if ( ! empty($attachFileName)) {
            $mailer->addAttachment($attachFileName);
        }

        $mailer->addRecipient($recipient);
        $mailer->setSender($sender);
        $send = $mailer->Send();

        if ($send !== true) {
            //$app->enqueueMessage('Error Sending email:<br/>'.$send->message,'error');
            return false;
        }

        return true;
    }

    /**
     * replaceTags
     *
     * @access    public static
     *
     * @param    string $msg
     * @param    string $search
     * @param    string $replaces
     *
     *
     *
     * @since     v.1.0
     *
     * @return    string
     */
    public static function replaceTags($msg, $search, $replaces)
    {
        $msg = str_replace($search, $replaces, $msg);

        return $msg;
    }

    /**
     * Get Super User Group
     *
     * @access    public
     *
     * @return    void
     */
    public static function getSuperUserGroup()
    {
        $superUsers   = JAccess::getUsersByGroup(8);
        $superUserIds = array();

        foreach ($superUsers as $superUserId) {
            $tmpUser = JFactory::getUser($superUserId);
            if ( ! $tmpUser->block) {
                $superUserIds[] = JFactory::getUser($superUserId);
            }
        }

        return $superUserIds;
    }

    /**
     * Get Admin Group
     *
     * @access    public
     *
     * @return    void
     */
    public static function getAdminGroup()
    {
        $adminUsers = JAccess::getUsersByGroup(7);
        $adminIds   = array();

        foreach ($adminUsers as $adminId) {
            $tmpUser = JFactory::getUser($adminId);
            if ( ! $tmpUser->block) {
                $adminIds[] = JFactory::getUser($adminId);
            }
        }

        return $adminIds;
    }

    /**
     * getIdHotelOfUser
     *
     * @access    public static
     *
     * @param    int $userId user id
     *
     *
     * @since     v.1.0
     *
     * @return    int
     */
    public static function getIdReservationOfUser($userId)
    {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true)
            ->select($db->qn('a.id'))
            ->from($db->qn('#__papiersdefamilles_reservations', 'a'))
            ->where($db->qn('a.created_by') . " = " . $userId);

        $result = $db->setQuery($query)->loadColumn();

        return $result;
    }

    /**
     * Generate information of booking
     *
     * @access    public static
     *
     * @param    int $userId user id
     *
     *
     * @since     v.1.0
     *
     * @return    int
     */
    public static function generateInformationBooking(
        $ticket_type_id_num_id,
        $ticket_type_id_destination,
        $departure_city_id,
        $departure_date,
        $arrival_date
    ) {
        $desc = '';
        $desc .= JText::sprintf('PAPIERSDEFAMILLES_TEXT_TICKET_TYPE', $ticket_type_id_destination) . '<br>';
        $desc .= JText::_('PAPIERSDEFAMILLES_FIELD_DEPARTURE_CITY') . ': ' . $departure_city_id . '<br>';
        $desc .= JText::_('PAPIERSDEFAMILLES_FIELD_DEPARTURE_DATE') . ': ' . JFactory::getDate($departure_date)->format('d-m-Y') . '<br>';

        $desc .= JText::_('PAPIERSDEFAMILLES_FIELD_ARRIVAL_CITY') . ': ' . $ticket_type_id_destination . '<br>';
        $desc .= JText::_('PAPIERSDEFAMILLES_FIELD_ARRIVAL_DATE') . ': ' . JFactory::getDate($arrival_date)->format('d-m-Y') . '<br>';

        return $desc;
    }

    /**
     * Method to set session search.
     *
     * @access    public
     *
     * @return    void
     */
    public static function setInitSessionSearch()
    {
        $mainframe = JFactory::getApplication();

        $main_person = $mainframe->getUserStateFromRequest("module.main_person", 'null');
        $main_person2 = $mainframe->getUserStateFromRequest("module.main_person2", 'null');
        $main_person3 = $mainframe->getUserStateFromRequest("module.main_person3", 'null');
        $main_person4 = $mainframe->getUserStateFromRequest("module.main_person4", 'null');

        $join        = $mainframe->getUserStateFromRequest("module.join", 'null');
        $country     = $mainframe->getUserStateFromRequest("module.country", 'null');
        $region      = $mainframe->getUserStateFromRequest("module.region", 'null');

        if ( ! ($main_person)) {
            $mainframe->setUserState("module.main_person", $main_person);
        }

        if ( ! ($main_person2)) {
            $mainframe->setUserState("module.main_person2", $main_person2);
        }

        if ( ! ($main_person3)) {
            $mainframe->setUserState("module.main_person3", $main_person3);
        }

        if ( ! ($main_person4)) {
            $mainframe->setUserState("module.main_person3", $main_person4);
        }

        if ( ! ($join)) {
            $mainframe->setUserState("module.join", $join);
        }

        if ( ! ($country)) {
            $mainframe->setUserState("module.country", $country);
        }

        if ( ! ($region)) {
            $mainframe->setUserState("module.region", $region);
        }
    }

    /**
     * Get Session User Search
     *
     * @access    public static
     *
     * @param    string $hotelAlias hotelAlias
     * @param    int    $bookingId  booking id
     *
     *
     * @since     v.1.0
     *
     * @return    string
     */
    public static function getSearchSessionUser()
    {
        $mainframe = JFactory::getApplication();

        $main_person = $mainframe->getUserStateFromRequest("module.main_person", 'null');
        $main_person2 = $mainframe->getUserStateFromRequest("module.main_person2", 'null');
        $main_person3 = $mainframe->getUserStateFromRequest("module.main_person3", 'null');
        $main_person4 = $mainframe->getUserStateFromRequest("module.main_person4", 'null');

        $join        = $mainframe->getUserStateFromRequest("module.join", 'null');
        $country     = $mainframe->getUserStateFromRequest("module.country", 'null');
        $region      = $mainframe->getUserStateFromRequest("module.region", 'null');

        return array(
            'main_person' => $main_person,
            'main_person2' => $main_person2,
            'main_person3' => $main_person3,
            'main_person4' => $main_person4,
            'join'        => $join,
            'country'     => $country,
            'region'      => $region
        );
    }

    /**
     * Print Out Locations
     *
     * @access    public static
     *
     *
     * @since     v.1.0
     *
     * @return    string
     */
    public static function printOutLocations($jsonLocations)
    {
        $locations = json_decode($jsonLocations);
        $tmp       = '';

        foreach ($locations as $location) {
            $tmp .= '<div class="location">';
            if (isset($location->region_id) && ! empty($location->region_id)) {
                // Region > Title
                $modelRegion = CkJModel::getInstance('region', 'PapiersdefamillesModel');
                $region      = $modelRegion->getItem($location->region_id);

                if (isset($region->name)) {
                    $tmp .= '<div>' . Jtext::_('PAPIERSDEFAMILLES_FIELD_REGION') . ': ' . $region->name . '</div>';
                }
            }

            if (isset($location->country_id) && ! empty($location->country_id)) {
                $modelCountry = CkJModel::getInstance('country', 'PapiersdefamillesModel');
                $country      = $modelCountry->getItem($location->country_id);

                if (isset($country->name)) {
                    $tmp .= '<div>' . Jtext::_('PAPIERSDEFAMILLES_FIELD_COUNTRY') . ': ' . $country->name . '</div>';
                }
            }

            if (isset($location->city_id) && ! empty($location->city_id)) {
                $modelCity = CkJModel::getInstance('city', 'PapiersdefamillesModel');
                $city      = $modelCity->getItem($location->city_id);

                if (isset($city->name)) {
                    $tmp .= '<div>' . Jtext::_('PAPIERSDEFAMILLES_FIELD_CITY') . ': ' . $city->name . '</div>';
                }
            }

            if (isset($location->departement_id) && ! empty($location->departement_id)) {
                // departement_id
                $modelProvince = CkJModel::getInstance('Province', 'PapiersdefamillesModel');
                $province      = $modelProvince->getItem($location->departement_id);

                if (isset($province->name)) {
                    $tmp .= '<div>' . Jtext::_('PAPIERSDEFAMILLES_FIELD_DEPARTEMENT') . ': ' . $province->name . '</div>';
                }
            }

            $tmp .= '</div>';
            $tmp .= '</br>';
        }

        return $tmp;
    }

    /**
     * Print Out Locations
     *
     * @access    public static
     *
     *
     * @since     v.1.0
     *
     * @return    string
     */
    public static function printOutMainPersons($jsonMainPersons)
    {
        $mainPersons = json_decode($jsonMainPersons);
        $tmp         = '';


        // sort by ordering


        // print out
        foreach ($mainPersons as $mainPerson) {
            $tmp .= '<div class="main-persons">';
            if (isset($mainPerson->surname) && ! empty($mainPerson->surname)) {
                $tmp .= '<div>' . Jtext::_('PAPIERSDEFAMILLES_FIELD_SURNAME') . ': ' . $mainPerson->surname . '</div>';
            }

            if (isset($mainPerson->name) && ! empty($mainPerson->name)) {
                $tmp .= '<div>' . Jtext::_('PAPIERSDEFAMILLES_FIELD_NAME') . ': ' . $mainPerson->name . '</div>';
            }

            if (isset($mainPerson->sex) && ! empty($mainPerson->sex)) {
                $sex = PapiersdefamillesHelperEnum::_('sex')[$mainPerson->sex]['text'];
                $tmp .= '<div>' . Jtext::_('PAPIERSDEFAMILLES_FIELD_SEX') . ': ' . $sex . '</div>';
            }

            $tmp .= '</div>';
            $tmp .= '</br>';
        }

        return $tmp;
    }

    /**
     * Print Out Locations
     *
     * @access    public static
     *
     *
     * @since     v.1.0
     *
     * @return    string
     */
    public static function printOutRawMainPersons($jsonMainPersons, $categories = '')
    {
        $mainPersons = json_decode($jsonMainPersons);
        $tmp         = '';


        // sort by ordering

        // print out only first element
        $k = 0;
        foreach ($mainPersons as $mainPerson) {
            $tmp .= '<div class="main-persons">';

            if (isset($mainPerson->sex) && ! empty($mainPerson->sex) && $k == 0) {
                // Female
                if ($mainPerson->sex == 1) {
                    $tmp .= '<span class="sexe_H">' . JText::_("PAPIERSDEFAMILLES_TEXT_SEXE_H") . '</span>';
                    // Male
                } elseif ($mainPerson->sex == 2) {
                    $tmp .= '<span class="sexe_F">' . JText::_("PAPIERSDEFAMILLES_TEXT_SEXE_F") . '</span>';
                }
            }
            elseif (isset($mainPerson->sex) && ! empty($mainPerson->sex) && $k != 0) {
                // Female
                if ($mainPerson->sex == 1) {
                    $tmp .= '<img class="alliances" src="' . JUri::root() . 'images/alliances.png" alt="épou">';
                    // Male
                } elseif ($mainPerson->sex == 2) {
                    $tmp .= '<img class="alliances" src="' . JUri::root() . 'images/alliances.png" alt="épou">';
                }
            }


            if (isset($mainPerson->name) && ! empty($mainPerson->name)) {
                $tmp .= '<a href="' . JRoute::_("index.php?option=com_papiersdefamilles&view=documents&layout=default&Itemid=136&search_search=" . $mainPerson->name) . '">' . $mainPerson->name . '</a>';
            }

            if (isset($mainPerson->surname) && ! empty($mainPerson->surname)) {
                $text = ucwords(strtolower($mainPerson->surname));
                $tmp  .= ' <span class="prenom">' . $text . '</span>';
            }

            $tmp .= '</div>';
            $k++;
        }

        return $tmp;
    }

    /**
     * Print Out Locations
     *
     * @access    public static
     *
     *
     * @since     v.1.0
     *
     * @return    string
     */
    public static function printOutRawSecondaryPersons($jsonSecondaryPersons, $limit = 2)
    {
        $secondaryPersons = json_decode($jsonSecondaryPersons);
        $tmp              = '';


        // sort by ordering

        // print out only first element
        $k = 0;
        foreach ($secondaryPersons as $secondaryPerson) {
            $tmp .= '<div class="secondary-persons">';

            if (isset($secondaryPerson->name) && ! empty($secondaryPerson->name)) {
                $tmp .= '<a href="' . JRoute::_("index.php?option=com_papiersdefamilles&view=documents&layout=default&Itemid=136&search_search=" . $secondaryPerson->name) . '">' . $secondaryPerson->name . '</a>';

                if (isset($secondaryPersons[$k+1]) && isset($secondaryPersons[$k+1]->name) && ! empty($secondaryPersons[$k+1]->name) && $k+1<=$limit) {
                    $tmp .= ', ';
                }
            }

            $tmp .= '</div>';

            $k++;

            if ($k > $limit) {
                $tmp .= "<span> ...</span>";
                break;
            }
        }

        return $tmp;
    }

    /**
     * Print Out Locations
     *
     * @access    public static
     *
     *
     * @since     v.1.0
     *
     * @return    string
     */
    public static function printOutRawCityLocations($jsonLocations)
    {
        $locations = json_decode($jsonLocations);
        $tmp       = '';

        $count = 0;
        foreach ($locations as $location) {
            if (isset($location->city_id) && ! empty($location->city_id)) {
                if (isset($location->departement_id) && ! empty($location->departement_id)) {
                    $tmp .= $location->city_id . '(' . $location->departement_id . '), ';
                }
                else {
                    $tmp .= $location->city_id . ', ';
                }
            }

            if ($count == 2) {
                if ( ! empty($tmp)) {
                    $tmp = substr($tmp, 0, -2);
                    $tmp .= ' ...';

                    return $tmp;
                }
                break;
            }
        }

        if ( ! empty($tmp)) {
            $tmp = substr($tmp, 0, -2);
        }

        return $tmp;
    }

    /**
     * Print Out Detail Locations
     *
     * @access    public static
     *
     *
     * @since     v.1.0
     *
     * @return    string
     */
    public static function printOutRawDepartmentLocations($jsonLocations)
    {
        $locations = json_decode($jsonLocations);
        $tmp       = '';

        $count = 0;
        $departmentModel = CkJModel::getInstance('Province', 'PapiersdefamillesModel');
        foreach ($locations as $location) {
            if (isset($location->departement_id) && ! empty($location->departement_id)) {
                $province      = $departmentModel->getItem($location->departement_id);

                if (is_object($province) && isset($province->name))
                {
                    $tmp .= $province->name . ', ';
                }
            }

            if ($count == 2) {
                if ( ! empty($tmp)) {
                    $tmp = substr($tmp, 0, -2);
                    $tmp .= ' ...';

                    return $tmp;
                }
                break;
            }
        }

        if ( ! empty($tmp)) {
            $tmp = substr($tmp, 0, -2);
        }

        return $tmp;
    }

    /**
     * Print Out Detail Locations
     *
     * @access    public static
     *
     *
     * @since     v.1.0
     *
     * @return    string
     */
    public static function printOutRawRegionLocations($jsonLocations)
    {
        $locations = json_decode($jsonLocations);
        $tmp       = '';

        $count = 0;
        $regiontModel = CkJModel::getInstance('Region', 'PapiersdefamillesModel');
        foreach ($locations as $location) {
            if (isset($location->region_id) && ! empty($location->region_id)) {
                $region      = $regiontModel->getItem($location->region_id);

                if (is_object($region) && isset($region->name))
                {
                    $tmp .= $region->name . ', ';
                }
            }

            if ($count == 2) {
                if ( ! empty($tmp)) {
                    $tmp = substr($tmp, 0, -2);
                    $tmp .= ' ...';

                    return $tmp;
                }
                break;
            }
        }

        if ( ! empty($tmp)) {
            $tmp = substr($tmp, 0, -2);
        }

        return $tmp;
    }

    /**
     * Print Out Detail Locations
     *
     * @access    public static
     *
     *
     * @since     v.1.0
     *
     * @return    string
     */
    public static function printOutRawCountryLocations($jsonLocations)
    {
        $locations = json_decode($jsonLocations);
        $tmp       = '';

        $count = 0;
        $countryModel = CkJModel::getInstance('Country', 'PapiersdefamillesModel');

        foreach ($locations as $location) {
            if (isset($location->country_id) && ! empty($location->country_id)) {
                $country      = $countryModel->getItem($location->country_id);

                if (is_object($country) && isset($country->name))
                {
                    $tmp .= $country->name . ', ';
                }
            }

            if ($count == 2) {
                if ( ! empty($tmp)) {
                    $tmp = substr($tmp, 0, -2);
                    $tmp .= ' ...';

                    return $tmp;
                }
                break;
            }
        }

        if ( ! empty($tmp)) {
            $tmp = substr($tmp, 0, -2);
        }

        return $tmp;
    }

    /**
     * get List Region
     *
     * @access    public static
     *
     *
     * @since     v.1.0
     *
     * @return    string
     */
    public static function getListRegion($regionId, $isAll)
    {
        $limitQuery = "";

        if ( ! $isAll) {
            $limitQuery = " WHERE id <= " . $regionId . " ORDER BY id DESC LIMIT 10 ";
        }

        // Get 30 items
        $db    = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "SELECT id, name
                FROM #__papiersdefamilles_regions" . $limitQuery;

        $db->setQuery($query);
        $results = $db->loadObjectList();

        $html = '<option value="">- Select Region -</option>';
        foreach ($results as $result) {
            $selected = '';

            if ($result->id == $regionId) {
                $selected = ' selected';
            }

            $html .= '<option value="' . $result->id . '" ' . $selected . '>' . $result->name . '</option>';
        }

        return $html;
    }

    /**
     * get List City
     *
     * @access    public static
     *
     *
     * @since     v.1.0
     *
     * @return    string
     */
    public static function getListCity($cityId, $isAll)
    {
        $limitQuery = "";

        if ( ! $isAll) {
            $limitQuery = " WHERE id <= " . $cityId . " ORDER BY id DESC LIMIT 10 ";
        }

        // Get 30 items
        $db    = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query = "SELECT id, name
                FROM #__papiersdefamilles_cities" . $limitQuery;

        $db->setQuery($query);
        $results = $db->loadObjectList();

        $html = '<option value="">- Select City -</option>';
        foreach ($results as $result) {
            $selected = '';

            if ($result->id == $cityId) {
                $selected = ' selected';
            }

            $html .= '<option value="' . $result->id . '" ' . $selected . '>' . $result->name . '</option>';
        }

        return $html;
    }

    /**
     * get Max Num Id
     *
     * @access    public static
     *
     * @param    int $userId user id
     *
     *
     * @since     v.1.0
     *
     * @return    intg
     */
    public static function getMaxNumId()
    {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);

        $query = "SELECT num_id
                 FROM #__papiersdefamilles_documents AS a 
                 WHERE a.id  =
                    (SELECT MAX(id) FROM #__papiersdefamilles_documents WHERE num_id != '')";

        $result = $db->setQuery($query)->loadResult();

        return $result;
    }

    /**
     * Get Number of total document
     *
     * @access    public static
     *
     *
     *
     * @since     v.1.0
     *
     * @return    int
     */
    public static function getTotalDocuments()
    {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);

        $query = "SELECT COUNT(id) FROM #__papiersdefamilles_documents WHERE num_id != ''";

        $result = $db->setQuery($query)->loadResult();

        return $result;
    }

    /**
     * Get Number of category total document
     *
     * @access    public static
     *
     *
     *
     * @since     v.1.0
     *
     * @return    int
     */
    public static function getTotalCategoryDocuments($categoryId)
    {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);

        $query = "SELECT COUNT(a.id) FROM #__papiersdefamilles_documents AS a
                  INNER JOIN #__papiersdefamilles_documentcategories AS b
                  ON a.id = b.document_id
                  WHERE b.category_id = $categoryId AND a.num_id != ''";

        $result = $db->setQuery($query)->loadResult();

        return $result;
    }

    public static function safeFileName($filename)
    {
        $filename = JFile::makeSafe($filename);
        $ext      = JFile::getExt($filename);

        /*$filename = pathinfo($filename, PATHINFO_FILENAME);
        $filename = strtolower($filename);
        $filename = str_replace(" ", "-", $filename);*/

        $tmpName = preg_replace("/[^0-9]+/", "", microtime());
        $token   = JUserHelper::genRandomPassword(20);

        $filename = strtolower($tmpName . $token);

        return $filename . '.' . $ext;
    }

    public static function clearFileInFolder($destPath)
    {
        $fileInFolders = JFolder::files($destPath, '.jpg|.png|.jpeg|.pdf|.tiff', false, false, array());

        foreach ($fileInFolders as $fileInFolder) {
            $resultDelete = JFile::delete($destPath . DS . $fileInFolder);
        }
    }

    public static function migrateForOldDatabase($destPath)
    {
        $mainPicPath      = JPATH_SITE . DS . json_decode($destPath) . DS . 'document_avatar';
        $thumbPicMainPath = JPATH_SITE . DS . json_decode($destPath) . DS . 'document_avatar' . DS . 'thumb';
        $pdfPath          = JPATH_SITE . DS . json_decode($destPath) . DS . 'pdf';
        $originalPath     = JPATH_SITE . DS . json_decode($destPath) . DS . 'original';
        $tiffPath         = JPATH_SITE . DS . json_decode($destPath) . DS . 'tiff';

        if ( ! file_exists($mainPicPath)) {
            $restultCreate = JFolder::create($mainPicPath);
            chmod($mainPicPath, 0777);
        }

        //if ( ! file_exists($thumbPicMainPath))
        {
            $restultCreate = JFolder::create($thumbPicMainPath);
            chmod($thumbPicMainPath, 0777);

            $avatars = JFolder::files($mainPicPath,
                '.jpg|.png|.jpeg|.pdf', false, false, array());


            if (isset($avatars[0])) {
                $mainPicName      = $avatars[0];
                $thumbMainPicFile = imagecreatefromstring(file_get_contents($mainPicPath . DS . $mainPicName));
                $targetThumb      = $thumbPicMainPath . DS . $mainPicName;
                self::clearFileInFolder($thumbPicMainPath);
                $tmpResult = imagejpeg($thumbMainPicFile, $targetThumb, 0.1);
            }
        }

        if ( ! file_exists($thumbPicMainPath)) {
            $restultCreate = JFolder::create($thumbPicMainPath);
            chmod($thumbPicMainPath, 0777);
        }

        if ( ! file_exists($pdfPath)) {
            $restultCreate = JFolder::create($pdfPath);
            chmod($pdfPath, 0777);
        }

        if ( ! file_exists($originalPath)) {
            $restultCreate = JFolder::create($originalPath);
            chmod($originalPath, 0777);
        }

        if ( ! file_exists($tiffPath)) {
            $restultCreate = JFolder::create($tiffPath);
            chmod($tiffPath, 0777);
        }
    }
}



