jQuery(document).ready(function($){
	$(document).on('click', '.ma-home-image-uploader a', null, function(e) {
		var $uploader = $(this).closest('.ma-home-image-uploader');
		e.preventDefault();
		var image = wp.media({
			'title': 'Upload Image',
			multiple: false
		}).open();
		image.on('select', function(e) {
			var uploaded_image = image.state().get('selection').first();
			var image_url = uploaded_image.toJSON().url;
			image_url = image_url.replace(/^.*\/\/[^\/]+/, '');
			$('input', $uploader).val(image_url);
		});
	});
});
