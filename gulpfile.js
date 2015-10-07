var gulp = require("gulp");

/* Basic */
require("./bower_components/chj-framework/gulp/tasks/server.js");
require("./bower_components/chj-framework/gulp/tasks/templates.js");
require("./bower_components/chj-framework/gulp/tasks/styles.js");
require("./bower_components/chj-framework/gulp/tasks/watch.js");

gulp.task("default", ["server", "watch"]);

/* Advanced */
require("./bower_components/chj-framework/gulp/tasks/guide.js");
require("./bower_components/chj-framework/gulp/tasks/svg.js");

/* Optional */
require("./gulp/tasks/wordpress.js");

/* Production */
require("./bower_components/chj-framework/gulp/tasks/build.js");
require("./bower_components/chj-framework/gulp/tasks/deploy.js");
