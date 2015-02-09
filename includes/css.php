<?php
function solofolio_css() {
  $mods = get_theme_mods();

  $layout_spacing                 = $mods['solofolio_layout_spacing'];
  $header_width                   = $mods['solofolio_header_width'];
  $logo_width                     = $mods['solofolio_logo_width'];
  $entry_width                    = $mods['solofolio_entry_width'];
  $entry_text_width               = $mods['solofolio_entry_text_width'];
  $button_size                    = $mods['solofolio_gallery_controls_size'];
  $is_horizon                     = ( $mods['solofolio_layout_mode'] == 'horizon');
  $font_logo                      = str_replace("+"," ", $mods['solofolio_font_logo']);
  $font_head                      = str_replace("+"," ", $mods['solofolio_font_head']);
  $font_body                      = str_replace("+"," ", $mods['solofolio_font_body']);
  $navigation_font_size           = $mods['solofolio_navigation_font_size'];
  $header_meta_font_size          = $mods['solofolio_header_meta_font_size'];
  $navigation_header_font_size    = $mods['solofolio_navigation_header_font_size'];
  $body_font_size                 = $mods['solofolio_body_font_size'];
  $blog_entry_title_size          = $mods['solofolio_blog_entry_title_size'];
  $logo_color                     = $mods['solofolio_logo_color'];
  $logo_color_hover               = $mods['solofolio_logo_color_hover'];
  $body_font_color                = $mods['solofolio_body_font_color'];
  $body_link_color                = $mods['solofolio_body_link_color'];
  $body_link_color_hover          = $mods['solofolio_body_link_color_hover'];
  $body_caption_color             = $mods['solofolio_body_caption_color'];
  $navigation_header_color        = $mods['solofolio_navigation_header_color'];
  $background_color               = $mods['solofolio_background_color'];
  $header_background_color        = $mods['solofolio_header_background_color'];
  $blog_entry_title_color         = $mods['solofolio_blog_entry_title_color'];
  $blog_entry_title_color_hover   = $mods['solofolio_blog_entry_title_color_hover'];
  $byline_color                   = $mods['solofolio_blog_entry_byline_color'];
  $navigation_link_color          = $mods['solofolio_navigation_link_color'];
  $navigation_link_color_hover    = $mods['solofolio_navigation_link_color_hover'];

  $styles = "/* v" . constant('SOLOFOLIO_VERSION') . " generated on: " . date(' Y-m-d \a\t H:i:s') . " */ ";

  $styles .= "
  html { font-size: " . $body_font_size . "px }
  body {
    background-color: ". $background_color . ";
    color: " . $body_font_color . ";
    font-family: '" . $font_body . "';
  }
  .header h3,
  .wrapper h1,
  .wrapper h2,
  .wrapper h3
  { font-family: '" . $font_head . "' }
  h1, h2, h3, h4, h5, h6 { color: " . $blog_entry_title_color . " }
  a:link,
  a:visited,
  .header-location,
  .woocommerce-page .woocommerce-breadcrumb a { color: " . $body_link_color . "}
  a:hover,
  a:active,
  .content-parent .children li:hover a h3,
  .woocommerce-page .woocommerce-breadcrumb a:hover { color: " . $body_link_color_hover . " }
  .site-title a {
    font-family: '" . $font_logo . "';
    color: " . $logo_color . ";
  }
  .site-title a:hover { color: " . $logo_color_hover . " }
  .logo-img a { width: " . $logo_width . "px }
  .solofolio-cyclereact-title,
  .footer { background-color: " . $background_color . " }
  .header { background-color: ". $header_background_color . " }
  .header-meta,
  .solofolio-cyclereact-controls { font-size: " . $header_meta_font_size . "px }
  .header-content li a {
    font-size: " . $navigation_font_size . "px;
    line-height: " . $navigation_font_size . "px;
  }
  .header-content h3 {
    color: " . $navigation_header_color . ";
    font-size: " . $navigation_header_font_size . "px;
  }
  .header-content ul a:link,
  .header-content ul a:visited,
  .menu-icon, .menu-btn { color: " . $navigation_link_color . " }
  .header-content ul a:hover,
  .header-content ul a:active,
  .header-content .solofolio-custom-menu h3:hover { color: " . $navigation_link_color_hover . " }
  h2.post-title { font-size: " . $blog_entry_title_size . "px }
  h2.post-title,
  h2.post-title a { color: " . $blog_entry_title_color . " }
  .post-title a:hover { color: " . $blog_entry_title_color_hover . " }
  .post-byline { color: " . $byline_color . " }
  .wp-caption-text,
  .solofolio-cyclereact-caption { color: " . $body_caption_color . " }
  .solofolio-cyclereact-controls a { color: " . $navigation_link_color . " }
  .solofolio-cyclereact-controls a:hover,
  button:hover,
  button:focus,
  .form-submit input:hover,
  .form-submit input:focus { color: " . $navigation_link_color_hover . "}
  .header .header-content .current-page-ancestor a,
  .header .header-content .current_page_item a,
  .header .header-content .current_page_parent a { color: " . $navigation_link_color_hover . "; }
  .solofolio-cyclereact-sidebar.buttons a:hover,
  input:focus,
  input:hover,
  textarea:focus,
  button:focus,
  button:hover { border-color: " . $navigation_link_color_hover . " }
  input,
  textarea,
  button,
  .woocommerce-page ul.products li.product a.button,
  .woocommerce #review_form #respond .form-submit input  {
    border: 1px solid " . $navigation_link_color . ";
    color: " . $body_font_color . ";
  }
  .blog .fluid-width-video-wrapper,
  .comments small { color: " . $byline_color . " }
  .solofolio-cyclereact-sidebar { max-width: " . $header_width . "px }
  .solofolio-cyclereact-sidebar.buttons a {
    height: " . $button_size . "px;
    font-size: " . ($button_size * .55) . "px;
    line-height: " . $button_size . "px;
    width: " . $button_size . "px;
  }
  .solofolio-cyclereact-sidebar.buttons .fa { line-height: " . $button_size . "px }
  .entry .post-meta,
  .entry p,
  .entry .tag-links,
  .pagination-nav,
  .centered-content .more-link,
  .centered-content .wrapper pre,
  .centered-content .wrapper dl,
  .centered-content .wrapper ol,
  .centered-content .wrapper ul,
  .centered-content .wrapper address,
  .centered-content .wrapper table,
  .centered-content .wrapper h1,
  .centered-content .wrapper h2,
  .centered-content .wrapper h3,
  .centered-content .wrapper h4,
  .centered-content .wrapper h5,
  .centered-content .wrapper h6 { max-width: " . $entry_text_width . "px }

  @media (min-width: 1025px) {
    .horizon .header-content h3 { line-height: " . $navigation_header_font_size . "px }
    .horizon .solofolio-cyclereact-sidebar.buttons a { border: 1px solid " . $navigation_link_color . " }
    .horizon .wrapper {
      bottom: " . $layout_spacing . "px;
      top: " . ($layout_spacing + 40) . "px;
      right: " . $layout_spacing . "px;
      left: " . $layout_spacing . "px;
    }
    .horizon .logo { width: " . $logo_width . "px }
    .horizon.admin-bar.page .wrapper { top: " . ($layout_spacing + 77) . "px }
    .horizon .logo { padding-left: " . $layout_spacing . "px }
    .horizon .header-content { padding-right: " . $layout_spacing . "px }
    .horizon .solofolio-cyclereact-title {
      padding-top: " . ($layout_spacing + 45) . "px;
      padding-right: " . ($layout_spacing - 20) . "px;
      padding-bottom: " . $layout_spacing . "px;
    }
    .horizon .solofolio-cyclereact-sidebar {
      top: " . ($layout_spacing + 40) . "px;
      right: " . $layout_spacing . "px;
    }
    .horizon .solofolio-cyclereact-stage,
    .horizon .solofolio-cyclereact-title { right: " . ($header_width + 20) . "px }
    .horizon .solofolio-cyclereact-thumbs {
      top: 35px;
      padding: " . $layout_spacing . "px;
    }
    .horizon.page-template-story-php .wrapper { margin-top: -" . $layout_spacing . "px }
    .horizon.page-template-story-php .vert-scroll-full {
      margin-left: -" . $layout_spacing . "px;
      margin-right: -" . $layout_spacing . "px;
    }
  }
  .solofolio-cyclereact-sidebar.buttons a { border: 1px solid " . $navigation_link_color . " }
  @media (min-width: 1025px) {
    .heights .wrapper {
      bottom: " . $layout_spacing . "px;
      left: " . $layout_spacing . "px;
      right: " . $layout_spacing . "px;
      top: " . $layout_spacing . "px;
    }
    .heights .header { width: " . ($header_width + ($layout_spacing * 2)) . "px }
    .heights .header-inner { width: " . $header_width . "px }
    .heights .admin-bar.page .wrapper { top: " . ($layout_spacing + 32) . "px}
    .heights .admin-bar.page .solofolio-cyclereact-thumbs { padding-top: " . ($layout_spacing + 22) . "px }
    .heights .solofolio-cyclereact-stage,
    .heights .solofolio-cyclereact-thumbs,
    .heights .solofolio-cyclereact-title { left: " . ($header_width + ($layout_spacing * 2)) . "px !important }
    .heights .solofolio-cyclereact-sidebar {
      bottom: " . $layout_spacing . "px;
      left: " . $layout_spacing . "px;
    }
    .heights .solofolio-cyclereact-thumbs,
    .heights .solofolio-cyclereact-title { padding: " . $layout_spacing . "px }
    .heights .solofolio-cyclereact-thumbs { padding-top: " . ($layout_spacing - 10) . "px }
    .heights .header-inner {
      left: " . $layout_spacing . "px;
      top: " . $layout_spacing . "px;
      bottom: " . $layout_spacing . "px;
    }
    .heights.page-template-story-php .pushy .header-inner { width: " . $header_width . "px }
    .heights.page-template-story-php .pushy-left {
      -webkit-transform: translate3d(-" . ($header_width + ($layout_spacing * 2)) . "px,0,0);
      -moz-transform: translate3d(-" . ($header_width + ($layout_spacing * 2)) . "px,0,0);
      -ms-transform: translate3d(-" . ($header_width + ($layout_spacing * 2)) . "px,0,0);
      -o-transform: translate3d(-" . ($header_width + ($layout_spacing * 2)) . "px,0,0);
      transform: translate3d(-" . ($header_width + ($layout_spacing * 2)) . "px,0,0);
    }
    .heights.page-template-story-php .vert-scroll {
      padding-left: " . $layout_spacing . "px;
      padding-right: " . $layout_spacing . "px;
    }
    .heights .wrapper {
      left: " . ($header_width + ($layout_spacing * 2)) . "px;
    }
    @media only screen and (min-width: 2000px) {
      .centered-content.blog.heights .wrapper,
      .centered-content.page-template-about-php.heights .wrapper,
      .centered-content.page-template-parent-php.heights .wrapper {
        left: " . $layout_spacing . "px;
      }
    }
  }";
  if ($header_background_color == $background_color) {
    $styles .= "
    .heights .wrapper { left: " . ($header_width + ($layout_spacing * 2)) . "px }
    .heights .solofolio-cyclereact-stage,
    .heights .solofolio-cyclereact-thumbs,
    .heights .solofolio-cyclereact-title { left: " . ($header_width + $layout_spacing) . "px !important }";
  }

  $styles = str_replace(': ', ':', $styles);
  $styles = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $styles);

  return $styles;
}

?>
