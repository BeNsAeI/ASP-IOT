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

const addFormElem = document.getElementById("addForm");
addFormElem.addEventListener('submit', e => {
  e.preventDefault();
  const uploadURLAdd = 'addDevice.php';
  //var radios = addFormElem.childNodes[0].elements["device"];
  var radioval = addFormElem.querySelector('input[name="device"]:checked').value;
  // for (var i=0, len=radios.length; i<len; i++) {
  //   if ( radios[i].checked ) { 
  //       radioval = radios[i].value; 
  //       break;
  //   }
  // }


  var name = document.getElementById("device-name").value;
  var code = document.getElementById("device-code").value;
  console.log(radioval);
  console.log(name);
  console.log(code);

  const formData = new FormData();
  formData.append('name',name);
  formData.append('code',code);
  formData.append('radioval',radioval);

  fetch(uploadURLAdd, {
      method: 'POST',
      body: formData
  }).then(response => {
      //location.reload();
      console.log(response);
  });
  closeFormAdd();
});

const mapFormElem = document.getElementById("mapForm");
mapFormElem.addEventListener('submit', e => {
  e.preventDefault();
  const uploadURLMap = 'updateMap.php';
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

  fetch(uploadURLMap, {
      method: 'POST',
      body: formData
  }).then(response => {
      location.reload();
      //console.log(response);
  });
  closeFormMap();
});