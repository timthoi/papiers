<?php

defined('_JEXEC') or die('Restricted access');

include_once(JPATH_ADMINISTRATOR . '/components/com_papiersdefamilles/helpers/loader.php');
include_once(JPATH_ADMINISTRATOR . '/components/com_papiersdefamilles/helpers/helper.php');
require_once  __DIR__ . '/helper.php';
jimport( 'joomla.user.helper' );
jimport( 'joomla.form.formfield' );

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

$lang = JFactory::getLanguage();
$extension = 'com_papiersdefamilles';
$base_dir = JPATH_SITE;

$language_tag = $lang->getTag();
$langTag = $language_tag;

$reload = true;

$lang->load($extension, $base_dir, $language_tag, $reload);

// Get New value
PapiersdefamillesHelper::setInitSessionSearch();
$sessionSearch = PapiersdefamillesHelper::getSearchSessionUser();

require JModuleHelper::getLayoutPath('mod_uniquecollections', $params->get('layout', 'default'));
