<?php /**
Template used to display the widget.

Available variables:

$title: widget title, if any
$content: widget content text, if any
**/?>
<?php
	if ( $link && $link_type == 'block' ) {
		$tag = 'a';
		$tag_extra = ' href="' . $link . '"';
	} else {
		$tag = 'div';
		$tag_extra = '';
	}
?>
<<?php echo $tag . $tag_extra; ?> class="ma-home-widget <?php echo implode(' ', $classes); ?>"
	<?php if ( $background_image ): ?>
		style="background-image: url('<?php echo $background_image; ?>')"
	<?php endif; ?>
>
	<?php if ( $title ): ?>
		<?php echo $title; ?>
	<?php endif; ?>
	<?php if ( $image ): ?>
		<?php if ( $link && $link_type == 'image' ): ?>
			<a href="<?php echo $link; ?>">
				<img src="<?php echo $image; ?>" />
			</a>
		<?php else: ?>
			<img src="<?php echo $image; ?>" />
		<?php endif; ?>
	<?php endif; ?>
	<?php if ( $content ): ?>
		<div class='ma-home-widget-text'>
			<?php echo $content; ?>
		</div>
	<?php endif; ?>
</<?php echo $tag; ?>>
