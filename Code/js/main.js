
function updateMapSize() {
  var doc = document.querySelector("html");
  var img = document.getElementById("venue-map");
  doc.style.setProperty("--imageHeight",img.height + "px");
  doc.style.setProperty("--imageWidth",img.width + "px");
}
