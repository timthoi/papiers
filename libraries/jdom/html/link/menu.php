<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <     JDom Class - Cook Self Service library    |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Cook Self Service
* @subpackage	JDom
* @license		GNU General Public License
* @author		Jocelyn HUARD
*
*             .oooO  Oooo.
*             (   )  (   )
* -------------\ (----) /----------------------------------------------------------- +
*               \_)  (_/
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


class JDomHtmlLinkMenu extends JDomHtmlLink
{
	var $fallback = 'submenu';	//Used for default
	
	protected $active;
		
	/*
	 * Constuctor
	 * 	@namespace 	: requested class
	 *  @options	: Configuration
	 *	@href		: Link
	 *	@task		: Task
	 *	@num		: Row num (for grid tasks)
	 *	@link_js	: Javascript for the link
	 *	@content	: Content of the link
	 *	@link_title	: Title of the link (default : @content)
	 *	@target		: Target of the link  (added to natives targets : 'modal')
	 *	@handler	: Modal handler type (ex:iframe)
	 *	@domClass	: CSS class of the link
	 *	@modal_width	: Modal width
	 *	@modal_height	: Modal height
	 *  @alertConfirm	: will prompt an alert box message to confirm 
	 *
	 *	@active		: is active menu link
	 */
	function __construct($args)
	{
		parent::__construct($args);
		$this->arg('active'		, null, $args, false);

	}


}