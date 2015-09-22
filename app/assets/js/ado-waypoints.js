var
  navActiveClass = "o-nav__link--active",
  $navLinks = $("[data-nav-link]");

var
  sectionInviewDown = $("[data-section]").waypoint({
    handler: function(direction) {
      $navLinks.filter("[href='#" + this.element.id + "']").toggleClass(navActiveClass, direction === "down");
    },
    offset: "50%"
  }),
  sectionInviewUp = $("[data-section]").waypoint({
    handler: function(direction) {
      $navLinks.filter("[href='#" + this.element.id + "']").toggleClass(navActiveClass, direction === "up");
    },
    offset: function() {
      return Waypoint.viewportHeight() / 2 - this.element.clientHeight
    }
  });
