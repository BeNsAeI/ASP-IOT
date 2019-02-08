function addForm() {
  document.getElementById("addForm").style.display = "grid";
  document.getElementById("modal-backbround").style.display = "block";
}
  function closeFormAdd() {
  document.getElementById("addForm").style.display = "none";
  document.getElementById("modal-backbround").style.display = "none";
}

function deleteForm() {
  document.getElementById("deleteForm").style.display = "grid";
  document.getElementById("modal-backbround").style.display = "block";
}
function closeFormDelete() {
  document.getElementById("deleteForm").style.display = "none";
  document.getElementById("modal-backbround").style.display = "none";
}
function mapForm() {
  document.getElementById("mapForm").style.display = "grid";
  document.getElementById("modal-backbround").style.display = "block";
}
function closeFormMap() {
  document.getElementById("mapForm").style.display = "none";
  document.getElementById("modal-backbround").style.display = "none";
}
function updateMapSize() {
  var doc = document.querySelector("html");
  var img = document.getElementById("venue-map");
  doc.style.setProperty("--imageHeight",img.height + "px");
  doc.style.setProperty("--imageWidth",img.width + "px");
}



const uploadForm = document.getElementById("mapForm");
uploadForm.addEventListener('submit', e => {
  e.preventDefault();
  const uploadURL = 'updateMap.php';
  const files = document.getElementById("upload-map").files;
  const rows = document.getElementById("change-map-rows").value;
  const cols = document.getElementById("change-map-cols").value;
  const formData = new FormData();

  for (let i = 0; i < files.length; i++) {
    let file = files[i];
    console.log(file);
    formData.append('files[]', file);
  }  
  formData.append('rows',rows);
  formData.append('cols',cols);

  fetch(uploadURL, {
      method: 'POST',
      body: formData
  }).then(response => {
      location.reload();
      //console.log(response);
  });
  closeFormMap();
});