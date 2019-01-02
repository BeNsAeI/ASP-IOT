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

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="images/favicon.png">

<title>Admin</title>
<style>

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: absolute;
  bottom: 0;
  /*right: 15px;*/
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=text] {
  width: 100%;
  padding: 15px;
  margin: 10px 5px 10px 5px;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=text]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: MediumSpringGreen;
  color: black;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.8;
}

/* Add a grey background color to the cancel button */
.form-container .cancel {
  background-color: grey;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

</style>
</head>
<body>

<h2>Welcome to Ben and Jenna's Wedding</h2>

<button class="add-button" onclick="addForm()">ADD DEVICE</button>
<button class="move-button" onclick="openForm()">MOVE DEVICE</button>
<button class="delete-button" onclick="openForm()">DELETE DEVICE</button>
<button class="change-button" onclick="openForm()">CHANGE DEVICE</button>

<div class="form-popup" id="myForm">
  <form action="/action_page.php" class="form-container">
    <h1>Add Device</h1>
    <b> Device Type: </b>
    <p>
    <input type="radio" name="camera" /> Normal Camera<br />
    <input type="radio" name="camera" /> 360 Camera<br />
    <input type="radio" name="camera" /> Microphone<br /> </p>

    <b> Device Name: <input type="text" placeholder="Name" name="NAME" required> </b>

    <b> Device Code: <input type="text" placeholder="Device Code" name="CODE" required> </b>

    <button type="submit" class="btn">Submit</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Cancel</button>
  </form>
</div>

<script>
function addForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>

<img  background="images/venue.png" alt="venue"
    style="width:800px;height:450px;">

</body>
</html>
