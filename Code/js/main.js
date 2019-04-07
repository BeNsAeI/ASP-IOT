
function updateMapSize(rows) {
  var doc = document.querySelector("html");
  var img = document.getElementById("venue-map");
  doc.style.setProperty("--imageHeight",img.height + "px");
  doc.style.setProperty("--imageWidth",img.width + "px");
  doc.style.setProperty("--iconSize", img.height/rows + "px");

  var icons = document.getElementsByClassName("icon-camera");
  for(key in icons){
    // console.log(key);
    // console.log(icons);
    if (icons.hasOwnProperty(key)) {
      icons[key].style.setProperty("font-size", (img.height/rows -2)+ "px");
      icons[key].style.setProperty("line-height", (img.height/rows -2)+ "px");
    }
  }
  var icons = document.getElementsByClassName("icon-vr");
  for(key in icons){
    // console.log(key);
    // console.log(icons);
    if (icons.hasOwnProperty(key)) {
    icons[key].style.setProperty("font-size", (img.height/rows -2)+ "px");
    icons[key].style.setProperty("line-height", (img.height/rows -2)+ "px");
    }
  }
}
