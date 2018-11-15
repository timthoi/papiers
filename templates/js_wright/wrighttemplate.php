<?php
/**
 * @package     wright
 * @subpackage  TemplateBase
 *
 * @copyright   Copyright (C) 2005 - 2018 Joomlashack.   All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// Restrict Access to within Joomla
defined('_JEXEC') or die('Restricted access');

require_once dirname(__FILE__) . '/wright/template/wrighttemplatebase.php';

/**
 * WrightTemplate class, for special settings of this Wright-based template
 *
 * @package     wright
 * @subpackage  TemplateBase
 * @since       3.0
 */
class WrightTemplate extends WrightTemplateBase
{
	public $templateName = 'wright';

	public $documentationLink = 'https://demo.wright.joomlashack.com/documentation-and-setup/installation';
}
