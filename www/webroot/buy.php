<html>
<head> <title>Syokinet| Payment Portal</title> </head>
	<body>
	</body>
</html>
<?php
$path = 'F:\Dropbox\Projects\LipaNaPesaPi\pesaPi\php\include';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once("F:\Dropbox\Projects\LipaNaPesaPi\pesaPi\php\include\PLUSPEOPLE\autoload.php");
//require_once("hotspot.php");

$pesa = new PLUSPEOPLE\PesaPi\PesaPi();
// $receipt = new PLUSPEOPLE\PesaPi\PesaPi();
if (isset($_POST["package"])) {
	echo "hapa ndipo tumefikishana";
	$package_amount = $_POST['package'];
	echo "$package_amount";

}

if (isset($_POST["receipt"])) {
	$transactions = $pesa->locateByReceipt($_POST["receipt"],"9876");
		if (count($transactions)>0) {
?>

<html>
	<head></head>
	<body>
		<p> Payment Recieved. Congratulations! </p>
	</body>
</html>
<?php
	//connect to ticket database & give username and password based on the chosen package
	$con = mysqli_connect('localhost','root','','');
	//check connection
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();	
		}
	//read selected package
		$package_receipt = mysqli_real_escape_string($con,$_POST['receipt']);
	//confirm that the package selected conforms with the amount received
		$package_query = "SELECT amount FROM pesapi_payment 
							WHERE pesapi_payment.receipt = '$package_receipt'";
		$result_amount = mysqli_query($con,$package_query);

		if ($package_amount == ($result_amount)) {
			//retrieve username &password from tickets database
			$ticket_query = "SELECT ticketnumber from issue_ticket
								WHERE issue_ticket.issue = 0";
			$username = mysqli_query($con,$ticket_query);
			//set ticket as used
			$set_used_query = "UPDATE issue_ticket SET issue_ticket.issue = 1 
								WHERE ticketnumber = $ticket_query";


			?>
			<html>
			<body> 
				<input id = "username" name = "username" value = "<?php echo "$username"?>"><br>
				<input id="password" name="password" value="<?php echo "$password"?>">
			</body>
			</html>
			<?php
		}
	//allocate username and password from the ticket database and mark used 

?>

<?php	
	} 
	else {
?>

<html>
	<head></head>
	<body>
		<p> Sorry we have not received your payment - please enter the code again </p><br>
		<form method="POST"	action="buy.php">
			<input type="text" name="receipt" value=""><br>
			<input type= submit id="confirmation" value="confirmation">
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
			<script src="js/global.js"></script>
		</form>
	</body>
</html>

<?php
	}
}
	elseif (!(($_POST))) {
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