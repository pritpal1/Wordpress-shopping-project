<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function ccfwoo_load_js() {
	// Load Javascript and Access settings as variables
	wp_enqueue_script( 'ccfwoo-script-handle', plugin_dir_url( __FILE__ ) . '../js/cc-counter.js', array( 'jquery' ) );

	wp_localize_script(
		'ccfwoo-script-handle', 'ccfwoo_php_vars', array(
			'ccfwoo_minutes'               => get_option( 'ccfwoo_minutes' ),
			'ccfwoo_style_bg_color'        => get_option( 'ccfwoo_style_bg_color' ),
			'ccfwoo_style_font_color'      => get_option( 'ccfwoo_style_font_color' ),
			'ccfwoo_before_text'           => get_option( 'ccfwoo_before_countdown' ),
			'ccfwoo_after_text'            => get_option( 'ccfwoo_after_countdown' ),
			'ccfwoo_expired_text'          => get_option( 'ccfwoo_expired_text' ),
			'ccfwoo_countdown_style'       => get_option( 'ccfwoo_countdown_style' ),
			'ccfwoo_banner_message'        => get_option( 'ccfwoo_banner_message' ),
			'ccfwoo_enable_banner_message' => get_option( 'ccfwoo_enable_banner_message' ),
			'ccfwoo_check_cart'            => WC()->cart->get_cart_contents_count(), // Check the number of products in cart
			'ccfwoo_countdown_style'       => get_option( 'ccfwoo_countdown_style' ),
			'ccfwoo_inbetween_countdown'   => get_option( 'ccfwoo_inbetween_countdown' ),

		)
	);
	 do_action( 'ccfwoo_add_scripts'); // Load from the PRO version
}
 add_action( 'wp_enqueue_scripts', 'ccfwoo_load_js' );

  $ccfwoo_on    = get_option( 'ccfwoo_enable_countdown' );
  $ccfwoo_style = get_option( 'ccfwoo_countdown_style' );

  // Front-end counter if it's enabled on in settings
if ( in_array( 'yes', $ccfwoo_on ) && in_array( 'site-banner', $ccfwoo_style ) ) {
	add_action( 'wp_head', 'ccfwoo_style_banner', 10 );
	// Else if Woo Notice style - add them
} elseif ( in_array( 'yes', $ccfwoo_on ) && in_array( 'woo-notice', $ccfwoo_style ) ) {
	add_action( 'woocommerce_before_checkout_form', 'ccfwoo_checkout_form_notice', 1 );
	add_action( 'woocommerce_before_cart', 'ccfwoo_cart_notice', 11 );
}

  // Check if shortcode is selected and add it
if ( in_array( 'yes', $ccfwoo_on ) && in_array( 'shortcode', $ccfwoo_style ) ) {
	add_shortcode( 'cc-countdown', 'ccfwoo_shortcode' );
}
  // Shortcode content
function ccfwoo_shortcode() {
	echo '<div class="cc-shortcode cc-countdown" id="cc-countdown-timer"></div>';
}

// Countdown on Cart
function ccfwoo_cart_notice() {
	wc_print_notice( __( '<div id="cc-countdown-timer"></div>', 'ccfwoo-text-domain' ), 'error' );
}
// Countdown on Checkout
function ccfwoo_checkout_form_notice() {
	wc_print_notice( __( '<div id="cc-countdown-timer"></div>', 'ccfwoo-text-domain' ), 'error' );
}
// Countdown banner
function ccfwoo_style_banner() {

	$ccfwoo_bg = get_option( 'ccfwoo_style_bg_color' );

	$ccfwoo_font = get_option( 'ccfwoo_style_font_color' );

	$ccfwoo_enable_banner_message = get_option( 'ccfwoo_enable_banner_message' );

	$ccfwoo_cart_check = WC()->cart->get_cart_contents_count();

	?>

<div id="cc-countdown-wrap">
<div id="cc-countdown-timer"></div>
</div>
<style>div#cc-countdown-timer {
width: 100%;
background:<?php echo $ccfwoo_bg; ?>;
color:<?php echo $ccfwoo_font; ?>;
text-align: center;
padding: 10px;
z-index: 999;
position: relative;
display: block;
	<?php
	if ( $ccfwoo_enable_banner_message && ( ! in_array( 'yes', $ccfwoo_enable_banner_message ) && $ccfwoo_cart_check <= 0 ) ) {
		echo 'display: none;';
	} elseif ( ! $ccfwoo_enable_banner_message && $ccfwoo_cart_check <= 0 ) {
		echo 'display: none;';
	}
	?>
}
div#cc-countdown-wrap {
	position: relative;
}
</style>
	<?php

} // end of ccfwoo_style_banner function
