<?php

defined('_JEXEC') or die('Restricted access');

require_once  __DIR__ . '/helper.php';

jimport( 'joomla.user.helper' ); 
jimport( 'joomla.form.formfield' );

$doc             = JFactory::getDocument();
$doc->addStyleSheet(JURI::base() . 'modules/mod_iconslider/css/owl.carousel.min.css');
$doc->addStyleSheet(JURI::base() . 'modules/mod_iconslider/css/owl.theme.default.min.css');
$doc->addScript(JURI::base() . 'modules/mod_iconslider/js/owl.carousel.min.js');

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

$iconIds = $params->get('icon_ids');
$intro = $params->get('intro');

require JModuleHelper::getLayoutPath('mod_iconslider', $params->get('layout', 'default'));
