<?php

defined('_JEXEC') or die('Restricted access');

require_once  __DIR__ . '/helper.php';
jimport( 'joomla.user.helper' ); 

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');
/*
$lang = JFactory::getLanguage();
$extension = 'com_rickbuy';
$base_dir = JPATH_SITE;

$language_tag = $lang->getTag();
$langTag = $language_tag;

$reload = true;

$lang->load($extension, $base_dir, $language_tag, $reload);*/


require JModuleHelper::getLayoutPath('mod_logo', $params->get('layout', 'default'));
