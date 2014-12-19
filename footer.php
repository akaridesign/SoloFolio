</div>

<div class="footer">
  <span class="copyright-label"><?php _e( 'copyright', 'solofolio' ); ?></span>
  <div class="copyright-hidden">
    <?php $text = get_theme_mod( 'solofolio_copyright_text' ); if (!empty($text)) { ?>
      &copy; <?php echo date("Y"); ?> <?php echo get_theme_mod( 'solofolio_copyright_text' ); ?>
    <?php } if (get_theme_mod('solofolio_show_attribution', true)) { ?>
      / <?php _e( 'Powered by', 'solofolio' ); ?> <a title="<?php _e( 'Powered by SoloFolio, a WordPress Photography Portfolio Theme', 'solofolio' ); ?>" href="http://solofol.io" target="_blank"> <?php _e( 'SoloFolio', 'solofolio' ); ?></a>
    <?php } ?>
  </div>
</div>

<?php
global $current_user;
if ($current_user->user_level != 10 ) { echo get_theme_mod( 'solofolio_tracking' ); }

wp_footer();
?>

</body>
</html>
