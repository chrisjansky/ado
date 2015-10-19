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
  var thisData = $(this).data("filter");

  // String starts with a period.
  if (thisData.lastIndexOf(".", 0) === 0) {
    $workButton.attr("href", "projects/" + thisData.slice(1) + "/");
  } else {
    $workButton.attr("href", "projects/");
  }
});
