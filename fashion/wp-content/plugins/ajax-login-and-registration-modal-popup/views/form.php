<!--
<?php
/** @var string $default_tab "login"/"register"/"lost-password" */
$fields_required = ('both' === LRM_Settings::get()->setting('advanced/validation/type')) ? 'required' : '';
//echo LRM_Settings::get()->setting('advanced/validation/type');

$users_can_register = get_option("users_can_register");
?>
-->
<div class="lrm-main <?php echo !$is_inline ? 'lrm-user-modal' : 'lrm-inline is-visible'; ?>" <?php echo !$is_inline ? 'style="visibility: hidden;"' : ''?>> <!-- this is the entire modal form, including the background -->
<!--<div class="lrm-user-modal" style="visibility: hidden;">  this is the entire modal form, including the background -->

    <div class="lrm-user-modal-container"> <!-- this is the container wrapper -->
        <ul class="lrm-switcher <?= ! $users_can_register ? '-is-login-only' : '-is-not-login-only'; ?>">

            <li><a href="#0" class="lrm-switch-to-link lrm-switch-to--login <?php echo !$users_can_register || $is_inline && $default_tab == 'login' ? 'selected' : ''; ?>">
                    <?php echo LRM_Settings::get()->setting('messages/login/heading', true); ?>
                </a></li>

            <?php if ( $users_can_register ): ?>
                <li><a href="#0" class="lrm-switch-to-link lrm-switch-to--register <?php echo $default_tab == 'register' ? 'selected' : ''; ?>">
                    <?php echo LRM_Settings::get()->setting('messages/registration/heading', true); ?>
                </a></li>
            <?php endif; ?>
        </ul>

        <div class="lrm-signin-section <?php echo !$users_can_register || $is_inline && $default_tab == 'login' ? 'is-selected' : ''; ?>"> <!-- log in form -->
            <form class="lrm-form" action="#0" data-action="login">

                <div class="lrm-integrations lrm-integrations--login">
                    <?php do_action( 'lrm/login_form/before' ); ?>
                </div>

                <p class="lrm-form-message lrm-form-message--init"></p>

                <div class="fieldset">
                    <label class="image-replace lrm-email"><?php echo esc_attr( LRM_Settings::get()->setting('messages/login/username', true) ); ?></label>
                    <input name="username" class="full-width has-padding has-border" type="text" placeholder="<?php echo esc_attr( LRM_Settings::get()->setting('messages/login/username', true) ); ?>" <?= $fields_required; ?> value="" autocomplete="username" data-autofocus="1">
                    <span class="lrm-error-message"></span>
                </div>

                <div class="fieldset">
                    <label class="image-replace lrm-password"><?php echo esc_attr( LRM_Settings::get()->setting('messages/login/password', true) ); ?></label>
                    <input name="password" class="full-width has-padding has-border" type="password"  placeholder="<?php echo esc_attr( LRM_Settings::get()->setting('messages/login/password', true) ); ?>" <?= $fields_required; ?> value="">
                    <span class="lrm-error-message"></span>
                    <?php if ( apply_filters('lrm/login_form/allow_show_pass', true) ): ?>
                        <span class="hide-password" data-show="<?php echo LRM_Settings::get()->setting('messages/other/show_pass'); ?>" data-hide="<?php echo LRM_Settings::get()->setting('messages/other/hide_pass'); ?>"><?php echo LRM_Settings::get()->setting('messages/other/show_pass'); ?></span>
                    <?php endif; ?>
                </div>


                <div class="fieldset">
                    <label>
                        <input type="checkbox" name="remember-me" checked> <?php echo LRM_Settings::get()->setting('messages/login/remember-me', true); ?>
                    </label>
                </div>

                <div class="lrm-integrations lrm-integrations--login">
                    <?php do_action( 'lrm_login_form' ); // Deprecated ?>
                    <?php do_action( 'lrm/login_form' ); ?>
                </div>

                <div class="fieldset">
                    <button class="full-width has-padding" type="submit">
                        <?php echo LRM_Settings::get()->setting('messages/login/button', true); ?>
                    </button>
                </div>

                <div class="lrm-integrations lrm-integrations--login">
                    <?php do_action( 'lrm/login_form/after' ); ?>
                </div>

                <input type="hidden" name="lrm_action" value="login">
                <input type="hidden" name="wp-submit" value="1">

                <?php wp_nonce_field( 'ajax-login-nonce', 'security-login' ); ?>

                <!-- For Invisible Recaptcha plugin -->
                <span class="wpcf7-submit" style="display: none;"></span>
            </form>

            <p class="lrm-form-bottom-message"><a href="#0" class="lrm-switch-to--reset-password"><?php echo LRM_Settings::get()->setting('messages/login/forgot-password', true); ?></a></p>
            <!-- <a href="#0" class="lrm-close-form">Close</a> -->
        </div> <!-- lrm-login -->

        <?php if ( $users_can_register ): ?>

        <div class="lrm-signup-section <?php echo $users_can_register && $default_tab == 'register' ? 'is-selected' : ''; ?>"> <!-- sign up form -->
            <?php if ( lrm_is_pro('1.28') && LRM_Pro_UltimateMember::is_ultimatemember_active() && lrm_setting( 'integrations/um/replace_with' ) ): ?>
                <?php LRM_Pro_UltimateMember::render_registration_form(); ?>
            <?php elseif ( lrm_is_pro('1.20') && LRM_Pro_BuddyPress::is_buddypress_active() && LRM_Settings::get()->setting('integrations/bp/on') ): ?>
                <?php LRM_Pro_BuddyPress::render_registration_form(); ?>
            <?php else: ?>

                <form class="lrm-form" action="#0" data-action="registration">

                    <div class="lrm-integrations lrm-integrations--register">
                        <?php do_action( 'lrm/register_form/before' ); ?>
                    </div>

                    <p class="lrm-form-message lrm-form-message--init"></p>

                    <?php if( ! LRM_Settings::get()->setting('general_pro/all/hide_username') ): ?>
                        <div class="fieldset fieldset--username">
                            <label class="image-replace lrm-username" for="signup-username"><?php echo esc_attr( LRM_Settings::get()->setting('messages/registration/username', true) ); ?></label>
                            <input name="username" class="full-width has-padding has-border" id="signup-username" type="text" placeholder="<?php echo esc_attr( LRM_Settings::get()->setting('messages/registration/username') ); ?>" <?= $fields_required; ?>>
                            <span class="lrm-error-message"></span>
                        </div>
                    <?php endif; ?>

                    <?php if( LRM_Settings::get()->setting('general/registration/display_first_and_last_name') ): ?>
                    <div class="fieldset clearfix">
                        <div class="lrm-col-half-width fieldset--first-name">
                            <label class="image-replace lrm-username" for="signup-first-name"><?php echo esc_attr( LRM_Settings::get()->setting('messages/registration/first-name', true) ); ?></label>
                            <input name="first-name" class="full-width has-padding has-border" id="signup-first-name" type="text" placeholder="<?php echo esc_attr( LRM_Settings::get()->setting('messages/registration/first-name') ); ?>" <?= $fields_required; ?>>
                            <span class="lrm-error-message"></span>
                        </div>
                        <div class="lrm-col-half-width lrm-col-last fieldset--last-name">
                            <label class="image-replace lrm-username" for="signup-last-name"><?php echo esc_attr( LRM_Settings::get()->setting('messages/registration/last-name', true) ); ?></label>
                            <input name="last-name" class="full-width has-padding has-border" id="signup-last-name" type="text" placeholder="<?php echo esc_attr( LRM_Settings::get()->setting('messages/registration/last-name') ); ?>">
                            <span class="lrm-error-message"></span>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="fieldset fieldset--email">
                        <label class="image-replace lrm-email" for="signup-email"><?php echo esc_attr( LRM_Settings::get()->setting('messages/registration/email', true) ); ?></label>
                        <input name="email" class="full-width has-padding has-border" id="signup-email" type="email" placeholder="<?php echo esc_attr( LRM_Settings::get()->setting('messages/registration/email') ); ?>" <?= $fields_required; ?> autocomplete="off">
                        <span class="lrm-error-message"></span>
                    </div>

                    <?php if( LRM_Settings::get()->setting('general_pro/all/allow_user_set_password') ): ?>
                        <div class="fieldset">
                            <div class="lrm-position-relative">
                                <label class="image-replace lrm-password" for="signup-password"><?php echo esc_attr( LRM_Settings::get()->setting('messages_pro/registration/password', true) ); ?></label>
                                <input name="password" class="full-width has-padding has-border" id="signup-password" type="password"  placeholder="<?php echo esc_attr( LRM_Settings::get()->setting('messages_pro/registration/password', true) ); ?>" <?= $fields_required; ?> value="" autocomplete="new-password">
                                <span class="lrm-error-message"></span>
                                <span class="hide-password" data-show="<?php echo LRM_Settings::get()->setting('messages/other/show_pass'); ?>" data-hide="<?php echo LRM_Settings::get()->setting('messages/other/hide_pass'); ?>"><?php echo LRM_Settings::get()->setting('messages/other/show_pass'); ?></span>
                            </div>
                            <span class="lrm-pass-strength-result"></span>
                        </div>
                    <?php endif; ?>

                    <div class="lrm-integrations lrm-integrations--register">
                        <?php do_action( 'lrm_register_form' ); ?>
                        <?php do_action( 'lrm/register_form' ); ?>
                    </div>

                    <?php if( ! LRM_Settings::get()->setting('general/terms/off') ): ?>
                        <div class="fieldset">

                            <label>
                                <input type="checkbox" class="lrm-accept-terms" required="required"> <?php echo LRM_Settings::get()->setting('messages/registration/terms', true); ?>
                            </label>
                        </div>
                    <?php endif; ?>

                    <div class="lrm-info lrm-info--register">
                        <?php do_action( 'lrm/register_form/before_button' ); ?>
                    </div>

                    <div class="fieldset">
                        <button class="full-width has-padding" type="submit">
                            <?php echo LRM_Settings::get()->setting('messages/registration/button', true); ?>
                        </button>
                    </div>

                    <div class="lrm-integrations lrm-integrations--register">
                        <?php do_action( 'lrm/register_form/after' ); ?>
                    </div>


                    <input type="hidden" name="lrm_action" value="signup">
                    <input type="hidden" name="wp-submit" value="1">
                    <?php wp_nonce_field( 'ajax-signup-nonce', 'security-signup' ); ?>
                    <!-- For Invisible Recaptcha plugin -->
                    <span class="wpcf7-submit" style="display: none;"></span>

                </form>

            <?php endif; ?>

            <!-- <a href="#0" class="lrm-close-form">Close</a> -->
        </div> <!-- lrm-signup -->

        <?php endif; ?>

        <div class="lrm-reset-password-section <?php echo $users_can_register && $default_tab == 'lost-password' ? 'is-selected' : ''; ?>"> <!-- reset password form -->
            <form class="lrm-form" action="#0" data-action="lost-password">

                <p class="lrm-form-message"><?php echo LRM_Settings::get()->setting('messages/lost_password/message', true); ?></p>

                <div class="fieldset">
                    <label class="image-replace lrm-email"><?php echo LRM_Settings::get()->setting('messages/lost_password/email', true); ?></label>
                    <input class="full-width has-padding has-border" name="user_login" type="text" <?= $fields_required; ?> placeholder="<?php echo esc_attr( LRM_Settings::get()->setting('messages/lost_password/email', true) ); ?>" data-autofocus="1">
                    <span class="lrm-error-message"></span>
                </div>

                <div class="lrm-integrations lrm-integrations--reset-pass">
                    <?php
                    /**
                     * Fires inside the lostpassword form tags, before the hidden fields.
                     *
                     * @since 2.1.0
                     */
                    do_action( 'lrm_lostpassword_form' ); ?>
                </div>

                <input type="hidden" name="lrm_action" value="lostpassword">
                <input type="hidden" name="wp-submit" value="1">
                <?php wp_nonce_field( 'ajax-forgot-nonce', 'security-lostpassword' ); ?>

                <div class="fieldset">
                    <button class="full-width has-padding" type="submit">
                        <?php echo LRM_Settings::get()->setting('messages/lost_password/button', true); ?>
                    </button>
                </div>
                <!-- For Invisible Recaptcha plugin -->
                <span class="wpcf7-submit" style="display: none;"></span>

            </form>

            <p class="lrm-form-bottom-message"><a href="#0" class="lrm-switch-to--login"><?php echo LRM_Settings::get()->setting('messages/lost_password/to_login', true); ?></a></p>
        </div> <!-- lrm-reset-password -->
        <a href="#0" class="lrm-close-form"><?php echo LRM_Settings::get()->setting('messages/other/close_modal'); ?></a>
    </div> <!-- lrm-user-modal-container -->
</div> <!-- lrm-user-modal -->