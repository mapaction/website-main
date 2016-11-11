<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mapaction
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site site-layout">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'mapaction' ); ?></a>

	<header id="masthead" class="site-header site-header-layout" role="banner">
		<div class="site-emergencies site-emergencies-layout">
		<h1>
			<span class="current-emergency-icon">(!)</span>
			<span class="current-emergency-text"><?php mapaction_menu_title_from_location( 'emergencies' ); ?></span>
		</h1>
		<?php
			wp_nav_menu( array(
				'container' => false,
				'depth' => 1,
				'theme_location' => 'emergencies',
			) );
		?>
		</div>
		<div class="site-branding site-branding-layout">
			<div class="site-logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img alt="<?php bloginfo( 'name' ); ?>"
					src="<?php echo get_template_directory_uri(); ?>/images/logo.svg"/>
				</a>
			</div>
		</div><!-- .site-branding -->
		<nav id="site-navigation" class="main-navigation main-navigation-layout" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'mapaction' ); ?></button>
			<?php wp_nav_menu( array(
				'container' => false,
				'theme_location' => 'primary',
				'menu_id' => 'primary-menu',
				) );
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
