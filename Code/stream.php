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

$deviceCode = $_GET['code'];

$sql = 'SELECT * FROM  `devices` where `code` = "' . $deviceCode . '" ';
$result = $db->query($sql);

$name = $result['name'];
$code = $result['code'];
$type = $result['type'];
$row = $result['row'];
$column = $result['column'];

$device = new Device($name, $code, $type, $row, $column); 

?>
<!DOCTYPE html>
<html>
<head>
<!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>Stream</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <link rel="stylesheet" href="css/custom.css">
  <link rel="stylesheet" href="css/forms.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="images/favicon.png">

  <!-- Our stuff 
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <!-- <script src="js/main.js"></script> -->

  <!-- Aframe 
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <script src="https://aframe.io/releases/0.9.0/aframe.min.js"></script>

  <title>Stream</title>   
  <!-- TODO: include device name -->
</head>
<body>


<h2 class="title">Welcome to Ben and Jenna's Wedding</h2>

<div id="stream-content">

  <p class="description"> Device code: <?php echo $device->getCode();?> </p>
  <div id="stream-container">
    <a-scene embedded>
      <a-box position="-1 0.5 -3" rotation="0 45 0" color="#4CC3D9"></a-box>
      <a-sphere position="0 1.25 -5" radius="1.25" color="#EF2D5E"></a-sphere>
      <a-cylinder position="1 0.75 -3" radius="0.5" height="1.5" color="#FFC65D"></a-cylinder>
      <a-plane position="0 0 -4" rotation="-90 0 0" width="4" height="4" color="#7BC8A4"></a-plane>
      <a-sky color="#ECECEC"></a-sky>
    </a-scene>
    
  </div>
  <a class="back" href="main.php"> <i id="icon-back" class="material-icons md-18">arrow_back</i> </a>
  <a class="logout" href="logout.php"> Logout </a>
  
</body>


</html>
