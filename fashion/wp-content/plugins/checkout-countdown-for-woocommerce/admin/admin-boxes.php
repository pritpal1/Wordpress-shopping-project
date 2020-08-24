<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function ccfwoo_admin_box_one() {

	echo '<div class="ccfwoo-upgrade-pro">
        <h2>Pro Version</h2>';
	echo '<strong><a href="https://extrawoo.com/plugin/checkout-countdown-woocommerce/?utm_source=active_cc&utm_medium=referral" target="_blank">Learn about Pro features & support</a> </strong>
	<p>Unlock the following:</p>
          <ul style="list-style: initial; margin-left:18px;">
					<li>Clear cart after countdown.</li>
          <li>Redirect after countdown has finished.</li>
          <li>Restart/loop the countdown.</li>
          <li>Recalucate the cart totals with every loop.</li>
					 <li>Start the timer without reloading the page when adding a product to cart (AJAX).</li>
          </ul>';
	echo '<a class="button button-secondary" href="https://extrawoo.com/plugin/checkout-countdown-woocommerce/" target="_blank">Upgrade to Pro</a><br /><br />
        </div>';
}
	add_action( 'ccfwoo_below_page', 'ccfwoo_admin_box_one' );


function ccfwoo_admin_box_two() {
	echo '<div class="ccfwoo-upgrade-pro">
        <h2>Shortcode</h2>
        <p>
        Use the <strong>[cc-countdown]</strong> shortcode anywhere in your theme.
        </p>
        <p>
        The shortcode is unstyled by default. You can apply your style via CSS. Use the example CSS to get started.
        </p>
        <h4>Example CSS</h4>
        <code>.cc-shortcode#cc-countdown-timer {
        text-align: center;
        background: black;
        color: white;
        padding: 10px;
        width: 100%;
        display: inline-block;
        }
        </code>
				  <p>&#9733; <a href="https://wordpress.org/plugins/checkout-countdown-for-woocommerce/#reviews" target="_blank">Leave a review</a> they help a lot</p>
        </div>';
}
	  add_action( 'ccfwoo_below_page', 'ccfwoo_admin_box_two', 2 );



function ccfwoo_admin_box_three() {
	echo '<div class="ccfwoo-upgrade-pro">
              <h2>Wait feature</h2>
              <p>
              Let your customers read your <strong>"Expired Message"</strong> by using the wait on certain
               feature.</p><p>The message will be displayed for X seconds before the action starts.
              </p>
              </div>';
}
			add_action( 'ccfwoo_below_page', 'ccfwoo_admin_box_three' );

function ccfwoo_admin_preview() {

	$ccfwoo_bg   = get_option( 'ccfwoo_style_bg_color' );
	$ccfwoo_font = get_option( 'ccfwoo_style_font_color' );

	$ccfwoo_before_countdown    = get_option( 'ccfwoo_before_countdown' );
	$ccfwoo_inbetween_countdown = get_option( 'ccfwoo_inbetween_countdown' );
	$ccfwoo_behind_countdown    = get_option( 'ccfwoo_after_countdown' );

	echo "<style>
              .cc-demo {
              color: $ccfwoo_font;
              max-width: 800px;
              text-align: center;
              background: $ccfwoo_bg;
              padding: 15px;
              margin: 0 auto;
              margin-bottom: 20px;
              margin-top: -30px;

              }
              .cc-woo-notice {
              max-width:600px;
              padding: 1em 1.618em;
              margin-bottom: 2.617924em;
              background-color: #e2401c;
              margin-left: 0;
              border-radius: 2px;
              color: #ffffff;
              clear: both;
              border-left: .6180469716em solid rgba(0,0,0,.15);
              }
          </style>";

	echo "<div class='ccfwoo-admin-preview'>
              <h4>Preview</h4>
              <div class='cc-demo'>
             $ccfwoo_before_countdown 4 $ccfwoo_inbetween_countdown 39 $ccfwoo_behind_countdown
               </div>
              </div>";
}
			add_action( 'ccfwoo_above_page', 'ccfwoo_admin_preview' );
