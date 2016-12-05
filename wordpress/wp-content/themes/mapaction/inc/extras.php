<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package mapaction
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function mapaction_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'mapaction_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function mapaction_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}
add_action( 'wp_head', 'mapaction_pingback_header' );

/**
 * Add custom markup to the emergencies menu
 */
function mapaction_markup_emergencies( $items, $args ) {
	if ( $args->theme_location == 'emergencies' ) {
		foreach ( $items as $menu_item ) {
			if ( ! preg_match( '/<.*>/', $menu_item->title ) ) {
				$parts = explode( ',', $menu_item->title, 2 );
				if ( count( $parts ) == 2 ) {
					$menu_item->title = '<span class="emergency-type">' . $parts[0] . ',</span><span class="emergency-location">' . $parts[1] . '</span>';
				}
			}
		}
	}
	return $items;
}
add_filter( 'wp_nav_menu_objects', 'mapaction_markup_emergencies', 10, 2 );

/**
 * Custom mce buttons and styles
 */
function mapaction_mce_buttons( $buttons ) {
	$buttons[] = 'styleselect';
	return $buttons;
}
add_filter( 'mce_buttons', 'mapaction_mce_buttons' );

function mapaction_before_init_insert_formats( $init_array ) {
	$style_formats = array(
		array(
			'title' => 'Blockquotes',
			'icon' => 'blockquote',
			'items' => array(
				array(
					'title' => 'Blockquote',
					'block' => 'blockquote',
					'wrapper' => FALSE,
					'icon' => 'blockquote'
				),
				array(
					'title' => 'Blockquote (with image)',
					'block' => 'blockquote',
					'classes' => 'blockquote-image',
					'wrapper' => FALSE,
					'icon' => 'blockquote'
				),
				array(
					'title' => 'Quote author',
					'inline' => 'span',
					'classes' => 'quote-author',
					'icon' => 'blockquote'
				)
			)
		)
	);
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );

	return $init_array;
}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'mapaction_before_init_insert_formats' );
