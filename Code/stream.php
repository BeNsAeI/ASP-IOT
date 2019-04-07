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
$ip = $result['ip'];
$port = $result['port'];

$device = new Device($name, $code, $type, $row, $column, $ip, $port); 

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



<div id="stream-content">
  <h2 class="title">Welcome to Ben and Jenna's Wedding</h2>

  <script src="js/hls.js"></script>
  <?php if ($device->getType() == "vr") { ?>
  <p class="description"> Device code: <?php echo $device->getCode();?> </p>
  <div id="stream-container">
    <a-scene embedded>
      <a-assets>
        <video id="stream-container" autoplay loop="true" src="http://<?php echo $device->getFullAddress();?>/camera/livestream.m3u8"> </video>
      </a-assets>

      <!-- Using the asset management system. -->
      <a-videosphere src="#stream-container"></a-videosphere>

      <!-- Defining the URL inline. Not recommended but more comfortable for web developers. -->
      <!-- <a-videosphere src="africa.mp4"></a-videosphere> -->
    </a-scene>
    
  </div>

  
  <?php } else { ?>
    

    <video id="stream-container" src="http://<?php echo $device->getFullAddress();?>/camera/livestream.m3u8" type="application/x-mpegURL" controls autoplay>
    Error displaying video.
    </video>
  <?php } ?>

    

    <script>
      var video = document.getElementById('stream-container');
      if(Hls.isSupported()) {
        var hls = new Hls();
        hls.loadSource('http://<?php echo $device->getFullAddress();?>/camera/livestream.m3u8');
        hls.attachMedia(video);
        hls.on(Hls.Events.MANIFEST_PARSED,function() {
          video.play();
      });
    }
    // hls.js is not supported on platforms that do not have Media Source Extensions (MSE) enabled.
    // When the browser has built-in HLS support (check using `canPlayType`), we can provide an HLS manifest (i.e. .m3u8 URL) directly to the video element throught the `src` property.
    // This is using the built-in support of the plain video element, without using hls.js.
    // Note: it would be more normal to wait on the 'canplay' event below however on Safari (where you are most likely to find built-in HLS support) the video.src URL must be on the user-driven
    // white-list before a 'canplay' event will be emitted; the last video event that can be reliably listened-for when the URL is not on the white-list is 'loadedmetadata'.
      else if (video.canPlayType('application/vnd.apple.mpegurl')) {
        video.src = 'http://<?php echo $device->getFullAddress();?>/camera/livestream.m3u8';
        video.addEventListener('loadedmetadata',function() {
          video.play();
        });
      }
    </script>
  
  <a class="back" href="main.php"> <i id="icon-back" class="material-icons md-18">arrow_back</i> </a>
  <a class="logout" href="logout.php"> Logout </a>
  
</body>


</html>
