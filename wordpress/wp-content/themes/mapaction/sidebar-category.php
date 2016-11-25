<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mapaction
 */

if ( ! is_active_sidebar( 'category-sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area sidebar-navigation sidebar-navigation-layout" role="complementary">
	<?php dynamic_sidebar( 'category-sidebar' ); ?>
</aside><!-- #secondary -->
