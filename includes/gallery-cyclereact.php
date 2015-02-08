<?php

$galleryTransition 	= get_theme_mod( 'solofolio_gallery_transition', 'fade' );

$i = 0;
if ($hasTitleSlide) {
	$i++;
}

if ($thumbnails_enabled) {
	$thumbnails_status_class = 'thumbnails-enabled';
} else {
	$thumbnails_status_class = 'thumbnails-disabled';
}

function solofolio_cyclereact_thumbs_style($thumbs_toggle) {
	if ($thumbs_toggle == "true") {
		return "display: block";
	} else {
		return 'display: none';
	}
}

function solofolio_cyclereact_gallery_style($thumbs_toggle) {
	if ($thumbs_toggle == "true") {
		return "display: none";
	} else {
		return 'display: block';
	}
}

function solofolio_cyclereact_thumbs($attachments, $thumbs, $i) {
	$out = "<ul class='solofolio-cyclereact-thumbs' style='". solofolio_cyclereact_thumbs_style($thumbs) ."'>";

	foreach ( $attachments as $id => $attachment ) {
		$i++;

		$thumb = wp_get_attachment_image_src($id, 'thumbnail');
		$medium = wp_get_attachment_image_src($id, 'medium');
		$caption = solofolio_attachment_caption($attachment);

		$out .= "
		<li class='thumb'><a href='#" . $i . "'>
				<img src='data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=='
						 data-sizes='auto'
						 data-srcset='
						 " . $thumb[0] . " 1x,
	    			 " . $medium[0] . " 2x'
	    			 class='lazyload'>
		</a></li>
		";
	}

	$out .="
	</ul>";

	return $out;
}

function solofolio_cyclereact_controls() {
	if (get_theme_mod( 'solofolio_gallery_controls', 'buttons') == 'text') {
		$out = '
			<ul class="solofolio-cyclereact-controls">
	      <li class="thumbs"><a href="#" data-cycle-cmd="pause">'. __('thumbs', 'solofolio') . '</a></li>
	      <li><a class="prev" href="#">'. __('prev', 'solofolio') . '</a></li>
	      <li><a class="next" href="#">'. __('next', 'solofolio') . '</a></li>
	      <li><span class="solofolio-cyclereact-count"></span></li>
	    </ul>
	  ';
	} else {
		$out = '
			<div class="solofolio-cyclereact-controls">
	      <a class="thumbs" href="#" data-cycle-cmd="pause"><i class="fa fa-th"></i></a>
	      <span class="arrows">
	        <a class="prev" href="#"><i class="fa fa-caret-left"></i></a>
	        <a class="next" href="#"><i class="fa fa-caret-right"></i></a>
	      </span>
	      <span class="solofolio-cyclereact-count"></span>
	    </div>
	  ';
	}

	return $out;
}

function solofolio_cyclereact_caption_container($captions) {
	if ($captions != "false") {
  	return '<p class="solofolio-cyclereact-caption"></p>';
	}
}

function solofolio_cyclereact_timeout($autoplay, $speed) {
	if ($autoplay == "true") {
		return $speed;
	} else {
		return 0;
	}
}

$output .="<div class='solofolio-cyclereact-wrap ". $thumbnails_status_class ."'>";

if ($thumbnails_enabled) {
	$output .= solofolio_cyclereact_thumbs($attachments, $thumbs, $i);
}

$output .="
<div class='solofolio-cyclereact-stage' style='". solofolio_cyclereact_gallery_style($thumbs) ."'>
<div class='solofolio-cyclereact-gallery manual'
	data-cycle-slides='.solofolio-cyclereact-slide'
	data-cycle-prev='.prev'
	data-cycle-next='.next'
	data-cycle-fx='" . $galleryTransition . "'
	data-cycle-log='false'
	data-cycle-manual-speed='500'
	data-cycle-auto-height=false
	data-cycle-caption='.solofolio-cyclereact-caption'
	data-cycle-caption-template='{{cycleTitle}}'
	data-cycle-timeout='" . solofolio_cyclereact_timeout($autoplay, $speed) . "'>";

$i = 0;

if ($hasTitleSlide) {
	$i++;
	$output .= "
	<div class='solofolio-cyclereact-slide solofolio-cyclereact-title solofolio-gallery-title'
		data-cycle-title=''
		data-cycle-hash='" .  $i . "'>
		<div class='solofolio-cyclereact-title-wrapper'>
			<div class='solofolio-cyclereact-title-content'>
				<h2>" . $galleryTitle . "</h2>
				" . wpautop($galleryText) . "
			</div>
		</div>
	</div>
	";
}

foreach ( $attachments as $id => $attachment ) {
	$i++;

	$large = wp_get_attachment_image_src($id, 'large');
	$xlarge = wp_get_attachment_image_src($id, 'xlarge');
	$caption = solofolio_attachment_caption($attachment);

	$output .= "
		<div class='solofolio-cyclereact-slide' id='" . $i . "' data-cycle-hash='" .  $i . "' data-cycle-title='" .  $caption . "'>";

	$output .= "
		<div class='image' style='max-width: " . $xlarge[1] . "px; max-height: " . $xlarge[2] . "px'>
			<img
	    data-sizes='auto'
	    data-srcset='
	    " . $large[0] . " " . $large[1]. "w,
	    " . $xlarge[0] . " " . $xlarge[1]. "w'
	    class='lazyload'
	    width=" . $xlarge[1] . "
	    height=" . $xlarge[2] . "/>
    </div>
	";

	if ($captions != "false" && !empty($caption)) {
		$output .= "<p class='wp-caption-text'>" .  $caption . "</p> ";
	}

	$output .= "</div>";
}

$output .= "
</div>

<div class='solofolio-cyclereact-image-nav'>
	<div class='solofolio-cyclereact-nav-right next'></div>
	<div class='solofolio-cyclereact-nav-thumbs thumbs'></div>
	<div class='solofolio-cyclereact-nav-left prev'></div>
</div>

</div></div>

<div class='solofolio-cyclereact-sidebar " . get_theme_mod( 'solofolio_gallery_controls', 'buttons') . " ". $thumbnails_status_class ."' style='". solofolio_cyclereact_gallery_style($thumbs) ."'>";

$output .= solofolio_cyclereact_caption_container($captions);
$output .= solofolio_cyclereact_controls();
$output .= "</div>";

add_action('wp_footer', 'sl_cyclereact_footer');
if (!function_exists('sl_cyclereact_footer')) {
	function sl_cyclereact_footer() {
		$output = "
		<style type='text/css'>
		@media only screen and (min-width: 1025px) {
			body.page .wrapper { left: " . get_theme_mod( 'solofolio_layout_spacing', '20' ) ."px }
		}
		</style>";
		wp_enqueue_style( 'solofolio-cyclereact', get_template_directory_uri().'/css/cyclereact.css', null, constant('SOLOFOLIO_VERSION') );
		wp_enqueue_script( 'picturefill', get_template_directory_uri().'/js/picturefill.js', array(), constant('SOLOFOLIO_VERSION'), true );
		wp_enqueue_script( 'jquery-cycle2', get_template_directory_uri().'/js/jquery.cycle2.js', array(), null, true );
		wp_enqueue_script( 'lazysizes', get_template_directory_uri().'/js/lazysizes.js', array('jquery'), constant('SOLOFOLIO_VERSION'), true );
		wp_enqueue_script( 'solofolio-cyclereact', get_template_directory_uri().'/js/cyclereact.js', array('jquery'), null, true );
		wp_localize_script( 'solofolio-cyclereact', 'solofolioGallery', array( 'layoutSpacing' => get_theme_mod('solofolio_layout_spacing', '40') ) );

	  echo $output;
	}
}
?>
