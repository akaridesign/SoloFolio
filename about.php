<?php
/* Template Name: About Page */
get_header();
?>

<div class="content-about">
	<?php if (have_posts()) { ?>
    <?php if ( has_post_thumbnail()) : ?>
      <?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); ?>
      <div class="content-about-image" style="max-width: <?php echo $thumb[1];?>px">
        <?php the_post_thumbnail('large'); ?>
        <p class="wp-caption-text"><?php echo get_post(get_post_thumbnail_id())->post_excerpt ?></p>
      </div>
    <?php endif; ?>
  	<?php while (have_posts()) : the_post(); ?>
  		<div class="content-about-content"><?php the_content(); ?></div>
  	<?php endwhile; ?>
	<?php } ?>
  <?php if (null !== get_post_meta($post->ID, 'blink_username', true)) { ?>
    <div class="blink-map">
      <iframe src="//blink.la/widgets/map/u/<?php echo get_post_meta($post->ID, 'blink_username', true); ?>?theme=google_maps" scrolling="no" frameborder="0" allowtransparency="true" style="border:none; overflow:hidden; width:600px; height:400px;"></iframe>
    </div>
  <?php } ?>
</div>

<?php get_footer(); ?>
