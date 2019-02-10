<?php 
// If they haven't logged in with a token send them back to index
session_start();
if($_SESSION['username'] != "admin" && $_SESSION['username'] != "viewer")
{
	header("location: index.php");
}
ini_set('display_errors', 'on');

include 'database.php';
include 'device.php';
$db = new Database();
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
</head>
<body onload="updateMapSize()" onresize="updateMapSize()">

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
      <form method="post" class="form-container">
        <h1>Add Device</h1>
        <b class="form-label"> Device Type: </b>
        <p class="form-input">
        <input type="radio" name="device" value="normal" required checked/> Normal Camera<br />
        <input type="radio" name="device" value="vr" /> 360 Camera<br />
        <input type="radio" name="device" value="microphone" /> Microphone<br /></p>

        <b class="form-label"> Device Name:</b>
        <input id="device-name" class="form-input" type="text" placeholder="Name" name="NAME"  required>

        <b class="form-label"> Device Code:</b>
        <input id="device-code" class="form-input" type="text" placeholder="Device Code" name="CODE"  required> 

        <button type="button" class="btn cancel" onclick="closeFormAdd()">Cancel</button>
        <button type="submit" class="btn submit">Submit</button>

      </form>
    </div>

    <!-- delete device form -->
    <div class="form-popup delete" id="deleteForm">
      <form method="post" class="form-container">
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

        <b class="form-label"> Rows:</b>
        <input id="change-map-rows" class="form-input" type="number" placeholder="Number of rows" name="ROWS" pattern="[0-9]" required> 

        <b class="form-label"> Columns:</b>
        <input id="change-map-cols" class="form-input" type="number" placeholder="Number of columns" name="COLS" pattern="[0-9]" required> 

        <button type="button" class="btn cancel" onclick="closeFormMap()">Cancel</button>
        <input class="btn submit" type="submit" value="Upload File" name="submit">
      </form>
    </div>


    
  <?php } ?>

  <div id="map-container">
    <?php
    $sql = "SELECT * FROM  `map` ORDER BY id DESC LIMIT 0, 1";
    $result = $db->query($sql);
    $mapPath = $result["File"];
    $rows = $result["Rows"];
    $columns = $result["Columns"];

    $sql = "SELECT * FROM  `devices`";
    $results = $db->queryAll($sql);
    
    $devices = array();

    foreach($results as $result){
      //print_r($result);
      $name = $result[1];
      $code = $result[2];
      $type = $result[3];
      $row = $result[4];
      $column = $result[5];

      $devices[] = new Device($name, $code, $type, $row, $column); 
    }


    ?>
    <style>
      :root{
        --rows: <?php echo $rows;?> ;
        --cols: <?php echo $columns;?> ;
        --imageWidth: <?php echo 0;?>px;
        --imageHeight: <?php echo 0;?>px;
      }
    </style>
    <img id="venue-map" src="images/<?php echo $mapPath;?>" alt="venue">
    <div id="device-grid-container">

      <?php for($i = 0; $i < $rows; $i++) {
          for($j = 0; $j < $columns; $j++) {
            echo '<div class="device-grid-cell device-grid-row-'. $i . ' device-grid-column-'. $j .'">';
            foreach($devices as $device){
              if($i == 0 && $j == 0 && $device->getRow() > $rows && $device->getColumn() > $columns){
                echo $device->getHTML();  //if the device has a coordinate that is larger than the grid put it at 0,0
              }

              if($device->getRow() == $i && $device->getColumn() == $j){
                echo $device->getHTML();
              }
            }
            echo '</div>'; 
          }
      }

      ?>
    
    </div>
  </div>
  <script async src="js/main.js"></script>

</div>
</body>


</html>
