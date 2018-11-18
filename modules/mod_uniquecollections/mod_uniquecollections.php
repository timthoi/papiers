<?php

defined('_JEXEC') or die('Restricted access');

include_once(JPATH_ADMINISTRATOR . '/components/com_papiersdefamilles/helpers/loader.php');
include_once(JPATH_ADMINISTRATOR . '/components/com_papiersdefamilles/helpers/helper.php');
require_once  __DIR__ . '/helper.php';
jimport( 'joomla.user.helper' ); 

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

/*$modelUserBidTours = CkJModel::getInstance('userbidtours', 'PapiersdefamillesModel');
$modelUserBidTours->setState('context', 'module');
$modelUserBidTours->setState('filter.tourbid_id', $cid);
$modelUserBidTours->setState('filter.published', 1);
$modelUserBidTours->setState('filter.auction_status', 1);
$modelUserBidTours->setState('list.limit', $numberCompany);

$userBidTours = $modelUserBidTours->getItems();
$user = JFactory::getUser();

$auctionStatus = PapiersdefamillesHelperEnum::_('auctions_auction_status');*/

$lang = JFactory::getLanguage();
$extension = 'com_papiersdefamilles';
$base_dir = JPATH_SITE;

$language_tag = $lang->getTag();
$langTag = $language_tag;

$reload = true;

$lang->load($extension, $base_dir, $language_tag, $reload);


$reload = true;
$lang->load($extension, $base_dir, $language_tag, $reload);

require JModuleHelper::getLayoutPath('mod_uniquecollections', $params->get('layout', 'default'));
