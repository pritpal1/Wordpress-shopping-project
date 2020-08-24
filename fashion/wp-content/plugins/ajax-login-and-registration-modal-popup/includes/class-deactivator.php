<?php
/**
 * Fired during plugin deactivation.
 *
 * @since      1.41
 * @author     Maxim K <support@wp-vote.net>
 */
class LRM_Deactivator {

    /**
     * Remove data from database when plugin deactivates
     *
     * @since    1.41
     */
    public static function deactivate() {

        if ( lrm_setting('advanced/uninstall/remove_all_data') ) {

            delete_option("lrm_general");
            delete_option("lrm_advanced");
            delete_option("lrm_messages");
            delete_option("lrm_mails");
            delete_option("lrm_beg_message");
            delete_option("lrm-forms-init");

            delete_option("general_pro");
            delete_option("auto_trigger");
            delete_option("integrations");
            delete_option("messages_pro");

        }

    }
}
