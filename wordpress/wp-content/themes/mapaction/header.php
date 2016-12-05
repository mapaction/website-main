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
<?php $icon_path = get_template_directory_uri() . '/icons'; ?>
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $icon_path;?>/apple-touch-icon.png">
<link rel="icon" type="image/png" href="<?php echo $icon_path;?>/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="<?php echo $icon_path;?>/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="<?php echo $icon_path;?>/manifest.json">
<link rel="mask-icon" href="<?php echo $icon_path;?>/safari-pinned-tab.svg" color="#5bbad5">
<link rel="shortcut icon" href="<?php echo $icon_path;?>/favicon.ico">
<meta name="msapplication-config" content="<?php echo $icon_path;?>/browserconfig.xml">
<meta name="theme-color" content="#ffffff">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site site-layout">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'mapaction' ); ?></a>

	<header id="masthead" class="site-header site-header-layout" role="banner">
		<div class="site-emergencies site-emergencies-layout">
		<h1>
			<span class="current-emergency-icon">
				<img src="<?php echo get_template_directory_uri(); ?>/images/emergency_icon.svg"/>
			</span>
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
		<label class="site-navigation-toggle-label site-navigation-toggle-label-layout" for="site-navigation-toggle">Menu</label>
		<nav id="site-navigation" class="main-navigation main-navigation-layout" role="navigation">
			<input type="checkbox" id="site-navigation-toggle" name="site-navigation-toggle"></input>
			<?php wp_nav_menu( array(
				'container' => false,
				'theme_location' => 'primary',
				'menu_id' => 'primary-menu',
				) );
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content site-content-layout">
