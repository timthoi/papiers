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
            <form action="/vi/" method="post" name="adminForm3" id="adminForm3">

                    <p class="title"><?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_FIND_THE_ARCHIVES_OF_YOUR_FAMILY_')?></p>
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" class="form-control champ_home" placeholder="<?php echo Jtext::_('PAPIERSDEFAMILLES_FIELD_MAIN_PERSON') . ' (' . Jtext::_('PAPIERSDEFAMILLES_TEXT_REQUIRED') . ')'?>">
                            <input type="text" class="form-control champ_home" placeholder="<?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_JOIN')?>">
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control champ_home" placeholder="<?php echo Jtext::_('PAPIERSDEFAMILLES_FIELD_COUNTRY')?>">
                            <input type="text" class="form-control champ_home" placeholder="<?php echo Jtext::_('PAPIERSDEFAMILLES_FIELD_REGION')?>">
                        </div>
                        <div class="col-md-2">
                            <a href="" class="btn_champ_home"><i class="fa fa-search" aria-hidden="true"></i></a>
                        </div>
                    </div>

                    <p class="center">
                        <a href="" class="btn_champ_home"><?php echo Jtext::_('PAPIERSDEFAMILLES_TEXT_ADD_ANOTHER_PERSON')?></a>
                    </p>

            </form>
            </div>
		</div>
		<div class="col-md-4">
			<img src="<?php echo JUri::root() . '/images/docs_home2.png' ?>" class="img_docs_home">
		</div>
	</div>
</div>