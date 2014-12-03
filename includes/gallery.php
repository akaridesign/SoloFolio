<?php

add_filter( 'post_gallery', 'solofolio_gallery_shortcode', 10, 2 );
function solofolio_gallery_shortcode($output, $attr) {
	global $post, $wp_locale;

	extract(shortcode_atts(array(
		'autoplay' => '',
		'captions' => '',
		'id'         => $post->ID,
		'speed'    => '',
		'thumbs'    => '',
		'transition'    => '',
		'type'    => '',
	), $attr));

	if (isset($attr['ids'])) {
  	$attachment_ids = explode(",", $attr['ids']);
	} else {
		$attachment_ids = array_keys( get_attached_media( 'image', $post->ID ));
	}

	$id = intval($id);

	if ( is_home() ||
			 is_single() ||
			 is_page_template( 'about.php' ) ||
			 is_page_template( 'parent.php' ) ||
			 is_page_template( 'story.php' ) ||
			 preg_match('/(?i)msie [1-8]/',$_SERVER['HTTP_USER_AGENT'])
		 ) {
		$type = "vert-scroll";
	}

	switch ($type) {
		case "vert-scroll":
		case "react":
			include("gallery-vertscroll.php");
			break;
		default:
			include("gallery-cyclereact.php");
			break;
	}

	return $output;
}
?>
