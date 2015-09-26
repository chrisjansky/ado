// Scroll to anchor.
var opticalOffset = vHeight * .1

$("[data-scrollto]").click(function() {
  window.location.hash = "section-" + this.hash.slice(1)

  $("html, body").animate({
    scrollTop: $($(this).attr("href")).offset().top - opticalOffset
  }, durBasic);
  return false
});

// On load.
if (location.hash) {
  var smoothScrollTo = "#" + location.hash.slice(9)

  $(window).load(function() {
    $("html, body").animate({
      scrollTop: $(smoothScrollTo).offset().top - opticalOffset
    }, durBasic);
  })
}
