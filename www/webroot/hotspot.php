<html>
	<head>
	<title> Welcome to Syokinet Prepaid Hotspot </title>
	</head>
	<style>
	.error {color: #FF0000;}
	</style>
	<body>
	<?php
	// define variables and set to empty values
	$nameErr = $emailErr = $packageErr = $phoneErr = "";
	$name = $email = $phone= "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if(empty($_POST["name"])){
			$nameErr = "Name is required";
		} else {
			$name = test_input($_POST["name"]);
  			
  		}
  	if(empty($_POST["email"])){
			$emailErr = "Email is required";
		} else {
			
  			$email = test_input($_POST["email"]);
  			
  		}
  	if(empty($_POST["phone"])){
			$phoneErr = "Phone is required";
		} else {
			
  			$phone = test_input($_POST["phone"]);
  		}	
  	if (empty($_POST["package"])) {
  			$packageErr = "Choose one package";
  		} else {
  			$package = test_input($_POST["package"]);
  		}
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>	
	<div div id="image" style="width:630px; margin:0 auto;">
	<img src="/webroot/editted logo.png" width= "200" height="122"/> 
	</div>
	<div div id="logo" style="width:630px; margin:0 auto;">
	<h1> Welcome to Syokinet Prepaid Hotspot</h1><br>
	<h2> Select package</h2><br>
	<form method= "post" action= "buy2.php">
	<span class="error">* required field.</span><br><br>
	</div>
	
	<div div id="content" style="background-color:#EEEEEE;width:630px;margin:0 auto;">
	Package:<br><br>
	<input type=radio name="package"  value="20000">Ksh 200 per day<br><br>
	<input type=radio name="package" value="100000">ksh 1000 per week<br><br>
	<input type=radio name="package" value="300000">ksh 3000 per month<br><br>
	Name:  <input type="text" name="name" >
			<span class="error">* <?php echo $nameErr;?></span><br><br>
	Email: <input type="text" name="email">
		<span class="error">* <?php echo $emailErr;?></span><br><br>
	Phone: <input type="text" name="phone">
			<span class="error">* <?php echo $phoneErr;?></span><br><br>
	<input type=submit name="Continue" value="Continue...">
	</form> 
	</div>
	
 
</html>
