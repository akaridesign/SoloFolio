/*global jQuery */
/*!
* SoloFolio base JS
*
* By Joel Hawksley, included with SoloFolio Theme
*/
jQuery(window).load(function(){
  jQuery(".wrapper").fitVids();

  jQuery("img.lazy").unveil(1200, function() {
    jQuery(this).load(function() {
      this.style.opacity = 1;
    });
  });
});

jQuery(document).ready(function() {
  jQuery('.solofolio-custom-menu h3').click(function(e){
    var $target = jQuery(e.target).closest('.solofolio-custom-menu');

    if ($target.hasClass('visible')) {
      $target.removeClass('visible').find('ul').hide();
    } else {
      jQuery('.solofolio-custom-menu').removeClass('visible').find('ul').hide();
      $target.addClass('visible').find('ul').toggle();
    }
  });

  jQuery('.menu-icon').click(function(){
    jQuery(".header-content").toggle();
    jQuery(this).toggleClass("active");
  });

  /* Open menu containing sub-page */
  if (solofolioBase.layoutMode == "heights") {
    jQuery('.solofolio-custom-menu .menu').has('.current_page_item').show().addClass('visible');
  }
});

