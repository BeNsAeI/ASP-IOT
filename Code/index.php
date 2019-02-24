<?php 
//ob_start();
session_start();

$incorrectGuess = false;
if (isset($_POST['submit']))
{
  $token = $_POST["token"];
  if($token == "viewer")
  {
    $_SESSION['valid'] = true;
    $_SESSION['username'] = 'viewer';
    header("Location: main.php");
  }
  elseif($token == "admin")
  {
    $_SESSION['valid'] = true;
    $_SESSION['username'] = 'admin';
    header("Location: main.php");
  }
  else
  {
    $incorrectGuess = true;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>A-Frame Stuff</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Fonts & Icons
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <link rel="stylesheet" href="css/custom.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="images/favicon.png">

  <!-- JS 
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <script src="js/index.js"></script>

</head>
<body id="login">
  <img id="background-image" src="images/index-background.jpg">

  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <div id="login-page-container" class="container">
    <div class="row login-header">
      <div class="two-thirds column">
        <h2>Welcome</h2>
      </div>
      <div class="column no-margin">
        <h3>To Ben and Jenna's Wedding</h3>
      </div>
    </div>
    <div class="row">
     <form method="POST" id="login-container" action="">
          <legend class="login-text"> Enter your login token</legend>
          <i id="icon-key" class="material-icons md-18">vpn_key</i>
          <input id="user-token-input" type="text" name="token" pattern="[a-zA-Z0-9]{2,}" required/>
          <button id="submit-token" type="submit" name="submit">
            <i id="icon-input" class="material-icons md-18">input</i>
          </button>
          <?php if($incorrectGuess){
            echo '<p class="token-fail"> Incorrect Login Token </p>';
          }?>
        </form>
    </div>
  </div>
<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>
