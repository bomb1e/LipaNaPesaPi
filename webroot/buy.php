<html>
<head> <title>Syokinet| Payment Portal</title> </head>
	<body>
	</body>
</html>
<?php
set_include_path("/include:" .get_include_path());
require_once("/include/PLUSPEOPLE/autoload.php");
//require_once("hotspot.php");

$pesa = new PLUSPEOPLE\PesaPi\PesaPi();
$receipt = new PLUSPEOPLE\PesaPi\PesaPi();

if (isset($_POST["receipt"])) {
	$transactions = $pesa->locatedByReceipt($_POST["1234"]);
		if (count($transactions)>0) {
?>

<html>
	<head></head>
	<body>
		<p> Payment Recieved. Congratulations! </p>
	</body>
</html>

<?php	
	} else {
?>

<html>
	<head></head>
	<body>
		<p> Sorry we have not received your payment - please enter the code again </p><br>
		<!-- <form method="POST"	action="buy.php">
			<input type="text" name="$receipt" value=""><br>
			<input type= submit id="confirmation" value="confirmation">
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
			<script src="js/global.js"></script>
		</form> -->
	</body>
</html>

<?php
	}
}
else {
?>

<html>
	<head></head>
	<body>
		<form method="POST"	action="buy.php">
			<input type = "text" name = "receipt" value = ""> <br>
			<input type = "submit" id = "confirmation" value = "confirmation">
		</form>
	</body>
</html>

<?php
}
?>