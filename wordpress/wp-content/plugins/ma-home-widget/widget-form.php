<?php /**
Template to display the widget form. Available fields are:

$title: The widget title
$content: The widget content
$content_type: The type of text in the content field

Each field is an array defining 'id', 'name' and 'value'
**/ ?>
<p>
	<label for="<?php echo esc_attr( $title['id'] ); ?>">
		<?php esc_attr_e( 'Title:', 'text_domain' ); ?>
	</label> 
	<input class="widefat" 
		   id="<?php echo esc_attr( $title['id'] ); ?>"
		   name="<?php echo esc_attr( $title['name'] ); ?>" 
		   type="text" 
		   value="<?php echo esc_attr( $title['value'] ); ?>"
	/>
</p>
<p>
	<label for="<?php echo esc_attr( $background['id'] ); ?>">
		<?php esc_attr_e('Background:', 'text_domain'); ?>
	</label>
	<select class="widefat" 
			id="<?php echo esc_attr( $background['id'] ); ?>"
			name="<?php echo esc_attr( $background['name'] ); ?>"
	><?php foreach ( $background['options'] as $option_value => $option_name ): ?>
		<option value="<?php echo esc_attr( $option_value ); ?>"
				<?php if ( $option_value == $background['value'] ) { echo "selected=\"selected\""; } ?>
		><?php echo esc_html( $option_name ); ?></option>
	<?php endforeach; ?>
	</select>
</p>
<p>
	<label for="<?php echo esc_attr( $content['id'] ); ?>">
		<?php esc_attr_e('Text:', 'text_domain'); ?>
	</label>
	<textarea class="widefat" 
			  id="<?php echo esc_attr( $content['id'] ); ?>"
			  name="<?php echo esc_attr( $content['name'] ); ?>"
			  rows="7" cols="20" ><?php echo $content['value']; ?></textarea>
</p>
<p>
	<label for="<?php echo esc_attr( $content_type['id'] ); ?>">
		<?php esc_attr_e('Type of text:', 'text_domain'); ?>
	</label>
	<select class="widefat" 
			id="<?php echo esc_attr( $content_type['id'] ); ?>"
			name="<?php echo esc_attr( $content_type['name'] ); ?>"
	><?php foreach ( $content_type['options'] as $option_value => $option_name ): ?>
		<option value="<?php echo esc_attr( $option_value ); ?>"
				<?php if ( $option_value == $content_type['value'] ) { echo "selected=\"selected\""; } ?>
		><?php echo esc_html( $option_name ); ?></option>
	<?php endforeach; ?>
	</select>
</p>
<p>
	<div class="ma-home-image-uploader">
		<label for="<?php echo esc_attr( $image['id'] ); ?>">
			<?php esc_attr_e( 'Image:', 'text_domain' ); ?>
		</label>
		<input class="widefat" 
		   	   id="<?php echo esc_attr( $image['id'] ); ?>"
		   	   name="<?php echo esc_attr( $image['name'] ); ?>" 
		   	   type="text" 
		   	   value="<?php echo esc_attr( $image['value'] ); ?>"
		/>
		<a href='#'>
			<?php echo esc_attr_e('Select image'); ?>
		</a>
	</div>
</p>
<p>
	<label for="<?php echo esc_attr( $image_type['id'] ); ?>">
		<?php esc_attr_e('Where to place the image:', 'text_domain'); ?>
	</label>
	<select class="widefat" 
			id="<?php echo esc_attr( $image_type['id'] ); ?>"
			name="<?php echo esc_attr( $image_type['name'] ); ?>"
	><?php foreach ( $image_type['options'] as $option_value => $option_name ): ?>
		<option value="<?php echo esc_attr( $option_value ); ?>"
				<?php if ( $option_value == $image_type['value'] ) { echo "selected=\"selected\""; } ?>
		><?php echo esc_html( $option_name ); ?></option>
	<?php endforeach; ?>
	</select>
</p>
<p>
	<label for="<?php echo esc_attr( $link['id'] ); ?>">
		<?php esc_attr_e( 'Link:', 'text_domain' ); ?>
	</label> 
	<input class="widefat" 
		   id="<?php echo esc_attr( $link['id'] ); ?>"
		   name="<?php echo esc_attr( $link['name'] ); ?>" 
		   type="text" 
		   value="<?php echo esc_attr( $link['value'] ); ?>"
	/>
</p>
<p>
	<label for="<?php echo esc_attr( $link_type['id'] ); ?>">
		<?php esc_attr_e('Which elements open the link:', 'text_domain'); ?>
	</label>
	<select class="widefat" 
			id="<?php echo esc_attr( $link_type['id'] ); ?>"
			name="<?php echo esc_attr( $link_type['name'] ); ?>"
	><?php foreach ( $link_type['options'] as $option_value => $option_name ): ?>
		<option value="<?php echo esc_attr( $option_value ); ?>"
				<?php if ( $option_value == $link_type['value'] ) { echo "selected=\"selected\""; } ?>
		><?php echo esc_html( $option_name ); ?></option>
	<?php endforeach; ?>
	</select>
</p>
