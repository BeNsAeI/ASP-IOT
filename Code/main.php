<?php 
// If they haven't logged in with a token send them back to index
session_start();
//echo "testing";
//header("location: index.php");
if($_SESSION['username'] != "admin" && $_SESSION['username'] != "viewer")
{
	header("location: index.php");
}
//print_r($_SESSION['username']);

?>
<!DOCTYPE html>
<!-- popup and formatting for popup taken from https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_popup_form -->
<html>
<head>
<!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>Admin</title>
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

<div id="main-content">

  <a class="logout" href="logout.php"> Logout </a>
  <!-- Only show buttons and modal info if logged in as admin -->
  <?php if($_SESSION['username'] == "admin"){ ?>

    <div id="admin-buttons">
      <button class="add-button" onclick="addForm()">ADD DEVICE</button>
      <button class="move-button" onclick="openForm()">MOVE DEVICE</button>
      <button class="delete-button" onclick="deleteForm()">DELETE DEVICE</button>
      <button class="change-button" onclick="mapForm()">CHANGE MAP</button>
    </div>

    <div id="modal-backbround"></div>
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

    <!-- change map form -->
    <div class="form-popup" id="mapForm">
      <form method="post" class="form-container" enctype="multipart/form-data">
        <h1>Change Map</h1>
        <input id="upload-map" class="form-label-wide" type="file" name="image">
         <div class="form-input"></div> <!-- Intentionally left empty for form auto placement -->

        <button type="button" class="btn cancel" onclick="closeFormMap()">Cancel</button>
        <input class="btn submit" type="submit" value="Upload File" name="submit">

      </form>
    </div>


    <script src="js/main.js"></script>
  <?php } ?>

  <div id="map-container">
    <img class="venue-map" src="images/venue-test" alt="venue">
  </div>

</div>
</body>


</html>
