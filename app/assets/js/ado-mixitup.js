$("[data-mixitup]").mixItUp({
  selectors: {
    target: "[data-target]",
    filter: "[data-filter]"
  },
  controls: {
    activeClass: "o-toggle--active"
  }
});

var $workButton = $("#js-workbutton");

$("[data-filter]").on("click", function() {
  var toFilter = $(this).data("filter").slice(1);

  $workButton.attr("href", "projects?filter=" + toFilter);
});
