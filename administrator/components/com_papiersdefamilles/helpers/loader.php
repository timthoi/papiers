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


// Some usefull constants
if (!defined('DS')) define('DS',DIRECTORY_SEPARATOR);
if (!defined('BR')) define("BR", "<br />");
if (!defined('LN')) define("LN", "\n");

// Main component aliases
if (!defined('COM_PAPIERSDEFAMILLES')) define('COM_PAPIERSDEFAMILLES', 'com_papiersdefamilles');
if (!defined('PAPIERSDEFAMILLES_CLASS')) define('PAPIERSDEFAMILLES_CLASS', 'Papiersdefamilles');

// Component paths constants
if (!defined('JPATH_ADMIN_PAPIERSDEFAMILLES')) define('JPATH_ADMIN_PAPIERSDEFAMILLES', JPATH_ADMINISTRATOR . '/components/' . COM_PAPIERSDEFAMILLES);
if (!defined('JPATH_SITE_PAPIERSDEFAMILLES')) define('JPATH_SITE_PAPIERSDEFAMILLES', JPATH_SITE . '/components/' . COM_PAPIERSDEFAMILLES);

$app = JFactory::getApplication();

// This constant is used for replacing JPATH_COMPONENT, in order to share code between components.
if (!defined('JPATH_PAPIERSDEFAMILLES')) define('JPATH_PAPIERSDEFAMILLES', ($app->isSite()?JPATH_SITE_PAPIERSDEFAMILLES:JPATH_ADMIN_PAPIERSDEFAMILLES));

// Load the component Dependencies
require_once(dirname(__FILE__) . '/helper.php');


jimport('joomla.version');
$version = new JVersion();

if (version_compare($version->RELEASE, '3.0', '<'))
	throw new JException('Joomla! 3.x is required.');

// Proxy alias class : CONTROLLER
if (!class_exists('CkJController')){ 	jimport('legacy.controller.legacy'); 	class CkJController extends JControllerLegacy{}}

// Proxy alias class : MODEL
if (!class_exists('CkJModel')){			jimport('legacy.model.legacy');			class CkJModel extends JModelLegacy{}}

// Proxy alias class : VIEW
if (!class_exists('CkJView')){	if (!class_exists('JViewLegacy', false))	jimport('legacy.view.legacy'); class CkJView extends JViewLegacy{}}

require_once(dirname(__FILE__) . '/../classes/loader.php');

PapiersdefamillesClassLoader::setup(false, false);
PapiersdefamillesClassLoader::discover('Papiersdefamilles', JPATH_ADMIN_PAPIERSDEFAMILLES, false, true);

// Some helpers
PapiersdefamillesClassLoader::register('JToolBarHelper', JPATH_ADMINISTRATOR ."/includes/toolbar.php", true);

CkJController::addModelPath(JPATH_PAPIERSDEFAMILLES . '/models', 'PapiersdefamillesModel');

//Instance JDom
if (!isset($app->dom))
{
	jimport('jdom.dom');
	if (!class_exists('JDom'))
		jexit('JDom plugin is required');

	JDom::getInstance();	
}

