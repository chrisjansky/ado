// Stripped down and centered version of chj-carousel.js

$("[data-swiper]").each(function(index, instance) {

  $(this).imagesLoaded(function() {
    var carouselSwiper = new Swiper(instance, {
      slidesPerView: "auto",
      centeredSlides: true,
      calculateHeight: true,
      keyboardControl: true,
      visibilityFullFit: true
    });
  })

});
