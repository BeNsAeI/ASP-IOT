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

const addFormElem = document.getElementById("addForm");
addFormElem.addEventListener('submit', e => {
  e.preventDefault();
  const uploadURLAdd = 'addDevice.php';
  var radioval = addFormElem.querySelector('input[name="device"]:checked').value;
  var name = document.getElementById("device-name").value;
  var code = document.getElementById("device-code").value;
  var row = document.getElementById("add-map-rows").value;
  var column = document.getElementById("add-map-cols").value;

  const formData = new FormData();
  formData.append('name',name);
  formData.append('code',code);
  formData.append('radioval',radioval);
  formData.append('row',row-1);
  formData.append('column',column-1);

  addFormElem.firstElementChild.reset();

  fetch(uploadURLAdd, {
      method: 'POST',
      body: formData
  }).then(response => {
      location.reload();
      //console.log(response);
  });
  closeFormAdd();
});

const deleteFormElem = document.getElementById("deleteForm");
deleteFormElem.addEventListener('submit', e => {
  e.preventDefault();
  console.log("Deleting")
  const uploadURLAdd = 'deleteDevice.php';
  var e = document.getElementById("device-list");
  var deviceCode = e.options[e.selectedIndex].value;
  console.log(deviceCode)

  const formData = new FormData();
  formData.append('code',deviceCode);

  fetch(uploadURLAdd, {
      method: 'POST',
      body: formData
  }).then(response => {
      location.reload();
      //console.log(response);
  });
  deleteFormElem.firstElementChild.reset();
  closeFormDelete();
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

  mapFormElem.firstElementChild.reset();
  fetch(uploadURLMap, {
      method: 'POST',
      body: formData
  }).then(response => {
      location.reload();
      //console.log(response);
  });
  closeFormMap();
});

function startMove(e){
  console.log("Starting Move");
  var moveButton = document.getElementById("move-button");    //switch move with cancel
  var cancelMoveButton = document.getElementById("cancel-move-button");
  moveButton.style.display = "none";
  cancelMoveButton.style.display = "inline-block";
  
  var cells = document.getElementsByClassName("device-grid-cell");    //show grid lines
  for (var i = 0, max = cells.length; i < max; i++) {
    cells[i].style.borderWidth = "1px";
  }

  var devices = document.getElementsByClassName("device");    //mark devices as clickable
  for (var i = 0, max = devices.length; i < max; i++) {
    devices[i].classList.add("selectable-device");
    devices[i].parentNode.removeAttribute("href");
  }
  var grid = document.getElementById("device-grid-container"); 
  grid.addEventListener('click', deviceClicked);
}

function cancelMove(e){
  console.log("Canceling Move");
  var moveButton = document.getElementById("move-button");
  var cancelMoveButton = document.getElementById("cancel-move-button");
  moveButton.style.display = "inline-block";
  cancelMoveButton.style.display = "none";

  var cells = document.getElementsByClassName("device-grid-cell");    //removing grid cells
  for (var i = 0, max = cells.length; i < max; i++) {     
    cells[i].style.borderWidth = "0px";
  }

  var devices = document.getElementsByClassName("device");    //unmarking devies as clickable
  for (var i = 0, max = devices.length; i < max; i++) {
    devices[i].classList.remove("selectable-device");
    devices[i].classList.remove("selected-device");
    var code = devices[i].parentNode.getAttribute("code");
    devices[i].parentNode.setAttribute("href","stream.php?code=" + code);

  }
  var grid = document.getElementById("device-grid-container");
  
  for (var i = 0, max = cells.length; i < max; i++) {   //unmarking cells as clickable
    cells[i].classList.remove("selectable-cell");
  }
  selectedDevice = null;
  grid.removeEventListener('click', deviceClicked);
  grid.removeEventListener('click', cellClicked);
  devicechosen = false;

}


function restartMove(){
  var devices = document.getElementsByClassName("device");    //for when you click the same device you have selected
  var cells = document.getElementsByClassName("device-grid-cell");  
  for (var i = 0, max = devices.length; i < max; i++) {
    devices[i].classList.add("selectable-device");
    devices[i].classList.remove("selected-device");
  }
  for (var i = 0, max = cells.length; i < max; i++) {
    cells[i].classList.remove("selectable-cell");
  }
  devicechosen = false;
}
var devicechosen = false;
var selectedDevice;
function deviceClicked(e){
  console.log("Device Click Recognized");

  if(e.target.parentNode.classList.contains("selectable-device")){
    selectedDevice = e.target.parentNode;
  } else if(e.target.parentNode.parentNode.classList.contains("selectable-device")){
    selectedDevice = e.target.parentNode.parentNode;
  } else if (e.target.classList.contains("selectable-device")){
    if(devicechosen){   //if you've already selected a device (will be the only one with the classname)
      restartMove();
      return;
    }
    devicechosen = true;
    selectedDevice = e.target;
  } else {
    console.log("Not a clickable device");
    return;
  }
  
  var devices = document.getElementsByClassName("device");
  for (var i = 0, max = devices.length; i < max; i++) {       //only highlight the selected device
    if(devices[i] !== selectedDevice){
      devices[i].classList.remove("selectable-device");
    } else {
      devices[i].classList.add("selected-device");
    }
  }
  var cells = document.getElementsByClassName("device-grid-cell");    //show what grid cells that device can go to
  for (var i = 0, max = cells.length; i < max; i++) {
    if (!cells[i].hasChildNodes()){
      cells[i].classList.add("selectable-cell");
    }
  }

  var grid = document.getElementById("device-grid-container");
  grid.addEventListener('click', cellClicked);
    
 
}

function cellClicked(e){
  console.log("Cell Click Recognized");
  if (e.target.classList.contains("selectable-cell")){
    const uploadURLMove = 'moveDevice.php'
    var cell = e.target;
    var cellRow = cell.getAttribute("row");
    var cellCol = cell.getAttribute("column");
    var deviceCode = selectedDevice.id;

    console.log(cellRow + " " + cellCol);

    selectedDevice.setAttribute("row",cellRow);
    selectedDevice.setAttribute("column",cellCol);
    

    cell.appendChild(selectedDevice.parentNode);     //move the device

    const formData = new FormData();      //update the DB to reflect move

    formData.append('row',cellRow);
    formData.append('column',cellCol);
    formData.append('code',deviceCode);

    fetch(uploadURLMove, {
        method: 'POST',
        body: formData
    }).then(response => {
        //location.reload();
        console.log(response);
    });


    cancelMove(e);
    
  } else {
    console.log("Not a clickable cell");
  }
}