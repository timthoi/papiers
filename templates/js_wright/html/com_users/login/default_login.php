<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');

?>
<div class="login-bg" style="background-repeat: no-repeat;background-size: cover;background-position: center;background-image: url('<?php echo $this->escape($this->params->get('login_image')); ?>');">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="login <?php echo $this->pageclass_sfx; ?>" >
                    <p class="title"><?php echo Jtext::_('COM_USERS_HEADER_LOGIN')?></p>

                    <form id="member-login" action="<?php echo JRoute::_('index.php?option=com_users&task=user.login'); ?>" method="post" class="form-validate form-horizontal ">

                        <fieldset>
                            <?php foreach ($this->form->getFieldset('credentials') as $field) : ?>
                                <?php if (!$field->hidden) : ?>
                                    <div class="control-group">

                                        <div class="controls">
                                            <?php echo $field->input; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <?php if ($this->tfa): ?>
                                <div class="control-group">

                                    <div class="controls">
                                        <?php echo $this->form->getField('secretkey')->input; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="link">

                                <a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
                                    <?php echo JText::_('COM_USERS_LOGIN_RESET'); ?></a>
                            </div>

                            <div class="control-group">
                                <div class="controls">
                                    <button type="submit" class="btn btn-primary btt-red">
                                        <?php echo JText::_('JLOGIN'); ?>
                                    </button>
                                </div>
                            </div>

                            <?php if ($this->params->get('login_redirect_url')) : ?>
                                <input type="hidden" name="return" value="<?php echo base64_encode($this->params->get('login_redirect_url', $this->form->getValue('return'))); ?>" />
                            <?php else : ?>
                                <input type="hidden" name="return" value="<?php echo base64_encode($this->params->get('login_redirect_menuitem', $this->form->getValue('return'))); ?>" />
                            <?php endif; ?>
                            <?php echo JHtml::_('form.token'); ?>
                        </fieldset>
                    </form>


                </div>

            </div>
            <div class="col-md-6">
                <div class="login <?php echo $this->pageclass_sfx; ?>" >

                    <p class="title">
                        <?php echo Jtext::_('COM_USERS_BUTTON_NOT_A_MEMBER')?>
                    </p>

                    <?php if ($this->params->get('login_description')) : ?>
                        <p class="description">
                            <?php echo $this->params->get('login_description'); ?>
                        </p>
                    <?php endif; ?>

                    <div class="controls">
                        <a href="<?php echo JRoute::_('index.php?option=com_users&view=registration&Itemid=179', false)?>" class="btn btn-primary btt-red" role="button"><?php echo Jtext::_('COM_USERS_BUTTON_CREATE_AN_ACCOUNT')?></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    jQuery(function($){
        // Register
        $.validator.messages.required = '';
        $("#member-login").validate({
            onkeyup: false,
            invalidHandler: function (form, validator) {
                var errors = validator.numberOfInvalids();
                if (errors) {
                    validator.errorList[0].element.focus();
                }
            },
            rules: {

                'username': {
                    required: true,
                    email: true
                },
                'password': {
                    required: true
                }

            }
        });
    });
</script>