$(document).ready(function() {
    $('nav#menu').mmenu();
  

    // $(window).scroll(function() {    
    //     var scroll = $(window).scrollTop();
    //     if (scroll >= 2) {
    //     $(".header_Site").addClass("stickyhead");
    //     } else {
    //     $(".header_Site").removeClass("stickyhead");
    //     }
    //   });

    $('.bannerSlide').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        dots: true,
        arrows: false,
        prevArrow:"<button type='button' class='slick-prev'><i class='fa fa-chevron-left' aria-hidden='true'></i></button>",
        nextArrow:"<button type='button' class='slick-next'><i class='fa fa-chevron-right' aria-hidden='true'></i></button>",
            
    });


        $('.minus').click(function () {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
            $input.val(count);
            $input.change();
            return false;
        });
        $('.plus').click(function () {
            var $input = $(this).parent().find('input');
            $input.val(parseInt($input.val()) + 1);
            $input.change();
            return false;
        });

        $('.likeSlide').slick({
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 5000,
            dots: false,
            arrows: true,
            prevArrow:"<button type='button' class='slick-prev'><i class='fa fa-chevron-left' aria-hidden='true'></i></button>",
            nextArrow:"<button type='button' class='slick-next'><i class='fa fa-chevron-right' aria-hidden='true'></i></button>",
                
        });
   

}); 


