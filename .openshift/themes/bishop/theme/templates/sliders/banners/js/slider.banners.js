(function(b,f){var d=b(f).width();b("#primary").find(".slider.banners").css({left:-((d-b(".container").width())/2),width:d});b(".slider.banners").each(function(){function d(a){b(".slide-text.center",a.container).each(function(){var a=b(this),c=a.outerHeight(!1);a.css({position:"absolute",height:c,top:"50%",marginTop:c/2*-1,zoom:g})});b(".swiper-wrapper",a.container).width()<=a.width&&b(".prev, .next",a.container).remove()}var e=b(this),k=e.data("height"),c=new Swiper("#"+e.attr("id"),{slidesPerView:"auto",
calculateHeight:!1,cssWidthAndHeight:!0,mode:"horizontal",autoplay:"yes"==e.data("autoplay")?e.data("interval"):0,autoResize:!1,resizeReInit:!0,onSwiperCreated:function(a){d(a)},onInit:function(a){b(a.container).height(k);h()}}),g=function(){var a=b(f).width();return 768>a?.4:768<=a&&991>=a?.64:992<=a&&1199>=a?992/1200:1},h=function(){b(f).width();var a;a=g()*e.data("height");b(c.container).height(a);b(".swiper-wrapper, .swiper-slide",c.container).height(a);d(c)};b(c.container).on("click",".prev",
function(a){a.preventDefault();a=b(".swiper-slide",c.container).length;c.swipePrev()||c.swipeTo(a)});b(c.container).on("click",".next",function(a){a.preventDefault();c.swipeNext()||c.swipeTo(0)});_onresize(function(){c.reInit();h()})})})(jQuery,window);