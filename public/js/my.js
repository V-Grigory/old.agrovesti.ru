$(document).ready(function() {

    var wrap_main_menu_position = $('.wrap_main_menu').position();
    //console.log(wrap_main_menu_position.top);
    $(window).scroll(function() {
         //console.log($(this).scrollTop());
         if($(this).scrollTop() > wrap_main_menu_position.top) {
             $('.navbar').removeClass("navbar-absolute");
         } else {
             $('.navbar').addClass("navbar-absolute");
         }
    });

    $('#offer_describe').click(function () {
        if($('.wrap_offer_describe').css('display') == 'none') {
            $('.wrap_offer_describe').css('display', 'block');
        } else {
            $('.wrap_offer_describe').css('display', 'none');
        }
    })

});
