var
  gulp = require("gulp"),
  plugins = require("gulp-load-plugins")({
    pattern: ["browser-*", "hygienist-*"]
  }),
  config = require("../gulpconfig.json");

gulp.task("wordpress:server", function() {
  plugins.browserSync.init({
    proxy: {
      target: "http://vagrantpress.dev",
      middleware: plugins.hygienistMiddleware(config.dev.root)
    },
    xip: true,
    notify: false
  });
});

gulp.task("wordpress:watch", function() {
  gulp.watch(config.dev.wpGlob, plugins.browserSync.reload);
});

gulp.task("wordpress", ["wordpress:server", "wordpress:watch"]);
