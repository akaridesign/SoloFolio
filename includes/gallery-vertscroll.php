<?php

$i = 0;

$output = "<div class='solofolio-vert-scroll-gallery'>";

if ($hasTitleSlide) {
	$output .= "
		<div class='solofolio-gallery-title solofolio-vertscroll-title' id='" . $i . "'>
			<h2>" . $galleryTitle . "</h2>
			<div>" . wpautop($galleryText) . "</div>
		</div>";
	$i++;
}

foreach ( $attachments as $id => $attachment ) {
	$large = wp_get_attachment_image_src($id, 'large');
	$xlarge = wp_get_attachment_image_src($id, 'xlarge');
	$caption = solofolio_attachment_caption($attachment);

	$output .= "<div class='vert-scroll' style='max-width:" . $xlarge[1] . "px' id='" . $i . "'>";

	$output .= "
		<img
    data-sizes='auto'
    data-srcset='
    " . $large[0] . " " . $large[1]. "w,
    " . $xlarge[0] . " " . $xlarge[1]. "w'
    class='lazyload'
    width=" . $xlarge[1] . "
    height=" . $xlarge[2] . "/>
	";

	if ($captions != "false" && !empty($caption)) {
		$output .= "<p class='wp-caption-text'>" .  $caption . "</p>";
	}

	$output .= "</div>";
	$i += 1;
}

$output .= "</div>";

add_action('wp_footer', 'sl_vertscroll_js');
if (!function_exists('sl_vertscroll_js')) {
	function sl_vertscroll_js() {
		wp_enqueue_style( 'solofolio-vertscroll', get_template_directory_uri().'/css/vertscroll.css', null, constant('SOLOFOLIO_VERSION') );
		wp_enqueue_script('picturefill', get_template_directory_uri().'/js/picturefill.js', array(), constant('SOLOFOLIO_VERSION'), true );
		wp_enqueue_script('solofolio-vertscroll', get_template_directory_uri().'/js/vertscroll.js', array(), constant('SOLOFOLIO_VERSION'), true );
		wp_enqueue_script( 'lazysizes', get_template_directory_uri().'/js/lazysizes.js', array('jquery'), constant('SOLOFOLIO_VERSION'), true);
		wp_localize_script( 'solofolio-vertscroll', 'solofolioVertScroll', array( 'layoutSpacing' => get_theme_mod('solofolio_layout_spacing', '40') ) );
	}
}
?>
