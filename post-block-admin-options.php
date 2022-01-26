<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

/**
 * Add sub menu page to the Settings menu.
 */
function pb_admin_menu() {

	add_options_page( __( 'Post Block Options', 'post-block' ), __( 'Post Block Options', 'post-block' ), 'manage_options', 'pb-plugin', 'pb_option_page' );
}
add_action( 'admin_menu', 'pb_admin_menu' );

/**
 * Triggered before any other hook when a user accesses the admin area.
 */
function pb_admin_init() {

	/**
	 * Register a setting and its data.
	 */
	register_setting( 'pb-settings-group', 'pb-plugin-settings' );

	/*
	* Add a new section to a settings page.
	*/
	add_settings_section( 'pb-section', __( 'Post Block Section', 'post-block' ), 'pb_section_callback', 'pb-plugin' );

	/*
	* Add a new field to a section of a settings page.
	*/
	add_settings_field( 'pb-heart-react', __( 'Heart React', 'post-block' ), 'pb_heart_react_callback', 'pb-plugin', 'pb-section' );
}
add_action( 'admin_init', 'pb_admin_init' );

/**
 * THE ACTUAL PAGE DISPLAY.
 */
function pb_option_page() {
	?>
	<div class="wrap">
		<h2><?php _e( 'Post Block - Plugin Options', 'post-block' ); ?></h2>
		<form action="options.php" method="POST">
		<?php settings_fields( 'pb-settings-group' ); ?>
		<?php do_settings_sections( 'pb-plugin' ); ?>
		<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

/**
 * THE SECTIONS
 * Hint: You can omit using add_settings_field() and instead
 * directly put the input fields into the sections.
 */
function pb_section_callback() {
	_e( 'Heart react feature will be totaly disable after unchecking this. And also help to increase webpage speed.', 'post-block' );
}

/**
 * THE FIELDS
 */
function pb_heart_react_callback() {
	$settings = (array) get_option( 'pb-plugin-settings' );
	$field    = 'pb_heart_react';
	$value    = esc_attr( $settings[ $field ] );
	echo '<input type="checkbox" name="pb-plugin-settings[' . esc_attr( $field ) . ']" value="1" ' . checked( 1, $settings['pb_heart_react'], false ) . ' />';
}
