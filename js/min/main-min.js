!function($){function e(){$(".services-container").addClass("full-width"),$(".property-map-sidebar").hide(),$(".inner-container").addClass("is-hidden")}$(".bucket-availability").on("click",function(a){a.preventDefault(),$(this).addClass("is-active"),e(),$(".report-container").removeClass("is-hidden")}),$(".bucket-gallery").on("click",function(a){a.preventDefault(),$(this).addClass("is-active"),e(),$(".gallery-container").removeClass("is-hidden")}),$(".bucket-contact").on("click",function(a){a.preventDefault(),$(this).addClass("is-active"),e(),$(".contact-container").removeClass("is-hidden")}),$(".bucket-news").on("click",function(a){a.preventDefault(),$(this).addClass("is-active"),e(),$(".community-news-container").removeClass("is-hidden")}),$(".thumb").on("click",function(){var e=$(this).attr("data-swap");console.log(e),$(".main-image").attr("src",e)}),$(".portfolio-header-gallery").slick({slidestoshow:1,infinie:!0,autoplay:!0,autoplaySpeed:2e3,speed:500,fade:!0,cssEase:"linear",pauseOnHover:!1}),$(".portfolio-sidebar-gallery").slick({slidesToShow:1,slidesToScroll:1,autoplay:!0,autoplaySpeed:2e3,dots:!1,fade:!0,speed:1e3,arrows:!1,pauseOnHover:!1,asNavFor:".slider-nav"}),$(".slider-nav").slick({slidesToShow:2,slidesToScroll:1,asNavFor:".portfolio-sidebar-gallery",dots:!1,centerMode:!0,focusOnSelect:!0})}(jQuery);