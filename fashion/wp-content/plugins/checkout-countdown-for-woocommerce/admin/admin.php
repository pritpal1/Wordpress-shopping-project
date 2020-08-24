<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

		add_action( 'admin_menu', 'ccfwoo_create_settings' );
		add_action( 'admin_init', 'ccfwoo_setup_sections', 1 );
		add_action( 'admin_init', 'ccfwoo_setup_fields' );

function ccfwoo_create_settings() {
	$page_title = 'Checkout Countdown';
	$menu_title = 'Countdown';
	$capability = 'manage_options';
	$slug       = 'ccfwoo';
	$callback   = 'ccfwoo_page_callback';
	$icon       = 'dashicons-clock';
	$position   = 100;
	add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
	add_submenu_page('ccfwoo', 'Countdown', 'General', 'manage_options', 'ccfwoo' );
	do_action( 'ccfwoo_menu' );
}

function ccfwoo_page_callback() {
	?>
		   <div class="wrap">
			   <h1 class="ccfwoo-title">Checkout Countdown WooCommerce</h1>
			<?php settings_errors(); ?>
	   <?php do_action( 'ccfwoo_above_page' ); ?>
		<div class="ccfwoo-main-section">
		<form method="POST" action="options.php">
		   <?php
			do_action( 'ccfwoo_above_settings' );
			?>
			   <div class="ccfwoo-section">
		  <?php

			settings_fields( 'ccfwoo_callback' );
			do_settings_sections( 'ccfwoo_callback' );
			?>
			</div>
			  <?php
				submit_button();
				?>
		</div>
		<?php
		do_action( 'ccfwoo_below_page' );
		?>
	  </div>
	<?php
}

function ccfwoo_setup_sections() {

	add_settings_section( 'ccfwoo_section_start', 'Enable', array(), 'ccfwoo_callback' );
	add_settings_section( 'ccfwoo_section_general', 'General', array(), 'ccfwoo_callback' );
	add_settings_section( 'ccfwoo_section_site_banner', 'Site-Wide Banner Options', array(), 'ccfwoo_callback' );
	add_settings_section( 'ccfwoo_section_custom_text', 'Change Text', array(), 'ccfwoo_callback' );
	add_settings_section( 'ccfwoo_section_banner', 'Pre Cart Message', array(), 'ccfwoo_callback' );
	add_settings_section( 'ccfwoo_section_redirection', 'Redirection', array(), 'ccfwoo_callback' );
	add_settings_section( 'ccfwoo_section_loop', 'Loop options', array(), 'ccfwoo_callback' );
	add_settings_section( 'ccfwoo_section_clear', 'Clear Cart', array(), 'ccfwoo_callback' );
	add_settings_section( 'ccfwoo_section_ajax', 'AJAX Support', array(), 'ccfwoo_callback' );
}

function ccfwoo_setup_fields() {

	$fields = array(

		array(
			'label'   => 'Enable (Master Switch)',
			'id'      => 'ccfwoo_enable_countdown',
			'type'    => 'checkbox',
			'section' => 'ccfwoo_section_start',
			'options' => array(
				'yes' => 'Start Countdown',
			),
		),
		array(
			'label'   => 'Countdown Minutes',
			'id'      => 'ccfwoo_minutes',
			'type'    => 'select',
			'section' => 'ccfwoo_section_general',
			'options' => array(
				'5'   => __( '5 Minutes', 'ccfwoo-text-domain' ),
				'10'  => __( '10 Minutes', 'ccfwoo-text-domain' ),
				'15'  => __( '15 Minutes', 'ccfwoo-text-domain' ),
				'20'  => __( '20 Minutes', 'ccfwoo-text-domain' ),
				'25'  => __( '25 Minutes', 'ccfwoo-text-domain' ),
				'30'  => __( '30 Minutes', 'ccfwoo-text-domain' ),
				'35'  => __( '35 Minutes', 'ccfwoo-text-domain' ),
				'40'  => __( '40 Minutes', 'ccfwoo-text-domain' ),
				'45'  => __( '45 Minutes', 'ccfwoo-text-domain' ),
				'50'  => __( '50 Minutes', 'ccfwoo-text-domain' ),
				'55'  => __( '55 Minutes', 'ccfwoo-text-domain' ),
				'60'  => __( '60 Minutes', 'ccfwoo-text-domain' ),
				'0.2' => __( '10 Seconds (for testing)', 'ccfwoo-text-domain' ),
			),
		),

		array(
			'label'   => 'Countdown Type',
			'id'      => 'ccfwoo_countdown_style',
			'type'    => 'radio',
			'section' => 'ccfwoo_section_general',
			'options' => array(
				'site-banner' => __( 'Site-wide Banner', 'ccfwoo-text-domain' ),
				'woo-notice'  => __( 'Checkout & Cart Notice', 'ccfwoo-text-domain' ),
				// 'checkout-notice'  => __( 'Checkout only', 'ccfwoo-text-domain' ),
				// 'notice-cart'  => __( 'Cart only', 'ccfwoo-text-domain' ),
				'shortcode'   => __( 'Shortcode', 'ccfwoo-text-domain' ),
			),
		),
		array(
			'label'       => 'infront of minutes',
			'id'          => 'ccfwoo_before_countdown',
			'type'        => 'text',
			'placeholder' => 'Your order can only be held for',
			'section'     => 'ccfwoo_section_custom_text',
		),
		array(
			'label'       => 'inbetween minutes and seconds',
			'id'          => 'ccfwoo_inbetween_countdown',
			'type'        => 'text',
			'placeholder' => 'minutes and',
			'section'     => 'ccfwoo_section_custom_text',
		),
		array(
			'label'       => 'after seconds',
			'id'          => 'ccfwoo_after_countdown',
			'type'        => 'text',
			'placeholder' => 'seconds, be quick!',
			'section'     => 'ccfwoo_section_custom_text',
		),

		array(
			'label'       => 'Expired message',
			'id'          => 'ccfwoo_expired_text',
			'type'        => 'text',
			'placeholder' => 'We can only hold carts for so long!',
			'section'     => 'ccfwoo_section_custom_text',
		),

		array(
			'label'   => 'Enable Message',
			'id'      => 'ccfwoo_enable_banner_message',
			'class'   => '',
			'type'    => 'checkbox',
			'section' => 'ccfwoo_section_banner',
			'options' => array(
				'yes' => 'Enable Message before a product is added to cart',
			),
		),

		array(
			'label'       => 'Message',
			'id'          => 'ccfwoo_banner_message',
			'type'        => 'text',
			'placeholder' => 'E.g. 30% sale today and tomorrow!',
			'section'     => 'ccfwoo_section_banner',
		),
		array(
			'label'   => 'Background Color',
			'id'      => 'ccfwoo_style_bg_color',
			'class'   => 'ccfwoo-color',
			'type'    => 'color',
			'section' => 'ccfwoo_section_site_banner',
			'desc'    => '',
		),
		array(
			'label'   => 'Font Color',
			'id'      => 'ccfwoo_style_font_color',
			'class'   => 'ccfwoo-color',
			'type'    => 'color',
			'section' => 'ccfwoo_section_site_banner',
			'desc'    => '',
		),

	);

	if ( function_exists( 'ccfwoo_pro_setup_fields' ) ) {
		  $pro_fields = ccfwoo_pro_setup_fields();
		  $fields     = array_merge( $fields, $pro_fields );
	}

	foreach ( $fields as $field ) {
			add_settings_field( $field['id'], $field['label'], 'ccfwoo_field_callback', 'ccfwoo_callback', $field['section'], $field );
			register_setting( 'ccfwoo_callback', $field['id'] );
	}

}

function ccfwoo_field_callback( $field ) {

	$placeholdercheck = '';
	$class            = '';
	if ( isset( $field['class'] ) ) {
		  $class = $field['class'];
	}

	if ( isset( $field['placeholder'] ) ) {
		$placeholdercheck = $field['placeholder'];
	}

		$value = get_option( $field['id'] );

	switch ( $field['type'] ) {

		case 'textarea':
			printf(
				'<textarea name="%1$s" id="%1$s" placeholder="%2$s" class="%3$s" rows="5" cols="50">%4$s</textarea>',
				$field['id'],
				$placeholdercheck,
				$class,
				$value
			);
			break;
		case 'select':
		case 'multiselect':
			if ( ! empty( $field['options'] ) && is_array( $field['options'] ) ) {
				$attr    = '';
				$options = '';
				foreach ( $field['options'] as $key => $label ) {
					// Fix for PHP notice array_search
					if ( is_array( $value ) || is_object( $value ) ) {
						$selectcheck = selected( true, in_array( $key, $value ), false );
					} else {
						$selectcheck = selected( $value, $key, false );
					}

					$options .= sprintf(
						'<option value="%s" %s>%s</option>',
						$key,
						$selectcheck,
						$label
					);
				}
				if ( $field['type'] === 'multiselect' ) {
					$attr = ' multiple="multiple" ';
				}
				printf(
					'<select name="%1$s[]" id="%1$s" %2$s>%3$s</select>',
					$field['id'],
					$attr,
					$options
				);
			}
			break;
		case 'radio':
		case 'checkbox':
			if ( ! empty( $field['options'] ) && is_array( $field['options'] ) ) {
				$options_markup = '';
				$iterator       = 0;

				foreach ( $field['options'] as $key => $label ) {
					// checks if the value is in array. it was throwing a error because second value of array search was a string, when no checkbox was selected.
					if ( is_array( $value ) || is_object( $value ) ) {
						$checkboxcheck = checked( $value[ array_search( $key, $value, true ) ], $key, false );
					} else {
						$checkboxcheck = checked( $value, $key, false );
					}
					$iterator++;
					$options_markup .= sprintf(
						'<label for="%1$s_%6$s"><input id="%1$s_%6$s" name="%1$s[]" type="%2$s" value="%3$s" %4$s /> %5$s</label><br/>',
						$field['id'],
						$field['type'],
						$key,
						$checkboxcheck,
						$label,
						$iterator
					);
				}
					printf(
						'<fieldset>%s</fieldset>',
						$options_markup
					);
			}
			break;
		case 'media':
			printf(
				'<input style="width: 40%%" id="%s" name="%s" type="text" value="%s"> <input style="width: 19%%" class="button test-media" id="%s_button" name="%s_button" type="button" value="Upload" />',
				$field['id'],
				$field['id'],
				$value,
				$field['id'],
				$field['id']
			);
			break;

		case 'wysiwyg':
			wp_editor( $value, $field['id'] );
			break;
		default:
			printf(
				'<input name="%1$s" id="%1$s" type="%2$s" value="%3$s" placeholder="%4$s" class="%5$s"   />',
				$field['id'],
				$field['type'],
				$value,
				$placeholdercheck,
				$class
			);
	}
	if ( isset( $field['desc'] ) ) {
		printf( '<p class="description">%s </p>', $field['desc'] );
	}
}
function ccfwoo_media_fields() {
	?>
	<script>
	  jQuery(document).ready(function($){
		if ( typeof wp.media !== 'undefined' ) {
		  var _custom_media = true,
		  _orig_send_attachment = wp.media.editor.send.attachment;
		  $('.test-media').click(function(e) {
			var send_attachment_bkp = wp.media.editor.send.attachment;
			var button = $(this);
			var id = button.attr('id').replace('_button', '');
			_custom_media = true;
			  wp.media.editor.send.attachment = function(props, attachment){
			  if ( _custom_media ) {
				$('input#'+id).val(attachment.url);
			  } else {
				return _orig_send_attachment.apply( this, [props, attachment] );
			  };
			}
			wp.media.editor.open(button);
			return false;
		  });
		  $('.add_media').on('click', function(){
			_custom_media = false;
		  });
		}
	  });
	</script>
	<?php
}
	add_action( 'admin_footer', 'ccfwoo_media_fields' );

function ccfwoo_enqueue_scripts() {

	if(isset($_GET['page'])) {
	    $page = $_GET['page'];
	} else {
	    $page = 'index';
	}
	$pages = array('ccfwoo','ccfwoo_advanced');

	if( in_array($page, $pages)) {
		// wp_enqueue_style( 'wp-color-picker' );
		// wp_enqueue_script( 'wp-color-picker');
		// wp_enqueue_script('ccfwoo_js', plugins_url('../js/admin.js',__FILE__ ));
		wp_enqueue_style( 'ccfwoo-css', plugins_url( '../includes/ccfwoo.css', __FILE__ ) );
	} else {
		 wp_dequeue_script( 'ccfwoo-css' );
		 // wp_enqueue_style( 'wp-color-picker' );
		 // wp_dequeue_script( 'wp-color-picker');
		 // wp_dequeue_script('ccfwoo_js');
	}
}

	 add_action( 'admin_enqueue_scripts', 'ccfwoo_enqueue_scripts' );
