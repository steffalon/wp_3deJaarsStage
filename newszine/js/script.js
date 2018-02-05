// Contact Form
jQuery('.wpcf7-file').after('<label class="file-label">Upload File</label>');


// Default home icon

jQuery('.main-menu .navbar-nav').prepend('<li><a href="'+newszine_options.home_url+'"><i class="fa fa-home"></i></a></li>');

// Breaking News

jQuery(document).ready(function($) {
 
  jQuery("#breaking-news").owlCarousel({
 
      navigation : false, // Show next and prev buttons
      slideSpeed : 0,
      pagination:false,
      autoPlay:true,
      paginationSpeed : 2000,
      singleItem:true,
      rewindSpeed: 0,
      loop:true
 
      // "singleItem:true" is a shortcut for:
      // items : 1, 
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false
 
  });
 
});

// Search toggle
jQuery(document).ready(function($){
  jQuery('#search-toggle').click(function(){
    jQuery(this).parent('.search').toggleClass('show');
    jQuery(this).children('i').toggleClass('fa-search');
    jQuery(this).children('i').toggleClass('fa-close');
  });

});

// Slider
var $sliderHeight = jQuery('.main-slider .item').innerHeight();
jQuery('.main-slider .col .latest').each(function(){
  jQuery(this).css({"max-height":$sliderHeight/2});
});
jQuery('.main-slider .col .carousel-inner .img-responsive').each(function(){
  jQuery(this).css({"max-height":$sliderHeight});
});

// Remove Placeholder
jQuery('input,textarea').focus(function($){
   jQuery(this).data('placeholder',$(this).attr('placeholder'))
   jQuery(this).attr('placeholder','');
});
jQuery('input,textarea').blur(function($){
   jQuery(this).attr('placeholder',$(this).data('placeholder'));
});


    //Tab to top
    jQuery(window).scroll(function($) {
    if (jQuery(this).scrollTop() > 1){  
        jQuery('.scroll-top-wrapper').addClass("show");
    }
    else{
        jQuery('.scroll-top-wrapper').removeClass("show");
    }
});
    jQuery(".scroll-top-wrapper").on("click", function($) {
     jQuery("html, body").animate({ scrollTop: 0 }, 600);
    return false;
});


//Sticky Header
var $topinfoHeight = jQuery('.top-info').innerHeight();
var $logoadHeight = jQuery('.logo-ad').innerHeight();
var $topinfoLogoad = $topinfoHeight+$logoadHeight;

jQuery(window).scroll(function($) {
    if (jQuery(this).scrollTop() > $topinfoLogoad){  
        jQuery('.main-menu').addClass("sticky-menu");
    }
    else{
        jQuery('.main-menu').removeClass("sticky-menu");
    }
});


// Smart Menu
(function($) {

  // init ondomready
  jQuery(function($) {

    // init all navbars that don't have the "data-sm-skip" attribute set
    var $navbars = jQuery('ul.navbar-nav:not([data-sm-skip])');
    $navbars.each(function() {
      var $this = $(this);
      $this.addClass('sm').smartmenus({

          // these are some good default options that should work for all
          // you can, of course, tweak these as you like
          subMenusSubOffsetX: 2,
          subMenusSubOffsetY: -6,
          subIndicators: false,
          collapsibleShowFunction: null,
          collapsibleHideFunction: null,
          rightToLeftSubMenus: $this.hasClass('navbar-right'),
          bottomToTopSubMenus: $this.closest('.navbar').hasClass('navbar-fixed-bottom')
        })
        .bind({
          // set/unset proper Bootstrap classes for some menu elements
          'show.smapi': function(e, menu) {
            var $menu = $(menu),
              $scrollArrows = $menu.dataSM('scroll-arrows');
            if ($scrollArrows) {
              // they inherit border-color from body, so we can use its background-color too
              $scrollArrows.css('background-color', $(document.body).css('background-color'));
            }
            $menu.parent().addClass('open');
          },
          'hide.smapi': function(e, menu) {
            $(menu).parent().removeClass('open');
          }
        })
        // set Bootstrap's "active" class to SmartMenus "current" items (should someone decide to enable markCurrentItem: true)
        .find('a.current').parent().addClass('active');

      // keep Bootstrap's default behavior for parent items when the "data-sm-skip-collapsible-behavior" attribute is set to the ul.navbar-nav
      // i.e. use the whole item area just as a sub menu toggle and don't customize the carets
      var obj = $this.data('smartmenus');
      if ($this.is('[data-sm-skip-collapsible-behavior]')) {
        $this.bind({
          // click the parent item to toggle the sub menus (and reset deeper levels and other branches on click)
          'click.smapi': function(e, item) {
            if (obj.isCollapsible()) {
              var $item = $(item),
                $sub = $item.parent().dataSM('sub');
              if ($sub && $sub.dataSM('shown-before') && $sub.is(':visible')) {
                obj.itemActivate($item);
                obj.menuHide($sub);
                return false;
              }
            }
          }
        });
      }

      var $carets = $this.find('.caret');

      // onresize detect when the navbar becomes collapsible and add it the "sm-collapsible" class
      var winW;
      function winResize() {
        var newW = obj.getViewportWidth();
        if (newW != winW) {
          if (obj.isCollapsible()) {
            $this.addClass('sm-collapsible');
            // set "navbar-toggle" class to carets (so they look like a button) if the "data-sm-skip-collapsible-behavior" attribute is not set to the ul.navbar-nav
            if (!$this.is('[data-sm-skip-collapsible-behavior]')) {
              $carets.addClass('navbar-toggle sub-arrow');
            }
          } else {
            $this.removeClass('sm-collapsible');
            if (!$this.is('[data-sm-skip-collapsible-behavior]')) {
              $carets.removeClass('navbar-toggle sub-arrow');
            }
          }
          winW = newW;
        }
      };
      winResize();
      $(window).bind('resize.smartmenus' + obj.rootId, winResize);
    });

  });

  // fix collapsible menu detection for Bootstrap 3
  $.SmartMenus.prototype.isCollapsible = function() {
    return this.$firstLink.parent().css('float') != 'left';
  };

  jQuery(document).ready(function() {
    $('.main-slider .col-left .carousel-inner img').css('height', $('.main-slider .col-right').height());
  });
  jQuery(window).resize(function() {
        $('.main-slider .col-left .carousel-inner img').css('height', $('.main-slider .col-right').height());
    });

})(jQuery);