<?php 
if (isset($_POST['button1']))
{
  if($_POST["name"] == "admin")
  {
  header("Location: admin.php");
  }
  elseif($_POST["name"] == "viewer")
  {
    header("Location: viewer.php");
  }
  else
  {
    echo ("wrong password");
   // header("Location: index.php");
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

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <link rel="stylesheet" href="css/custom.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="images/favicon.png">

</head>
<body id="login">

  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <div class="container">
    <div class="row login-header">
      <div class="two-thirds column">
        <h2>Welcome</h2>
      </div>
      <div class="column no-margin">
        <h3>To Ben and Jenna's Wedding</h3>
      </div>     
    </div>
    <div class="row">
     <!-- <div id="login-container"> -->
        <form method="POST" action=''>
        <fieldset>
          <legend> Enter your login token</legend>
          <p>token <input type="text" name="name" /><input type="submit" name="button1"  value="Enter"/></p>
        </fieldset>
        </form> 
        <!-- <input type="submit" name="submit"  value="Enter"> --> 
    </div>
  </div>
<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>
