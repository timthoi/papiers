<?php
/**
 * @version
 * @package        Papiersdefamilles
 * @subpackage     Ticket Types
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


JHtml::addIncludePath(JPATH_ADMIN_PAPIERSDEFAMILLES . '/helpers/html');
JHtml::_('behavior.tooltip');
//JHtml::_('behavior.multiselect');

$model     = $this->model;
$user      = JFactory::getUser();
$userId    = $user->get('id');
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
$saveOrder = $listOrder == 'a.ordering' && $listDirn != 'desc';
?>
<div class='list-ticked'>
	<?php foreach ($this->items as $continents): ?>
		<h3 class="continent"><?php echo $continents[0]->_continent_id_name ?></h3>

		<div class="continent-group-item">
			<?php foreach ($continents as $item): ?>
				<div class="span4 item">
					<?php $link = JRoute::_('index.php?option=com_papiersdefamilles&view=reservation&layout=reservation&Itemid=443&tickettype_id=' . $item->id, false); ?>

					<h6 class="location-description">
						<span class="country"><?php echo $item->_country_id_name . ', ' ?></span>
						<span class="city"><?php echo $item->_city_id_name ?></span>
					</h6>

					<div class="item-container">
						<div class="background-img-hover" style="background-image:url('<?php echo PapiersdefamillesHelper::getAvatarImage($item->main_pic) ?>'">
							<img src="<?php echo PapiersdefamillesHelper::getAvatarImage($item->main_pic) ?>"
								 alt="<?php echo $item->_city_id_name ?>">
						</div>

						<div class="item-inner">
							<div class="price">
								<span><?php echo $item->lowest_price ?> </span>
								<span class="currency">€</span>
								<span class="per"><span class="ttc">TTC/</span><span class="pers">pers</span>
							</div>


							<div class="short-description">
								<p><?php echo (strlen($item->short_presentation) > 200) ? substr($item->short_presentation, 0, 200) . ' ...' : $item->short_presentation; ?></p>
							</div>

							<a class='link' href="<?php echo $link ?>"
							   class="readon"><span><?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_READMORE') ?></span></a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="clearfix"></div>

	<?php endforeach; ?>
</div>