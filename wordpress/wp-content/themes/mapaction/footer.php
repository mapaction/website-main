<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mapaction
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer site-footer-layout" role="contentinfo">
		<div class="site-footer-inner site-footer-inner-layout">
			<?php dynamic_sidebar('footer'); ?>
			<div class="aptivate-brand">Website by <a href="http://www.aptivate.org" target="_blank">Aptivate</a></div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
