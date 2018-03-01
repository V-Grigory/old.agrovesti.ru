/*
  * Copyright 2015 Kopasoft http://kopatheme.com/.
  * MIT License.
*/

"use strict";
jQuery(document).ready(function(jQuery) {

 //--------------------------------------------------------------------------------------
      //placehoder ie9 input
 //--------------------------------------------------------------------------------------
      jQuery('input, textarea').placeholder();
 //--------------------------------------------------------------------------------------
      //scroll menu
 //--------------------------------------------------------------------------------------
 var nav = jQuery('.luxento-header-bottom');

  jQuery(window).scroll(function () {
    if (jQuery(this).scrollTop() > 110) {
      nav.addClass("luxento-menu-scroll");
    } else {
      nav.removeClass("luxento-menu-scroll");
    }
  });
 //--------------------------------------------------------------------------------------
      //video backdround
 //--------------------------------------------------------------------------------------
 jQuery(".entry-thumb").fitVids();
 //--------------------------------------------------------------------------------------
      //light popup video 
 //--------------------------------------------------------------------------------------
 jQuery("a[data-gal ^='prettyPhoto']").prettyPhoto({hook: 'data-gal'});
 
 //--------------------------------------------------------------------------------------
      //api flick img for widget-flick
 //--------------------------------------------------------------------------------------
 
 jQuery('.luxento-widget-flickr .widget-content .luxento-flickr-content').jflickrfeed({
      limit: 6,
      qstrings: {
        id: '71865026@N00'
      },
      itemTemplate: 
      '<li>' +
        '<a href="{{image_b}}"><img src="{{image_s}}" alt="{{title}}" /></a>' +
      '</li>'
 });
 //--------------------------------------------------------------------------------------
      //accordion element
 //--------------------------------------------------------------------------------------
 jQuery('.luxento-accordion').collapse({
       open: function() {
            this.slideDown(300);
        },
 });
 //--------------------------------------------------------------------------------------
      //toggle element
 //--------------------------------------------------------------------------------------
 jQuery('.luxento-toggle').collapse({
       open: function() {
            this.slideDown(150);
        },
       close: function() {
            this.slideUp(150);
       }
 });
 //--------------------------------------------------------------------------------------
      //image loaded and masonry 
 //--------------------------------------------------------------------------------------
 jQuery('#luxento-main-content').imagesLoaded( function() {
      jQuery('.luxento-widget-has-many-post .widget-content >.row').masonry({        
          itemSelector: '.ms-1',
          columnWidth: '.ms-1',          
      });
      
      jQuery('.luxento-widget-1-tall-4-short .widget-content >.row').masonry({
          itemSelector: '.ms-1',
          columnWidth: '.ms-1'
      });
 });
//--------------------------------------------------------------------------------------
      //load more data from github
 //--------------------------------------------------------------------------------------

jQuery('.luxento_data_github_01').on('click',function(){
    var button = jQuery(this);
    var link_to_github= "https://gist.githubusercontent.com/minhki/553b0a25597d7b9b979e/raw/0198e8001ab78482ab9fbf7475a24ba0f9bf0c99/kivv"
    jQuery.ajax({
        url:link_to_github,
        beforeSend: function( xhr ) {
        },

    })
    .done(function( data ) {
            
        imagesLoaded( jQuery(data),function() {
            var position_insret_data=  jQuery(button).prev();

            var a= jQuery(data).children();
            var data_lenght=jQuery(a).size();            
             for(var i=0;i<data_lenght;i++){
                  var b = jQuery(a).eq(i);
                  var jQueryboxes = jQuery('<div class="col-md-3 col-sm-3 col-xs-6 ms-1">'+b.html()+'</div>');
                  jQuery(position_insret_data).append(jQueryboxes).masonry( 'appended',jQueryboxes);
            }
        });
    });
});

jQuery('.luxento_data_github_02').on('click',function(){
    var button = jQuery(this);
    var link_to_github= "https://gist.githubusercontent.com/minhki/553b0a25597d7b9b979e/raw/0198e8001ab78482ab9fbf7475a24ba0f9bf0c99/kivv"
    jQuery.ajax({
        url:link_to_github,
        beforeSend: function( xhr ) {
        },

    })
    .done(function( data ) {
            
        imagesLoaded( jQuery(data),function() {
            var position_insret_data=  jQuery(button).prev();

            var a= jQuery(data).children();
            var data_lenght=jQuery(a).size();            
             for(var i=0;i<data_lenght;i++){
                  var b = jQuery(a).eq(i);
                  var jQueryboxes = jQuery('<div class="col-md-4 col-sm-4 col-xs-6 ms-1">'+b.html()+'</div>');
                  jQuery(position_insret_data).append(jQueryboxes).masonry( 'appended',jQueryboxes);
            }
        });
    });
});
//--------------------------------------------------------------------------------------
      // menu responsive click 
//--------------------------------------------------------------------------------------
jQuery('#luxento-menu-res').superclick({
      speed: 'normal',
      delay: 300,
      cssArrows: false,
      popUpSelector: 'ul,.luxento-content-respon-lv1',
      animation:{opacity:'show',height:'show'},
      animationOut:  {opacity:'hide',height:'hide'},
 }); 
//--------------------------------------------------------------------------------------
      //api instagram image show
//--------------------------------------------------------------------------------------
jQuery('.luxento-widget-6-img .widget-content').pongstgrm({
      accessId:     '2274439537',
      accessToken:  '2274439537.5b9e1e6.1d846b0846a24af9a514823ff374b5b6',
      count:6,
      show: 'recent',
      button: false,
      column: "luxento-img-instagram"

}); 
//--------------------------------------------------------------------------------------
      //supper fish menu destop
 //--------------------------------------------------------------------------------------
var sundayicon = jQuery('.luxento-primary-menu').superfish({
      speed: 'normal',
      delay: 300,
      cssArrows: false,
      popUpSelector: 'ul,.luxento-content-lv1',
      animation:{height:'show'},
      animationOut:{height:'hide'},
});
// jQuery('.luxento-primary-menu').hoverIntent(makeTall, makeShort, 'li');
//--------------------------------------------------------------------------------------
      //slider show carousel
//--------------------------------------------------------------------------------------
var owl = jQuery(".luxento-owl-content");
      owl.owlCarousel({
          items : 1,
          itemsDesktop : [1000,1],
          itemsDesktopSmall : [900,1],
          itemsTablet: [600,1],
          itemsMobile : false,
          autoPlay : false,
          navigation : true,
          pagination: false,
          stopOnHover : true,
          lazyLoad : true,
          lazyFollow : false,
          navigationText : ['<i class="fa fa-angle-double-left"></i>','<i class="fa fa-angle-double-right"></i>'],
});
var owl1 = jQuery(".luxento-owl-img");
      owl1.owlCarousel({
          items : 1,
          itemsDesktop : [1000,1],
          itemsDesktopSmall : [900,1],
          itemsTablet: [600,1],
          itemsMobile : false,
          autoPlay : false,
          navigation : true,
          pagination: false,
          stopOnHover : true,
          lazyLoad : true,
          lazyFollow : false,
          navigationText : ['<span class="fa fa-caret-left"></span>','<span class="fa fa-caret-right"></span>'],
 });

 var owl12 = jQuery(".luxento-owl-content2");
      owl12.owlCarousel({
          items : 4,
          itemsDesktop : [1000,4],
          itemsDesktopSmall : [900,3],
          itemsTablet: [600,2],
          itemsMobile : [400,1],
          autoPlay : false,
          navigation : true,
          pagination: false,
          stopOnHover : true,
          lazyLoad : true,
          lazyFollow : false,
          navigationText : ['<span class="fa fa-caret-left"></span>','<span class="fa fa-caret-right"></span>'],
 });     

//--------------------------------------------------------------------------------------
      //slider pro
 //--------------------------------------------------------------------------------------
 jQuery( '.luxento-widget-has-slider-pro .widget-content' ).sliderPro({
      width: 970,
      height: 750,
      orientation: 'vertical',
      loop: false,
      arrows: false,
      autoplay:false,
      buttons: false,
      startSlide:1,
      thumbnailArrows:true,
      forceSize: 'fullwidth',
      thumbnailsPosition: 'right',
      smallSize:300,
      thumbnailPointer: false,
      thumbnailWidth: 300,
      thumbnailHeight: 250,
      breakpoints: {
        1024:{
          height:560,
          thumbnailWidth: 300,
          thumbnailHeight: 250
        },
        990:{
          height:750,
          thumbnailWidth: 300,
          thumbnailHeight: 250
        },
        800: {
          thumbnailWidth: 300,
          thumbnailHeight: 250
        },
        780: {
          height:900,
          thumbnailsPosition: 'bottom',
          thumbnailWidth: 300,
          thumbnailHeight: 220
        },
        600: {
          height:1200,
          thumbnailsPosition: 'bottom',
          thumbnailWidth: 300,
          thumbnailHeight: 220
        },
        500: {
          height: 1300,
          thumbnailsPosition: 'bottom',
          thumbnailWidth: 220,
          thumbnailHeight: 200
        }

      }
 });
 jQuery( '.luxento-widget-has-1-article-has-slider .widget-content' ).sliderPro({
      width: 960,
      height: 700,
      orientation: 'vertical',
      loop: false,
      arrows: false,
      autoplay:false,
      buttons: false,      
      forceSize: 'fullwidth',
      thumbnailsPosition: 'right',
      thumbnailArrows:true,
      smallSize:300,
      startSlide:1,
      thumbnailPointer: false,
      thumbnailWidth: 300,
      thumbnailHeight: 265,
      breakpoints: {
        1024:{
          height: 800,
          thumbnailWidth: 300,
          thumbnailHeight: 265
        },
        
        800: {
          height:1000,
          thumbnailWidth: 300,
          thumbnailHeight: 265
        },
        600:{
          height:1200,
          thumbnailsPosition: 'bottom',
          thumbnailWidth: 220,
          thumbnailHeight: 200
        },
        550:{
          height:1200,
          thumbnailsPosition: 'bottom',
          thumbnailWidth: 220,
          thumbnailHeight: 200
        },
        500: {
          height: 1280,
          thumbnailsPosition: 'bottom',
          thumbnailWidth: 220,
          thumbnailHeight: 200
        }

      }
 });

  //--------------------------------------------------------------------------------------
      //arow up top page 
 //--------------------------------------------------------------------------------------
 jQuery('.luxento-goto-top').on('click',function(){
      jQuery('body,html').animate({scrollTop:0},400);
      return false;
 });
 //--------------------------------------------------------------------------------------
      //minus,plus product
 //--------------------------------------------------------------------------------------
 var start_number_product = 1;
 jQuery('.luxento-current-product').val(start_number_product);
 jQuery('.luxento-plus-product').on('click',function(){
      start_number_product = start_number_product + 1;
      jQuery('.luxento-current-product').val(start_number_product);
 });

 jQuery('.luxento-minus-product').on('click',function(){
      if(start_number_product>1){
        start_number_product = start_number_product - 1;
      jQuery('.luxento-current-product').val(start_number_product);
      }else{
        alert("can not buy less than 1 product");
      }
 });
 //--------------------------------------------------------------------------------------
      //rate product
 //--------------------------------------------------------------------------------------
 jQuery('.luxento-star-of').on('click',function(){
     jQuery('.luxento-star-on').css('display','none');
     jQuery('.luxento-star-of').css('display','inline-block');
     jQuery(this).next().css('display','inline-block');
     jQuery(this).css('display','none');
 });
//--------------------------------------------------------------------------------------
      //search responsive
 //--------------------------------------------------------------------------------------
jQuery('.luxento-search .fa-search').on('click',function(){
      jQuery('.luxento-respon-search-top').toggle(300);
});
jQuery('.luxento-menu-bar').on('click',function(){
      jQuery('.luxento-respon-search-top').css('display','none');
});
//--------------------------------------------------------------------------------------
      //jquery fix height element
 //--------------------------------------------------------------------------------------
jQuery('.luxento-fix-height').matchHeight({}); 
//--------------------------------------------------------------------------------------
      //jquery show map
//--------------------------------------------------------------------------------------
jQuery('.luxento-alert-control').on('click',function(){
      jQuery(this).parent().css('display','none');
});

if(jQuery(".luxento-widget-map").length ){
  // alert("kivv");
    var map = new GMaps({
      el: '.luxento-widget-map',
      lat: -12.043333,
      lng: -77.028333,
      zoomControl : false,
      zoomControlOpt: {
          style : 'SMALL',
          position: 'TOP_LEFT'
      },
      panControl : false,
      streetViewControl : false,
      mapTypeControl: false,
      overviewMapControl: false,
    });
}
// }

});

