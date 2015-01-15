<?php

add_filter( 'post_gallery', 'solofolio_gallery_shortcode', 10, 2 );
function solofolio_gallery_shortcode($output, $attr) {
	global $post, $wp_locale;

	extract(shortcode_atts(array(
		'autoplay' 						=> '',
		'captions' 						=> '',
		'id'         					=> $post->ID,
		'include'    					=> '',
    'exclude'    					=> '',
		'order'      					=> 'ASC',
    'orderby'    					=> 'menu_order ID',
    'size'								=> 'window',
		'speed'    						=> '3000',
		'thumbs'    					=> '',
		'thumbnails_enabled'	=> 'true',
		'transition'  				=> '',
		'type'    						=> '',
	), $attr));

	$thumbnails_enabled = ($thumbnails_enabled == 'true');

	if (isset($attr['ids'])) {
		$_attachments = get_posts( array('include' => $attr['ids'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
	  foreach ( $_attachments as $key => $val ) {
	    $attachments[$val->ID] = $_attachments[$key];
	  }
	} else {
		if ( !empty($include) ) {
		  $include = preg_replace( '/[^0-9,]+/', '', $include );
		  $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		  $attachments = array();
		  foreach ( $_attachments as $key => $val ) {
		    $attachments[$val->ID] = $_attachments[$key];
		  }
		} elseif ( !empty($exclude) ) {
		  $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
		  $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		} else {
		  $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}
	}

	$id = intval($id);

	# Use vertscroll as default if none is set in these cases
	if (empty($type)) {
		if ( is_home() ||
				 is_single() ||
				 is_page_template( 'about.php' ) ||
				 is_page_template( 'parent.php' ) ||
				 is_page_template( 'story.php' )
			 ) {
			$type = "vert-scroll";
		}
	}

	# Send old versions of IE to vert scroll gallery
	if ( preg_match('/(?i)msie [1-8]/',$_SERVER['HTTP_USER_AGENT']) ) {
		$type = "vert-scroll";
	}

	$galleryTitle = get_post_meta($post->ID, 'solofolio-gallery-title', true);
	$galleryText 	= get_post_meta($post->ID, 'solofolio-gallery-text', true);
	$hasTitleSlide = (!empty($galleryTitle) || !empty($galleryText));

	switch ($type) {
		case "vert-scroll":
		case "react":
			include("gallery-vertscroll.php");
			break;
		case "solofolio":
		default:
			include("gallery-cyclereact.php");
			break;
	}

	return $output;
}
?>
