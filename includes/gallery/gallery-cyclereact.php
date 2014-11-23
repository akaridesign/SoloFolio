<?php

$output .="<div class=\"solofolio-cyclereact-wrap\">";

$output .="<ul class=\"solofolio-cyclereact-thumbs\">";

$galleryTitle = get_post_meta($post->ID, 'solofolio-gallery-title', true);
$galleryText 	= get_post_meta($post->ID, 'solofolio-gallery-text', true);
$galleryTransition = get_theme_mod( 'solofolio_gallery_transition', 'fade');

$i = 0;
if ($galleryTitle || $galleryText) {
	$i++;
}

foreach ($attachment_ids as $id) {
	$attachment = get_post($id);
	$i++;

	$thumb = wp_get_attachment_image_src($id, 'thumbnail');
	$medium = wp_get_attachment_image_src($id, 'medium');

	if (!empty($attachment->post_excerpt)) {
		$caption = wptexturize($attachment->post_excerpt);
	} else {
		$caption = wptexturize($attachment->post_content);
	}

	$output .= "<li class=\"thumb\">
								<a href=\"#" . $i . "\">
									<img src=\"" . $thumb[0] . "\" data-retina=\"" . $medium[0] . "\" alt=\"" .  $caption . "\">
								</a>
							</li>";
}

$output .="</ul>";

$output .="<div class=\"solofolio-cyclereact-stage\">";

$output .="<div class=\"solofolio-cyclereact-gallery cycle-slideshow manual\"
								data-cycle-slides=\".solofolio-cyclereact-slide\"
								data-cycle-prev=\".prev\"
								data-cycle-next=\".next\"
								data-cycle-fx=\"" . $galleryTransition . "\"
								data-cycle-log=\"false\"
								data-cycle-manual-speed=\"500\"
								data-cycle-auto-height=false
								data-cycle-caption=\".solofolio-cyclereact-caption\"
								data-cycle-caption-template=\"{{cycleTitle}}\"";
								if ( $autoplay == "true" && isset( $speed )) {
									$output .= "data-cycle-timeout=". $speed;
								} else {
									$output .= "data-cycle-timeout=0\n";
								}
$output .= ">\n\n";

$i = 0;

if ($galleryTitle || $galleryText) {
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
		</div>";
}

foreach ($attachment_ids as $id) {
	$attachment = get_post($id);
	$i++;

	$link = wp_get_attachment_url($id);
	$link3 = wp_get_attachment_image_src($id, 'thumbnail');
	$link4 = wp_get_attachment_image_src($id, 'large');
	$link5 = wp_get_attachment_image_src($id, 'xlarge');
	$link6 = wp_get_attachment_image_src($id, 'medium');

	if (!empty($attachment->post_excerpt)) {
		$caption = wptexturize($attachment->post_excerpt);
	} else {
		$caption = wptexturize($attachment->post_content);
	}

	$output .= "\n\n<div class='solofolio-cyclereact-slide' id='" . $i . "'
											 data-cycle-hash=\"" .  $i . "\"
											 data-cycle-title=\"" .  $caption . "\">";

	$output .= "
		<img
    data-sizes=\"auto\"
    data-srcset=\"
    " . $link4[0] . " " . $link4[1]. "w,
    " . $link5[0] . " " . $link5[1]. "w\"
    class=\"lazyload\"
    width=" . $link5[1] . "
    height=" . $link5[2] . "/>
	";

	if ($captions != "false" && !empty($caption)) {
		$output .= "<p class=\"wp-caption-text\">" .  $caption . "</p> ";
	}

	$output .= "</div>";
}

$output .= "</div>\n";

$output .="<div class=\"solofolio-cyclereact-image-nav\">
		<div class=\"solofolio-cyclereact-nav-right next\"></div>
		<div class=\"solofolio-cyclereact-nav-left prev\"></div>
	</div>";

$output .= "</div></div>";

$output .= "<div class='solofolio-cyclereact-sidebar " . get_theme_mod( 'solofolio_gallery_controls', 'buttons') . "'>";

if ($captions != "false"){
  $output .= '<p class="solofolio-cyclereact-caption"></p>';
}

if (get_theme_mod( 'solofolio_gallery_controls', 'buttons') == 'text') {
	$output .= '<ul class="solofolio-cyclereact-controls">
        <li><a class="thumbs" href="#" data-cycle-cmd="pause">thumbs</a></li>
        <li><a class="prev" href="#">prev</a></li>
        <li><a class="next" href="#">next</a></li>
        <li><span class="solofolio-cyclereact-count"></span></li>
      </ul>
    	</div>';
} else {
	$output .= '<div class="solofolio-cyclereact-controls">
        <a class="thumbs" href="#" data-cycle-cmd="pause"><i class="fa fa-th"></i></a>
        <span class="arrows">
          <a class="prev" href="#"><i class="fa fa-caret-left"></i></a>
          <a class="next" href="#"><i class="fa fa-caret-right"></i></a>
        </span>
      </div>
    	</div>';
}

if ($thumbs == "true"){
$output .= "
<style type=\"text/css\">
.solofolio-cyclereact-thumbs {
	display: block;
}
.solofolio-cyclereact-sidebar, .solofolio-cyclereact-stage {
	display: none;
}
</style>";
}

add_action('wp_footer', 'sl_cyclereact_js');

if (!function_exists('sl_cyclereact_js')) {
	function sl_cyclereact_js() {
		$output = "<script type=\"text/javascript\">window.matchMedia=window.matchMedia||(function(e,f){var c,a=e.documentElement,b=a.firstElementChild||a.firstChild,d=e.createElement(\"body\"),g=e.createElement(\"div\");g.id=\"mq-test-1\";g.style.cssText=\"position:absolute;top:-100em\";d.appendChild(g);return function(h){g.innerHTML='&shy;<style media=\"'+h+'\"> #mq-test-1 { width: 42px; }</style>';a.insertBefore(d,b);c=g.offsetWidth==42;a.removeChild(d);return{matches:c,media:h}}})(document);</script>";
		$output .= "
		<style type=\"text/css\">
		@media only screen and (min-width: 1025px) {
			.header .header-content .solofolio-cyclereact-sidebar {
				display: block;
			}
			body.page .wrapper {
				padding: 0;
				position: absolute;
				overflow: hidden;
				left: " . get_theme_mod( 'solofolio_layout_spacing', '20' ) ."px;
			}
		}
		@media only screen and (max-width: 1024px) {
			.content-page {
				max-width: inherit;
			}
		</style>
		";

		wp_enqueue_script('picturefill', get_template_directory_uri().'/includes/gallery/js/picturefill.js', array(), constant('SOLOFOLIO_VERSION'), true );
		wp_enqueue_script('jquery-cycle2', get_template_directory_uri().'/includes/gallery/js/jquery.cycle2.js', array(), null, true );
		wp_enqueue_script( 'lazysizes', get_template_directory_uri().'/js/lazysizes.js', array('jquery'), constant('SOLOFOLIO_VERSION'), true);
		wp_enqueue_script('solofolio-cyclereact', get_template_directory_uri().'/includes/gallery/js/cyclereact.js', array('jquery'), null, true);
		wp_localize_script( 'solofolio-cyclereact', 'solofolioGallery', array(
			'layoutSpacing' => get_theme_mod('solofolio_layout_spacing', '40')
			)
		);
	  echo $output;
	}
}
?>
