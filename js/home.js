$("nav").css("background-color", "transparent");

var waypoint = new Waypoint({
  element: document.getElementById('bannerEnd'),
  handler: function() {
    $("nav").css("background-color", "black");
  }
})