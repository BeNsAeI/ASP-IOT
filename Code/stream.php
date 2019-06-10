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
  <script src="js/hls.js"></script>
  <script src="js/arrow-key-rotation.js"></script>
  <script src="js/play-on-window-click.js"></script>
  <script src="js/play-on-vrdisplayactivate-or-enter-vr.js"></script>

  <title>Stream</title>   
  <!-- TODO: include device name -->
</head>
<body>



<div id="stream-content">
  <h2 class="title">Welcome to Ben and Jenna's Wedding</h2>

  
  <?php if ($device->getType() == "vr") { ?>
  

    <a-scene id="a-container" keyboard-shortcuts="" screenshot="" vr-mode-ui="" embedded>
      <!-- The original example also has this 180 degree rotation, to appear to be going forward. -->
      <?php if ($deviceCode == "360prerec") { ?>
        <a-videosphere rotation="0 0 0" src="#stream-container" play-on-window-click="" play-on-vrdisplayactivate-or-enter-vr="" position="" scale="-1 1 1" visible="" material="" geometry="primitive:sphere;radius:5000;segmentsWidth:84;segmentsHeight:48">
      <?php } else { ?>
        <a-videosphere rotation="0 0 0" src="#stream-container" play-on-window-click="" play-on-vrdisplayactivate-or-enter-vr="" position="" scale="-1 1 1" visible="" material="" geometry="primitive:sphere;radius:5000;segmentsWidth:64;segmentsHeight:64">
      <?php } ?>

      </a-videosphere>
      
      <!-- Define camera with zero user height, movement disabled and arrow key rotation added. -->
      <a-camera user-height="0" wasd-controls-enabled="false" arrow-key-rotation="" position="" rotation="" scale="" visible="" camera="" look-controls="" wasd-controls="">
        <!--
          This should work with, at least:
          Safari Technology Preview on MacOS, Edge on Windows 10, Oculus Browser, Samsung Internet, Chrome on Android
          (application/x-mpegurl, which is native HLS).
          Firefox on MacOS / Windows, Chrome on MacOS / Windows 
          (video/mp4).

          This may fail with, at least:
          Safari on MacOS / iOS (HLS and/or CORS bugs), Chromium (missing codec support).
        -->
      </a-camera>      
      
      <!-- Don't wait for the video to load, we're going to stream it. -->
      <a-assets timeout="1">
        <!-- Multiple source video. -->
        <video id="stream-container" style="display:none" autoplay="" loop="" crossorigin="anonymous" playsinline="" webkit-playsinline="">
          <!-- Native HLS video source. -->
          <?php if ($deviceCode == "360prerec") { ?>
            <source type="video/mp4" src="streams/prerec360.mp4">
          <?php } else { ?>
            <source type="application/x-mpegurl" src="http://<?php echo $device->getFullAddress();?>/picam/stream/index.m3u8">
          <?php } ?>
          <!-- MP4 video source. -->
        </video>

        <?php if ($deviceCode != "360prerec") { ?>
          <script>
            var video = document.getElementById('stream-container');
            if(Hls.isSupported()) {
            var hls = new Hls();
            console.log("loading stream");
            hls.loadSource('http://<?php echo $device->getFullAddress();?>/picam/stream/index.m3u8');
            hls.attachMedia(video);
            hls.on(Hls.Events.MANIFEST_PARSED,function() {
              console.log("playing video");
              video.play();
            });
          }
          // hls.js is not supported on platforms that do not have Media Source Extensions (MSE) enabled.
          // When the browser has built-in HLS support (check using `canPlayType`), we can provide an HLS manifest (i.e. .m3u8 URL) directly to the video element throught the `src` property.
          // This is using the built-in support of the plain video element, without using hls.js.
          // Note: it would be more normal to wait on the 'canplay' event below however on Safari (where you are most likely to find built-in HLS support) the video.src URL must be on the user-driven
          // white-list before a 'canplay' event will be emitted; the last video event that can be reliably listened-for when the URL is not on the white-list is 'loadedmetadata'.
            else if (video.canPlayType('application/vnd.apple.mpegurl')) {
            console.log("loading fallback");
            video.src = 'http://<?php echo $device->getFullAddress();?>/picam/stream/index.m3u8';
            video.addEventListener('loadedmetadata',function() {
              video.play();
            });
            }
          </script>
        <?php } ?>
        </a-assets>
      <div class="a-enter-vr" aframe-injected="">
        <button class="a-enter-vr-button" title="Enter VR mode with a headset or fullscreen mode on a desktop. Visit https://webvr.rocks or https://webvr.info for more information." aframe-injected=""></button>
      </div>
      <div class="a-orientation-modal a-hidden" aframe-injected="">
        <button aframe-injected="">Exit VR</button>
      </div>
      <a-entity light="" data-aframe-default-light="" aframe-injected="" position="" rotation="" scale="" visible=""></a-entity>
      <a-entity light="" position="" data-aframe-default-light="" aframe-injected="" rotation="" scale="" visible=""></a-entity>
    </a-scene>
    
    <!-- Attach other behaviors. -->
    <script>
      var video = document.querySelector('#video');
      var msg = document.querySelector('#msg');
      
      // When we get the playing event, show what source is used and what type it is.
      video.addEventListener('playing', function () {
        var currentSource = video.querySelector('[src="' + video.currentSrc + '"]');
        msg.setAttribute('text', 'value', video.currentSrc + '\n' + currentSource.type);                
      });
    </script>

  
  <?php } else { ?>
    

    <video id="stream-container" src="http://<?php echo $device->getFullAddress();?>/picam/stream/index.m3u8" type="application/x-mpegURL" controls autoplay>
    Error displaying video.
    </video> 
  

    

    <script>
      var video = document.getElementById('stream-container');
      if(Hls.isSupported()) {
        var hls = new Hls();
        console.log("loading stream");
        hls.loadSource('http://<?php echo $device->getFullAddress();?>/picam/stream/index.m3u8');
        hls.attachMedia(video);
        hls.on(Hls.Events.MANIFEST_PARSED,function() {
          console.log("playing video");
          video.play();
      });
    } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
        console.log("loading fallback");
        video.src = 'http://<?php echo $device->getFullAddress();?>/picam/stream/index.m3u8';
        video.addEventListener('loadedmetadata',function() {
          video.play();
        });
      }
    </script>
    <?php } ?>
  
  <a class="back" href="main.php"> <i id="icon-back" class="material-icons md-18">arrow_back</i> </a>
  <a class="logout" href="logout.php"> Logout </a>
  </div>
</body>


</html>
