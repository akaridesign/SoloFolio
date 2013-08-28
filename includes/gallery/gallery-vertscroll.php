<?php
/* 
SoloFolio
Gallery Template: vert-scroll

Let's just say that most browsers don't take too kindly to display more than one Galleria slideshow on a single page. In addition to mobile usage, this theme is used as a safety-override on all blog posts to prevent otherwise disastrous results.

We'll use this template for blog posts and 
*/
?>


<?php	
	
	$i = 0;
		
	foreach ($attachment_ids as $id) {

		$attachment = get_post($id);
		
		$link2 = wp_get_attachment_url($id);
		$link3 = wp_get_attachment_image_src($id, 'thumbnail');
		$link4 = wp_get_attachment_image_src($id, 'large');

		$output .= "\n\n<div style=\"max-width:" . $link4[1] . "px; \">";
		
		$output .= "
			
			<img src=\"" . $link4[0] . "\" data-retina=\"" . $link2 . "\" alt=\"open image\" class=\"full\" id=\"" . $i . "\"/>";
		
		$output .= "</div>";
		
		if ($captions != "false"){		
			$output .="<p class=\"wp-caption-text\">" .  wptexturize($attachment->post_excerpt) . "</p> ";
		}
		
		$i += 1;
		
	} // end foreach
		
?>
