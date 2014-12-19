<?php get_header(); ?>

<div class="content-page">
	<?php if (have_posts()) : ?>
  	<?php while (have_posts()) : the_post(); ?>
  		<?php the_content(); ?>
  	<?php endwhile; ?>
	<?php endif; ?>
</div>

<?php get_footer(); ?>
