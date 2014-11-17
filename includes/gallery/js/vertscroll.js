var setResponsive = function () {
  var pageHeight = jQuery(window).height();
  var headerHeight = jQuery(".header").outerHeight();
  var wrapperWidth = jQuery(".wrapper").innerWidth();
  var wrapperHeight = jQuery(".wrapper").outerHeight();
  var layoutSpacing = solofolioVertScroll.layoutSpacing;

  var n = jQuery(".header").css('right');

  if (wrapperWidth > 600) {
    if (n == '0px') {
      jQuery('.vert-scroll img').css('max-height', pageHeight - headerHeight - layoutSpacing - layoutSpacing);
    }
    else {
      jQuery('.vert-scroll img').css('max-height', pageHeight - layoutSpacing - layoutSpacing);
    }
  } else {
    jQuery('.vert-scroll img').css('max-height', pageHeight);
  }
}

jQuery(window).load(function(){
  setResponsive();
});

jQuery(window).resize(setResponsive);

jQuery(document).on('lazybeforeunveil', (function(){
  var onLoad = function(e){
    var width = jQuery(e.target).outerWidth();
    jQuery(e.target).parent().find('.wp-caption-text').css('max-width', width)
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
