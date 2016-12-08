<?php
/*
Plugin Name: Map Action Home Block Widget
Plugin URI: 
Description: Widget to create the blocks on the Map Action home page
Author: Aptivate
Version: 1
Author URI: http://aptivate.org
*/

/**
 * Adds Ma_Home_Widget widget.
 */
class Ma_Home_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'ma_home_widget',
			esc_html__( 'MapAction Home Block', 'mapaction' ),
			array( 'description' => esc_html__( 'Widget to create the blocks on the Map Action home page', 'mapaction' ), )
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		// Classes to be added to container for styling
		$classes = array();

		// Get the link
		if ( ! empty( $instance['link'] ) ) {
			$link = $instance['link'];
			if ( ! empty( $instance['link_type'] ) ) {
				$link_type = $instance['link_type'];
				if ( $link_type == 'block' ) {
					$classes[] = 'block-as-link';
				}
			} else {
				$link_type = 'title';
			}
		}

		// Get the title
		if ( ! empty( $instance['title'] ) ) {
			$title = apply_filters( 'widget_title', $instance['title'] );
			if ( $link && $link_type == 'title' ) {
				$title = '<a href="' . $link . '">' . $title . '</a>';
			}

			$title = $args['before_title'] . $title . $args['after_title'];
			$classes[] = "with-title";
		} else {
			$title = '';
		}

		// Update classes depending on background
		if ( ! empty( $instance['background'] ) ) {
			$classes[] = 'background-' . $instance['background'];
		}

		// Get the content.
		if ( ! empty( $instance['content'] ) ) {
			if ( empty( $instance['content_type'] ) || $instance['content_type'] == 'plain' ) {
				$content = strip_tags($instance['content']);
			} elseif ( $instance['content_type'] == 'mixed' ) {
				$content = preg_replace('/\n/', '<br />', $instance['content']);
			} else {
				$content = $instance['content'];
			}
			$content = trim( $content );
		} else {
			$content = '';
		}

		// Get the image
		if ( ! empty( $instance['image'] ) ) {
			$image = $instance['image'];
			if ( ! empty( $instance['image_type'] ) ) {
				$classes[] = 'image-' . $instance['image_type'];
				if ( $instance['image_type'] == 'full' ) {
					// Due to poor support for object-fit, we use a background image.
					$background_image = $image;
					$image = False;
				}
			}
		} else {
			$image = '';
		}

		echo $args['before_widget'];
		include dirname(__FILE__) . '/widget-template.php';
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = $this->_get_field_info( 'title', $instance );
		$background = $this->_get_field_info( 'background', $instance, array(
			'options' => array(
				'transparent' => 'Transparent (black text)',
				'light-green' => 'Light green (blue text)',
				'light-grey' => 'Light grey (black text)'
			)
		));
		$content = $this->_get_field_info( 'content', $instance );
		$content_type = $this->_get_field_info( 'content_type', $instance, array(
			'options' => array(
				'plain' => 'Plain text, no HTML',
				'mixed' => 'Contains some HTML, but no paragraphs',
				'html' => 'Contains the exact HTML we want'
			)
		));
		$image = $this->_get_field_info( 'image', $instance );
		$image_type = $this->_get_field_info( 'image_type', $instance, array(
			'options' => array(
				'above' => 'Image should be above the text',
				'right' => 'Image should be right of the text',
				'full' => 'Image should cover the full widget, as background to the text',
			)
		));
		$link = $this->_get_field_info( 'link', $instance );
		$link_type = $this->_get_field_info( 'link_type', $instance, array(
			'options' => array(
				'title' => 'Only the title should be a link',
				'image' => 'Only the image should be a link. Does not work when the image is set as background',
				'block' => 'The whole block should be a link'
			)
		));

		include dirname(__FILE__) . '/widget-form.php';
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array(
			'title' => '',
			'background' => 'transparent',
			'content' => '',
			'content_type' => 'plain',
			'image' => '',
			'image_type' => 'above',
			'link' => '',
			'link_type' => 'title'
		);

		// Save the title
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = strip_tags( $new_instance['title'] );
		}

		// Save background
		if ( ! empty( $new_instance['background'] ) ) {
			$instance['background'] = strip_tags($new_instance['background']);
		}

		// Save the content
		if ( ! empty( $new_instance['content'] ) ) {
			$instance['content']= $new_instance['content'];
		}

		// Save content type
		if ( ! empty( $new_instance['content_type'] ) ) {
			$instance['content_type'] = strip_tags($new_instance['content_type']);
		}

		// Save image
		if ( ! empty( $new_instance['image'] ) ) {
			$instance['image'] = strip_tags($new_instance['image']);
		}

		// Save image type
		if ( ! empty( $new_instance['image_type'] ) ) {
			$instance['image_type'] = strip_tags($new_instance['image_type']);
		}
			
		// Save Link
		if ( ! empty( $new_instance['link'] ) ) {
			$instance['link'] = strip_tags($new_instance['link']);
		}

		// Save link type
		if ( ! empty( $new_instance['link_type'] ) ) {
			$instance['link_type'] = strip_tags($new_instance['link_type']);
		}

		return $instance;
	}

	/**
 	 * Helper method to build the array of information for a field
 	 * passed to the forms template
 	 *
 	 * @param string $field the field name
 	 * @param array $instance the current instance
 	 * @param array $extra optional extra values for the returned info
 	 *
 	 * @return array the info array to be passed to the template
 	 */
	private function _get_field_info($field, $instance, $extra=False) {
		$info = array(
			'id' => $this->get_field_id( $field ),
			'name' => $this->get_field_name( $field ),
			'value' => ! empty( $instance[ $field ] ) ? $instance[ $field ] : '',
		);
		if ( $extra ) {
			$info = array_merge( $info, $extra );
		}
		return $info;
	}
}

// register Ma_Home_Widget widget
function register_ma_home_widget() {
    register_widget( 'Ma_Home_Widget' );
}
add_action( 'widgets_init', 'register_ma_home_widget' );

// Ensure we have media uploader scripts 
function ma_home_widget_load_wp_media_files() {
	wp_enqueue_media();
	wp_enqueue_script(
		'ma-home-upload-widget',
		plugins_url('ma-home-upload.js', __FILE__)
	);
}
add_action( 'admin_enqueue_scripts', 'ma_home_widget_load_wp_media_files' );
