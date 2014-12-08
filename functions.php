<?php

define("SOLOFOLIO_VERSION",     "7.0.61");

include_once("includes/helpers.php");             // Helper functions
include_once("includes/gallery.php");             // Gallery shortcode replacement
include_once("includes/social-widget.php");       // Social media widget
include_once("includes/menu-widget.php");         // Custom menu widget
include_once("includes/lazy-load.php");           // Lazy loader
include_once("includes/customize.php");           // Customizer configuration
include_once("includes/css.php");                 // CSS constructor

add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );
update_option('image_default_link_type','none');

# Adapted from http://codex.wordpress.org/Plugin_API/Filter_Reference/wp_title
function solofolio_wp_title( $title, $sep ) {
  global $paged, $page;

  if ( is_feed() )
    return $title;

  // Add the site name.
  $title .= get_bloginfo( 'name' );

  // Add the site description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
    $title = "$title $sep $site_description";

  // Add a page number if necessary.
  if ( $paged >= 2 || $page >= 2 )
    $title = "$title $sep " . sprintf( __( 'Page %s', 'solofolio' ), max( $paged, $page ) );

  return $title;
}
add_filter( 'wp_title', 'solofolio_wp_title', 10, 2 );

function solofolio_body_classes() {
  $classes = array(get_theme_mod('solofolio_layout_mode', 'heights'));

  if (get_theme_mod('solofolio_center_content', true) || (get_theme_mod('solofolio_layout_mode') == 'horizon')) {
    array_push($classes, "centered-content");
  }

  return $classes;
}

function solofolio_css_cache() {
  if (is_customize_preview()) {
    $data = solofolio_css();
  } else {
    $version = get_theme_mod( 'solofolio_version', false );
    $data = get_theme_mod( 'solofolio_customizer_styles', false );
    if ( ($data == false) || ($version != constant('SOLOFOLIO_VERSION') ) ) {
      $data = solofolio_css();
      set_theme_mod( 'solofolio_customizer_styles', $data );
      set_theme_mod( 'solofolio_version', constant('SOLOFOLIO_VERSION') );
    }
  }

  wp_add_inline_style( 'solofolio-styles-base', $data );
}
add_action( 'wp_enqueue_scripts', 'solofolio_css_cache', 130 );

function solofolio_css_cache_reset() {
  set_theme_mod( 'solofolio_customizer_styles', false );
  solofolio_css_cache();
}
add_action( 'customize_preview_init', 'solofolio_css_cache_reset' );
add_action( 'customize_save_after', 'solofolio_css_cache_reset' );
add_action( 'after_switch_theme', 'solofolio_css_cache_reset' );

if ( !isset( $content_width ) ) $content_width = 900;

function filter_ptags_on_images($content) {
  $content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
  return preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

function solofolio_load_fonts() {
  $fonts = array(get_theme_mod('solofolio_font_body', 'Roboto'),
                 get_theme_mod('solofolio_font_logo', 'Roboto'),
                 get_theme_mod('solofolio_font_head', 'Roboto'));

  function add_weights($f) {
    return($f . ":400,700");
  }

  $families = implode( '|', array_map("add_weights", array_unique($fonts)) );
  $fonts_url = '//fonts.googleapis.com/css?family=' . $families;

  wp_enqueue_style('solofolio-fonts', $fonts_url);
  wp_enqueue_style( 'font-awesome',  get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.2.0' );
}
add_action('wp_enqueue_scripts', 'solofolio_load_fonts');

function solofolio_scripts() {
  wp_enqueue_style( 'solofolio-styles-base', get_stylesheet_uri(), null, constant('SOLOFOLIO_VERSION') );
  wp_enqueue_script( 'matchmedia', get_template_directory_uri().'/js/matchmedia.js', array('jquery'), constant('SOLOFOLIO_VERSION'), true);
  wp_enqueue_script( 'lazy-load', get_template_directory_uri().'/js/lazy-load.js', array('jquery'), constant('SOLOFOLIO_VERSION'), true);
  wp_enqueue_script('jquery-retina', get_template_directory_uri().'/js/jquery.retina.js', array('jquery'), constant('SOLOFOLIO_VERSION'), true);
  wp_enqueue_script('jquery-fitvids', get_template_directory_uri().'/js/jquery.fitvids.js', array('jquery'), constant('SOLOFOLIO_VERSION'), true);
  wp_enqueue_script('pushy', get_template_directory_uri().'/js/pushy.js', array('jquery'), constant('SOLOFOLIO_VERSION'), true);
  wp_enqueue_script('blink', get_template_directory_uri().'/js/blink_sdk.js', array('jquery'), constant('SOLOFOLIO_VERSION'), true);
  wp_enqueue_script('solofolio-base', get_template_directory_uri().'/js/solofolio-base.js', array('jquery'), constant('SOLOFOLIO_VERSION'), true);
  wp_localize_script( 'solofolio-base', 'solofolioBase', array(
  'layoutMode' => get_theme_mod('solofolio_layout_mode', 'heights')
  )
);
}
add_action('wp_enqueue_scripts', 'solofolio_scripts');

// Add additional image size for large displays, change defaults for others.
function solofolio_set_image_sizes() {
	add_image_size('xlarge',1800,1200, false);
	update_option('thumbnail_size_w', 300);
	update_option('thumbnail_size_h', 200);
	update_option('medium_size_w', 600);
	update_option('medium_size_h', 400);
	update_option('large_size_w', 900);
	update_option('large_size_h', 600);

  # Disable thumbnail cropping
  if(false === get_option("thumbnail_crop")) {
    add_option("thumbnail_crop", "0"); }
  else {
    update_option("thumbnail_crop", "0");
  }
}
add_action( 'after_setup_theme', 'solofolio_set_image_sizes' );

function solofolio_comments($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment; ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
   <div id="comment-<?php comment_ID(); ?>" class="grid">
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.', 'solofolio') ?></em>
         <br />
      <?php endif; ?>

      <div class="comment-meta commentmetadata">
        <h4 class="comment-author vcard"><?php printf(__('%s'), get_comment_author_link()) ?></h4>
        <small><?php printf(__('%1$s', 'solofolio'), get_comment_date('M. j, Y')) ?></small>
        <?php edit_comment_link(__('(Edit)', 'solofolio'),'  ','') ?>
      </div>

      <div class="comment-text"><?php comment_text() ?></div>
   </div>
  <?php
}

// Group comment form inputs into two columns
function solofolio_comment_form_top_action() {
  if (!is_user_logged_in()) {
    echo '<div class="grid"><div class="col-1-3">';
  }
}
add_action('comment_form_top', 'solofolio_comment_form_top_action');

function solofolio_comment_form_after_fields_action() {
  if (!is_user_logged_in()) {
    echo '</div><div class="col-2-3">';
  }
}
add_action('comment_form_after_fields', 'solofolio_comment_form_after_fields_action');

function solofolio_comment_form_field_comment_filter($comment_field = '') {
  if (!is_user_logged_in()) {
    $comment_field .= '</div></div>';
  }
  return $comment_field;
}
add_filter('comment_form_field_comment', 'solofolio_comment_form_field_comment_filter');

// Remove image margins automatically added by WordPress.
// From: http://wordpress.org/support/topic/10px-added-to-width-in-image-captions
class fixImageMargins{
  public function __construct(){
    add_filter('img_caption_shortcode', array(&$this, 'fixme'), 10, 3);
  }
  public function fixme($x=null, $attr, $content){
    extract(shortcode_atts(array(
            'id'    => '',
            'align'    => 'alignnone',
            'width'    => '',
            'caption' => ''
        ), $attr));
    if ( 1 > (int) $width || empty($caption) ) {return $content;}
    if ( $id ) $id = 'id="' . $id . '" ';
    $output = '<div ' . $id . 'class="wp-caption ' . $align . '" style="max-width: ' . $width . 'px">' . $content;
    if (!empty($caption)) {
      $output .= '<p class="wp-caption-text">' . $caption . '</p>';
    }
    $output .= '</div>';
  return $output;
  }
}
$fixImageMargins = new fixImageMargins();

// Register theme widget areas
if(function_exists('register_sidebar')){

  register_sidebar(array('name' => 'Main Navigation',
    'before_widget' => '<div class="sidebar-widget">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ));
  register_sidebar(array('name' => 'Under Main Navigation on Blog',
    'before_widget' => '<div class="sidebar-widget blog-sidebar">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ));
}

if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
  wp_enqueue_script( 'comment-reply' );
}
?>
