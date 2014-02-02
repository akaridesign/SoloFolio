<?php get_header(); ?>
<div id="content-single">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<div class="entry">
				<div class="post-meta">
				<?php if (get_theme_mod('solofolio_blog_showcat')) {?><span class="post-cat"><?php the_category(', ') ?></span><?php } ?>
				<h2 class="post-title">
					<?php the_title(); ?>
				</h2>
				<span class="date"><?php the_time('M j Y') ?>
				<?php if (get_theme_mod('solofolio_blog_showauthor')) {?>by <?php the_author() ?><?php } ?>
				</span>
			</div>
				<?php the_content('Read the rest of this entry &raquo;'); ?>
				<div class="clear"></div>
			</div>
		<?php endwhile; ?>
		<div class="pagination-nav">
			<div class="left"><?php previous_post_link('%link', '<i class="icon-angle-left"></i> %title'); ?></div>
			<div class="right"><?php next_post_link('%link', '%title <i class="icon-angle-right"></i>'); ?></p></div>
			<div class="clear"></div>
		</div>
		<div id="comments">
			<?php comments_template(); ?>
		</div>
	<?php else : ?>
		<h2>Not Found</h2>
		<p>Sorry, but you are looking for something that isn't here.</p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>
	<?php endif; ?>
</div>

<?php get_footer(); ?>
