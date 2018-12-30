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


if ( ! $this->form) {
    return;
}

$fieldSets = $this->form->getFieldsets();

JText::script('PAPIERSDEFAMILLES_TEXT_REMOVE_FILE');
JText::script('PAPIERSDEFAMILLES_TEXT_ARE_YOU_SURE');
JText::script('PAPIERSDEFAMILLES_TEXT_DRAG_DROP_IMAGE');
JText::script('PAPIERSDEFAMILLES_ERROR_DUPLICATE');

?>

<?php $fieldSet = $this->form->getFieldset('document.form');
$pathGalleries  = json_decode($this->item->gallery_pic);
$galleries      = json_decode($this->item->galleries);

$pathMainPics = json_decode($this->item->main_pic);
$mainPic      = json_decode($this->item->avatars);
?>
<fieldset class="fieldsform form-horizontal">
<div class="row">
	<div class="col-md-4">
		<div class="wrapper-main-pic">
            <?php
            $srcPic = JUri::root() . $pathMainPics . '/' . $mainPic;
            ?>
			<div class="image" style="display: none">
				<a rel="gallery" title="" href="<?php echo $srcPic ?>">
					<img src="<?php echo $srcPic ?>">
				</a>
			</div>

		</div>

		<div class="wrapper-gallery-pic">
            <?php foreach ($galleries as $pic):
                $srcPic = JUri::root() . $pathGalleries . '/' . $pic;
                ?>
				<div class="image" style="display: none">
					<a rel="gallery" title="" href="<?php echo $srcPic ?>">
						<img src="<?php echo $srcPic ?>">
					</a>
				</div>
            <?php endforeach; ?>
		</div>

		<div class="">
			<div class="drag_drop_zone_2">
				<div class="control-group-heading">
					<a href="" class="see_gallery_pic"> Voir l'image</a><br>
					<h4><?php echo JText::_('PAPIERSDEFAMILLES_FIELD_MAIN_PIC') ?></h4>
				</div>
				<div class="clearfix"></div>
                <?php

                $this->item->avatars = '';

                if ( ! empty($this->item->main_pic)) {
                    $this->item->avatars = JFolder::files(JPATH_SITE . DS . json_decode($this->item->main_pic),
                        '.jpg|.png|.jpeg',
                        false, false, array());

                    if (isset($this->item->avatars[0])) {
                        $this->item->avatars = ($this->item->avatars[0]);
                    } else {
                        $this->item->avatars = '';
                    }
                }

                $scrTmp = JURI::root(true) . DS . json_decode($this->item->main_pic) . DS . $this->item->avatars;
                ?>

				<img src="<?php echo $scrTmp ?>" alt="main pic" style="width: 100px">
			</div>

			<div class="clearfix"></div>

            <?php
            // Note
            $field = $fieldSet['jform_note'];
            ?>
			<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">

                <?php echo $field->label; ?>
				<div class="controls">

                    <?php echo JDom::_('html.fly', array(
                        'dataKey' => 'note',
                        'dataObject' => $this->item
                    ));?>
				</div>

			</div>
            <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>

		</div>
	</div>
	<div class="col-md-8">

		<div class="">

            <?php
            // code
            $field = $fieldSet['jform_num_id'];
            ?>
			<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
				<div class="control-label">
                    <?php echo $field->label; ?>
				</div>

				<div class="controls">
                    <?php echo JDom::_('html.fly', array(
                        'dataKey' => 'num_id',
                        'dataObject' => $this->item
                    ));?>
				</div>
			</div>
            <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>

            <?php
            // price
            $field  = $fieldSet['jform_price'];
            $cidTmp = (isset($this->item->id)) ? $this->item->id : '';
            ?>
			<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
				<div class="control-label">
                    <?php echo $field->label; ?>
				</div>

				<div class="controls">
                    <?php echo JDom::_('html.fly', array(
                        'dataKey' => 'price',
                        'dataObject' => $this->item
                    ));?>
				</div>
			</div>
            <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>

			<div class="row">
				<div class="col-md-6">
                    <?php
                    // categories
                    $field = $fieldSet['jform_categories'];
                    ?>
					<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
						<div class="control-label">
                            <?php echo $field->label; ?>
						</div>

						<div class="controls">
                            <?php

                            $tmpName = json_decode($this->item->categories);

                            $strTmp = '';

                            if (isset($tmpName[0]))
                            {
                                foreach ($tmpName as $tmp) {$strTmp =  $tmp . ', ';}
                                echo substr($strTmp, 0, -2);
                            }
                            else
                            {echo '-';}
                            ?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
                    <?php
                    // typedocuments
                    $field = $fieldSet['jform_typedocuments'];
                    ?>
					<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
						<div class="control-label">
                            <?php echo $field->label; ?>
						</div>

						<div class="controls">
                            <?php
                            $tmpName = json_decode($this->item->types);

                            $strTmp = '';

                            if (isset($tmpName[0]))
                            {
                                foreach ($tmpName as $tmp) {$strTmp =  $tmp . ', ';}
                                echo substr($strTmp, 0, -2);
                            }
                            else
                            {echo '-';}
                            ?>
						</div>
					</div>
				</div>

			</div>
			<div class="row">
				<div class="col-md-4">
                    <?php
                    // format document
                    $field              = $fieldSet['jform_format_document'];
                    $field->jdomOptions = array(
                        'list' => PapiersdefamillesHelperEnum::_('format_documents')
                    );
                    ?>
					<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
						<div class="control-label">
                            <?php echo $field->label; ?>
						</div>

						<div class="controls">
                            <?php echo JDom::_('html.fly.enum', array(
                                'dataKey' => 'format_document',
                                'dataObject' => $this->item,
                                'labelKey' => 'text',
                                'list' => PapiersdefamillesHelperEnum::_('format_documents'),
                                'listKey' => 'format_documents'
                            ));?>
						</div>
					</div>
                    <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>

				</div>
				<div class="col-md-4">
                    <?php
                    // qualities
                    $field = $fieldSet['jform_qualities'];
                    ?>
					<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
						<div class="control-label">
                            <?php echo $field->label; ?>
						</div>

						<div class="controls">
                            <?php echo JDom::_('html.fly.enum', array(
                                'dataKey' => 'qualities',
                                'dataObject' => $this->item,
                                'labelKey' => 'text',
                                'list' => PapiersdefamillesHelperEnum::_('qualities'),
                                'listKey' => 'qualities'
                            ));?>
						</div>
					</div>
                    <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>

				</div>
				<div class="col-md-4">
                    <?php
                    // number_of_pages
                    $field = $fieldSet['jform_number_of_pages'];
                    ?>
					<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
						<div class="control-label">
                            <?php echo $field->label; ?>
						</div>

						<div class="controls">
                            <?php echo JDom::_('html.fly', array(
                                'dataKey' => 'number_of_pages',
                                'dataObject' => $this->item
                            ));?>
						</div>
					</div>
                    <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>

				</div>
			</div>

            <?php
            // description
            $field = $fieldSet['jform_description'];
            ?>
			<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>"
				 style="display: none">

                <?php echo $field->label; ?>

                <?php echo JDom::_('html.fly', array(
                    'dataKey' => 'description',
                    'dataObject' => $this->item
                ));?>
			</div>
		</div>
        <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>

		<div class="field-location">
			<fieldset class="main_locations ">
				<div class="control-group-heading">
					<h2><?php echo JText::_('PAPIERSDEFAMILLES_LAYOUT_LOCATIONS') ?></h2>
				</div>

                <?php
                // locations
                $field = $fieldSet['jform_locations'];

                ?>
				<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
					<div class="">
                        <?php echo PapiersdefamillesHelper::printOutLocations($this->item->locations);?>
					</div>
				</div>
			</fieldset>

            <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>
		</div>

		<div class="field-location">
			<fieldset class="main_persons">
				<div class="control-group-heading">
					<h2><?php echo JText::_('PAPIERSDEFAMILLES_FIELD_MAIN_PERSONS') ?></h2>
				</div>

                <?php
                // birthday
                $field = $fieldSet['jform_birthday'];
                ?>
				<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
					<div class="control-label">
                        <?php echo $field->label; ?>
					</div>

					<div class="controls" id="jform_birthday">
                        <?php echo JDom::_('html.fly', array(
                            'dataKey' => 'birthday',
                            'dataObject' => $this->item
                        ));?>
					</div>
				</div>
                <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>

                <?php
                // age
                $field = $fieldSet['jform_age'];
                ?>
				<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
					<div class="control-label">
                        <?php echo $field->label; ?>
					</div>

					<div class="controls">
                        <?php echo JDom::_('html.fly', array(
                            'dataKey' => 'age',
                            'dataObject' => $this->item
                        ));?>
					</div>
				</div>
                <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>


                <?php
                // main persons
                $field = $fieldSet['jform_main_persons'];

                ?>
				<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">

					<div class="">
                        <?php echo PapiersdefamillesHelper::printOutMainPersons($this->item->main_persons);?>
					</div>
				</div>
                <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>


			</fieldset>
		</div>

        <?php if ( ! empty(json_decode($this->item->secondary_persons))): ?>
			<div class="field-location">
				<fieldset class="secondary_persons">
					<div class="control-group-heading">
						<h2><?php echo JText::_('PAPIERSDEFAMILLES_LAYOUT_SECONDARY_PERSONS') ?></h2>
					</div>

                    <?php
                    // secondary persons
                    $field = $fieldSet['jform_secondary_persons'];
                    ?>
					<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
						<div class="">
                            <?php echo PapiersdefamillesHelper::printOutMainPersons($this->item->secondary_persons);?>

						</div>
					</div>
                    <?php echo(PapiersdefamillesHelperHtmlValidator::loadValidator($field)); ?>

				</fieldset>
			</div>
        <?php endif; ?>
	</div>
	</div>
</div>

</fieldset>

<?php
$baseAdmin = JURI::root(true) . '/administrator/components/' . COM_PAPIERSDEFAMILLES;
$document  = JFactory::getDocument();
$document->addScript($baseAdmin . '/js/dropzone.js');
$document->addStyleSheet($baseAdmin . '/js/dropzone.css');
$document->addStyleSheet($baseAdmin . '/js/basic.min.css');

$document->addScript($baseAdmin . '/js/jquery.fullscreenslides.js');
$document->addStyleSheet($baseAdmin . '/js/fullscreenstyle.css');
?>
<style>
	.field-location {
		padding: 0 40px;
		border: 2px solid #ccc;
		-moz-border-radius: 8px;
		-webkit-border-radius: 8px;
		border-radius: 8px;
		margin-bottom: 20px;
	}
</style>

<script>

    jQuery(document).ready(function ($) {
        $('.image img').fullscreenslides();
        jQuery(document).on('click', '.see_gallery_pic', function (e) {
            $('.wrapper-main-pic .image:first-child a').click();

            e.preventDefault();
            return false;
        });
        // All events are bound to this container element
        var $container = $('#fullscreenSlideshowContainer');

        $container
        //This is triggered once:
            .bind("init", function () {
                // The slideshow does not provide its own UI, so add your own
                // check the fullscreenstyle.css for corresponding styles
                $container
                    .append('<div class="ui" id="fs-close">&times;</div>')
                    .append('<div class="ui" id="fs-loader">Loading...</div>')
                    .append('<div class="ui" id="fs-prev">&lt;</div>')
                    .append('<div class="ui" id="fs-next">&gt;</div>')
                    .append('<div class="ui" id="fs-caption"><span></span></div>');

                // Bind to the ui elements and trigger slideshow events
                $('#fs-prev').click(function () {
                    // You can trigger the transition to the previous slide
                    $container.trigger("prevSlide");
                });
                $('#fs-next').click(function () {
                    // You can trigger the transition to the next slide
                    $container.trigger("nextSlide");
                });
                $('#fs-close').click(function () {
                    // You can close the slide show like this:
                    $container.trigger("close");
                });

            })
            // When a slide starts to load this is called
            .bind("startLoading", function () {
                // show spinner
                $('#fs-loader').show();
            })
            // When a slide stops to load this is called:
            .bind("stopLoading", function () {
                // hide spinner
                $('#fs-loader').hide();
            })
            // When a slide is shown this is called.
            // The "loading" events are triggered only once per slide.
            // The "start" and "end" events are called every time.
            // Notice the "slide" argument:
            .bind("startOfSlide", function (event, slide) {
                // set and show caption
                $('#fs-caption span').text(slide.title);
                $('#fs-caption').show();
            })
            // before a slide is hidden this is called:
            .bind("endOfSlide", function (event, slide) {
                $('#fs-caption').hide();
            });

        function isValidDate(dateString) {
            var regEx = /^\d{4}-\d{2}-\d{2}$/;
            return dateString.match(regEx) != null;
        }

        var tmpDate = $('#jform_birthday').text().replace(/\s+/g, '');

        if (isValidDate(tmpDate)) {
            // convert date
            var tmpDate = $('#jform_birthday').text();
            var neeDate = tmpDate.split("-").reverse().join("-");
            $('#jform_birthday').text(neeDate).replace(/\s+/g, '');
        }


        $('#jform_num_id').attr('readonly', 'true');
    });
</script>