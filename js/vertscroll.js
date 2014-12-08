var setResponsive = function () {
  var pageHeight = jQuery(window).height();
  var headerHeight = jQuery(".header").outerHeight();
  var wrapperWidth = jQuery(".wrapper").innerWidth();
  var wrapperHeight = jQuery(".wrapper").outerHeight();
  var layoutSpacing = solofolioVertScroll.layoutSpacing;

  var n = jQuery(".header").css('right');

  if (wrapperWidth > 600) {
    if (n == '0px') {
      jQuery('.vert-scroll-window img').css('max-height', pageHeight - headerHeight - layoutSpacing - layoutSpacing);
    }
    else {
      jQuery('.vert-scroll-window img').css('max-height', pageHeight - layoutSpacing - layoutSpacing);
    }
  } else {
    jQuery('.vert-scroll-window img').css('max-height', pageHeight);
  }

  jQuery('.vert-scroll img').each(function( i ) {
    var width = jQuery(this).outerWidth();
    jQuery(this).parent().find('.wp-caption-text').css('max-width', width)
  });
}

jQuery(window).resize(setResponsive);

jQuery(document).on('lazybeforeunveil', (function(){
  var onLoad = function(e){
    setResponsive();
    jQuery(e.target)
      .fadeTo(800, 1)
      .off('load error', onLoad)
    ;
  };
  return function(e){
    if(!e.isDefaultPrevented()){
      jQuery(e.target)
        .filter('img')
        .css({opacity: 0})
        .on('load error', onLoad)
      ;
    }
  };
})());
