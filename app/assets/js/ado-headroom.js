var
  jsHeader = document.getElementById("js-header");

var headroom = new Headroom(jsHeader, {
  "offset": Math.round(vHeight * .25),
  "tolerance": {
    down: Math.round(vHeight * .05),
    up: Math.round(vHeight * .05)
  }
}).init();
