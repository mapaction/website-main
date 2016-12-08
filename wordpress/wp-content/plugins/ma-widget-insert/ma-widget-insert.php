<?php
/*
Plugin Name: Map Action Widget insert
Plugin URI: 
Description: Plugin to create custom widget zones and insert them into pages
Author: Aptivate
Version: 1
Author URI: http://aptivate.org
*/

/*
 * Callback to evaluade the 'widgets' shortcode.
 */
function ma_widgets_shortcode( $attr ) {
	if ( empty( $attr['area'] ) ) {
		return '(please use: [widgets area="widget area"])';
	}
	ob_start();
	dynamic_sidebar( $attr['area'] );
	$output = ob_get_contents();
	ob_end_clean();
	return '<div class="ma-widgets-embed">' . $output . '</div>';
}

/*
 * Register our short code
 */
function ma_widget_insert_init() {
	add_shortcode( 'widgets', 'ma_widgets_shortcode');
}
add_action( 'init', 'ma_widget_insert_init' );

/*
 * Register custom widget areas
 */
function ma_widget_insert_widgets_init() {
	$widget_areas = _ma_insert_widget_get_areas();
	foreach ( $widget_areas as $area) {
		register_sidebar( array(
			'name'          => esc_html__( $area, 'mapaction' ),
			'id'            => preg_replace('/[^-a-z0-9_]/', '', strtolower( $area ) ),
			'description'   => esc_html__( 'Custom widget area. Embed this in a page by adding [widgets area="' . $area . '"]', 'mapaction' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
}
add_action( 'widgets_init', 'ma_widget_insert_widgets_init' );

/*
 * Add out settings page
 */
function ma_insert_widget_add_admin_menu() {
	add_options_page( 'ma_insert_widget', 'Custom Widget Areas', 'manage_options', 'ma_insert_widget', 'ma_insert_widget_options_page' );
}
add_action( 'admin_menu', 'ma_insert_widget_add_admin_menu' );

/*
 * Initialise our settings
 */
function ma_insert_widget_settings_init() {
	register_setting( 'pluginPage', 'ma_insert_widget_settings' );
	add_settings_section(
		'ma_insert_widget_pluginPage_section',
		__( 'Main settings', 'mapaction' ),
		'ma_insert_widget_settings_section_callback',
		'pluginPage'
	);
	add_settings_field(
		'ma_insert_widget_areas',
		__( 'List of custom widget areas', 'mapaction' ),
		'ma_insert_widget_areas_render',
		'pluginPage',
		'ma_insert_widget_pluginPage_section'
	);
}
add_action( 'admin_init', 'ma_insert_widget_settings_init' );

/*
 * Output the 'ma_insert_widget_areas' settings field
 */
function ma_insert_widget_areas_render(  ) {
	$options = get_option( 'ma_insert_widget_settings' );
	echo "<textarea cols='40' rows='5' name='ma_insert_widget_settings[ma_insert_widget_areas]'>";
	echo $options['ma_insert_widget_areas'];
	echo "</textarea>";
}

/*
 * Output header for the settings section
 */
function ma_insert_widget_settings_section_callback() {
	echo "<p>Add one custom widget area per line.</p>";
}

/*
 * Output the options page
 */
function ma_insert_widget_options_page(  ) {
	echo "<form action='options.php' method='post'>";
	echo "<h2>Custom Widget Areas</h2>";
	settings_fields( 'pluginPage' );
	do_settings_sections( 'pluginPage' );
	submit_button();
	echo "</form>";

	$widget_areas = _ma_insert_widget_get_areas();
	echo '<h2>Available shortcodes:</h2>';
	echo '<p>(save the page to update)</p>';
	echo '<ul>';
	foreach ($widget_areas as $area) {
		echo "<li>[widgets area=\"" . $area . "\"]</li>";
	}
	echo '</ul>';
}

/*
 * Return the configured areas
 */
function _ma_insert_widget_get_areas() {
	$widget_areas = array();
	$options = get_option( 'ma_insert_widget_settings' );
	foreach (explode("\n", $options['ma_insert_widget_areas']) as $area) {
		$area = trim($area);
		if ($area) {
			$widget_areas[] = $area;
		}
	}
	return $widget_areas;
}
