<?php
/**
 * @package     Joomla.Site
 * @subpackage  Module Company Bid Tours
 *
 * @copyright   Copyright (C) 2017 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<div class="module module-homepage-1">
	<h3>Des Collections Uniques</h3>
	<p class="content">Plus d’un million de documents originaux inédits au service de l’histoire de vos ancêtres :<br> Faire-part de naissance, mariage, décès, état-civil, portraits identifiés, mémentos, biographies... des 17e, 18e et 19e siècles, toujours rares, souvent uniques, et une Librairie Ancienne consacrée à la généalogie.</p>
	<div class="block-content row">
		<div class="col-md-6">
			<div class="bulle_1_home">
				« Quelle magie ! J'ai pu retrouver des portraits photographiques inconnus de mes arrières grands-parents. Merci et belle continuation à Papiers de Familles :) »<col-md- class="auteur">Christophe Vedic</col-md-><img src="<?php echo JUri::root() . '/images/trec1.png' ?>" class="trec_b1">
			</div>
		</div>
		<div class="col-md-6">
			<div class="bulle_2_home">
				« Merci mille fois pour les faire-parts de ma famille dénichés parmi vos incroyables collections ! Grace à vous, j'ai retracé des filiations et pu contacter de proches cousinages. Un site qui manquait. Bravo ! »<col-md- class="auteur">C. Faure</col-md-><img src="<?php echo JUri::root() . '/images/trec2.png' ?>" class="trec_b2">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
            <div class="zone_champs_home">
				<form action="<?php echo (JRoute::_("index.php")); ?>" method="post" name="adminForm" id="adminForm">

					<div class="custom mod_booking_search">
						<div class="row">
							<div class="col-md-5">
								<input type="text" class="form-control champ_home" placeholder="Main Person (Required)" name="search_main_person" value="<?php echo $sessionSearch['main_person']?>">
								<input type="text" class="form-control champ_home" placeholder="Join" name="search_join" value="<?php echo $sessionSearch['join']?>">
							</div>
							<div class="col-md-5">
								<input type="text" class="form-control champ_home" placeholder="Country" name="search_country" value="<?php echo $sessionSearch['country']?>">
								<input type="text" class="form-control champ_home" placeholder="Region" name="search_region value="<?php echo $sessionSearch['region']?>">
							</div>
							<div class="col-md-2">
								<a href="#" onclick="Joomla.submitbutton('documents.setSessionSearch');" class="btn_champ_home"><i class="fa fa-search" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>
                    <?php
                    $jinput = JFactory::getApplication()->input;
                    echo JDom::_('html.form.footer', array(
                            'values' => array(
                                'option' => 'com_papiersdefamilles',
                                'view' => 'documents',
                                'layout' => 'default',
                                'boxchecked' => '0',
                                'task' => 'setSessionSearch'
                            ))
                    );
                    ?>
				</form>
            </div>
		</div>
		<div class="col-md-4">
			<img src="<?php echo JUri::root() . '/images/docs_home2.png' ?>" class="img_docs_home">
		</div>
	</div>
</div>