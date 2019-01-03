<!-- popup and formatting for popup taken from https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_popup_form -->
<?php 
echo'<body style="background-color:Bisque">';
?>
<!DOCTYPE html>
<html>
<head>
<meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <link rel="stylesheet" href="css/custom.css">
  <link rel="stylesheet" href="css/forms.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="images/favicon.png">

<title>Admin</title>
<style>

</style>
</head>
<body>

<h2>Welcome to Ben and Jenna's Wedding</h2>

<!-- buttons -->
<button class="add-button" onclick="addForm()">ADD DEVICE</button>
<button class="move-button" onclick="openForm()">MOVE DEVICE</button>
<button class="delete-button" onclick="deleteForm()">DELETE DEVICE</button>
<button class="change-button" onclick="openForm()">CHANGE MAP</button>

<div id="modal-backbround"></div>;

<!--add camera form-->
<div class="form-popup" id="addForm">
  <form action='' class="form-container">
    <h1>Add Device</h1>
    <b class="form-label"> Device Type: </b>
    <p class="form-input">
    <input type="radio" name="camera" /> Normal Camera<br />
    <input type="radio" name="camera" /> 360 Camera<br />
    <input type="radio" name="camera" /> Microphone<br /> </p>

    <b class="form-label"> Device Name:</b>
    <input class="form-input" type="text" placeholder="Name" name="NAME" required>

    <b class="form-label"> Device Code:</b>
    <input class="form-input" type="text" placeholder="Device Code" name="CODE" required> 

    <button type="button" class="btn cancel" onclick="closeFormAdd()">Cancel</button>
    <button type="submit" class="btn submit">Submit</button>

  </form>
</div>

<!-- delete device form -->
<div class="form-popup delete" id="deleteForm">
  <form action='' class="form-container">
    <h1>Delete</h1>
    <b class="form-label"> Device Name: </b>
    <input class="form-input" list="camera" name="camera">
    <datalist id="camera">
        <option value="Normal camera1">
        <option value="microphone">
        <option value="360 camera">
    </datalist>
    
    <button type="button" class="btn cancel" onclick="closeFormDelete()">Cancel</button>
    <button type="submit" class="btn submit">Submit</button>
  </form>
</div>

<img class="venue-map" src="images/venue.png" alt="venue">

</body>

<script>
function addForm() {
  document.getElementById("addForm").style.display = "grid";
  document.getElementById("modal-backbround").style.display = "block";
}

function deleteForm() {
  document.getElementById("deleteForm").style.display = "grid";
  document.getElementById("modal-backbround").style.display = "block";
}

function closeFormAdd() {
  document.getElementById("addForm").style.display = "none";
  document.getElementById("modal-backbround").style.display = "none";
}

function closeFormDelete() {
  document.getElementById("deleteForm").style.display = "none";
  document.getElementById("modal-backbround").style.display = "none";
}
</script>

</html>
