$(function() {
  var slide_main = $(".slide").slick({
    asNavFor: ".slide-navigation",
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
  });
  var slide_sub = $(".slide-navigation").slick({
    asNavFor: ".slide",
    centerMode: true,
    infinite: true,
    slidesToShow: 5,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 4000,
    speed: 400,
    focusOnSelect: true,
  });
  var open_window_Width = $(window).width();
  $(window).resize(function() {
    var width = $(window).width();
    if (open_window_Width != width) {
      slide_main.slick("setPosition");
      slide_sub.slick("setPosition");
    }
  });
});
