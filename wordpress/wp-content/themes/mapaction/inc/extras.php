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
