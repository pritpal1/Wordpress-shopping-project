<?php
/**
 * Plugin Name:       Checkout Countdown for WooCommerce
 * Description:       Adds a flexible WooCommerce checkout countdown for improved cart conversion.
 * Version:           2.3.0
 * Author:            Extra Woo
 * Author URI:        https://extrawoo.com/
 *
 * WC requires at least: 3.0
 * WC tested up to: 3.5
 */

 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
  include( plugin_dir_path( __FILE__ ) . 'admin/admin.php');
  include( plugin_dir_path( __FILE__ ) . 'admin/admin-boxes.php');
  $ccfwoo_section_start = get_option('ccfwoo_enable_countdown');

  if (  $ccfwoo_section_start && in_array('yes' , $ccfwoo_section_start)) {
   include( plugin_dir_path( __FILE__ ) . 'includes/functions.php');
 }

}
else {
  add_action('admin_notices', 'ccfwoo_activate_woocommerce_notice' );
}
// Admin Notice
function ccfwoo_activate_woocommerce_notice() {
  echo '<div class="error"><p>Checkout Countdown requires WooCommerce to be active.</p></div>';
}

function ccfwoo_activate() {
 // Set defaults on activation
 if(!get_option('ccfwoo_license_status')){
      update_option('ccfwoo_license_status', 'free');
  }
  if(!get_option('ccfwoo_minutes')){
      update_option('ccfwoo_minutes', '5');
  }
  if(!get_option('ccfwoo_style_bg_color')){
      update_option('ccfwoo_style_bg_color', '#282828');
  }
  if(!get_option('ccfwoo_style_font_color')){
      update_option('ccfwoo_style_font_color', '#ffffff');
  }
  if(!get_option('ccfwoo_before_countdown')){
      update_option('ccfwoo_before_countdown', 'Your order can  only be held for');
  }
  if(!get_option('ccfwoo_inbetween_countdown')){
      update_option('ccfwoo_inbetween_countdown', 'minutes and');
  }
  if(!get_option('ccfwoo_after_countdown')){
      update_option('ccfwoo_after_countdown', 'seconds, be quick!');
  }
  if(!get_option('ccfwoo_expired_text')){
      update_option('ccfwoo_expired_text', 'We can only hold orders for limited time! Try again');
  }
  if(!get_option('ccfwoo_countdown_style')){
      update_option('ccfwoo_countdown_style', 'site-banner');
  }
  //set_transient( 'ccfwoo_admin_notice_activation', true, 5 );
}
register_activation_hook( __FILE__, 'ccfwoo_activate' );


register_uninstall_hook( __FILE__, 'ccfwoo_delete_all_options' );

// And here goes the uninstallation function:
function ccfwoo_delete_all_options(){

  foreach ( wp_load_alloptions() as $option => $value ) {
      if ( strpos( $option, 'ccfwoo_' ) === 0 ) {
          delete_option( $option );
      }
  }
}
// Update 2.1 Notice
function ccfwoo_admin_notice_activation() {

}

//add_action( 'admin_notices', 'ccfwoo_admin_notice_activation' );
