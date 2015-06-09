<?php
session_start();
//This page is here for the user to input an Mpesa receipt number
//This number will be used to confirm whether he has carried out an Mpesa transaction 
//and that indeed the Mpesa transaction amount conforms with the package chosen
$path = 'F:\Dropbox\Projects\LipaNaPesaPi\pesaPi\php\include';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once("F:\Dropbox\Projects\LipaNaPesaPi\pesaPi\php\include\PLUSPEOPLE\autoload.php");
//require_once("hotspot.php");
$pesa = new PLUSPEOPLE\PesaPi\PesaPi();

//retrieve the package chosen from the hostpot.php page
	
if (isset($_POST["package"])) {
	//SET SESSION VARIABLES
	$_SESSION["package"] = $_POST["package"];
	// $_SESSION["name"] = "name";
	// $_SESSION["email"] = "email";
	// $_SESSION["phone"] = "phone";
}
//draw the receipt input box
?>
<html>
	<body>
		<form method="POST"	action="buy2.php">
			<input type="text" name="receipt" value=""><br>
			<input type= submit id="confirmation" value="Confirm">
		</form>
	</body>
</html>
<?php
//check whether the receipt matches with database and conforms with the selected package
if (isset($_POST["receipt"])) {
	$transactions = $pesa->locateByReceipt($_POST["receipt"],"");
		if (count($transactions)>0) {
			//connect to ticket database & give username and password based on the chosen package
			$con = mysqli_connect('localhost','root','','');
			$con2 = mysqli_connect('localhost','root','','');
			//check connection
			if (mysqli_connect_errno()) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();	
				}

			//read receipt
			$package_receipt = mysqli_real_escape_string($con,$_POST['receipt']);
			//confirm that the package selected conforms with the amount received
			$package_query = "SELECT amount FROM pesapi_payment 
								WHERE pesapi_payment.receipt = '$package_receipt'";
			$result_amount = mysqli_query($con2,$package_query);
			$result_amount2 = mysqli_fetch_object($result_amount);

			//echo $result_amount2->amount;

				if ($_SESSION['package'] == ($result_amount2->amount)) {

				//retrieve username &password from tickets database
				$ticket_query = "SELECT ticketnumber from issue_ticket
									WHERE issue_ticket.issue = 0";
				$username = mysqli_fetch_object(mysqli_query($con,$ticket_query));
				$i=0;
				echo $_SESSION['package'];
				while ($i<=count($username)) {
					echo $username[$i];
					$i++;
				}
				//$num = mysqli_num_rows($username);
				//$ticket_number = mysqli_result($username,$num[1],"issue");
				$ticket_number = $username[0];
				//set ticket as used
				$set_used_query = "UPDATE issue_ticket SET issue_ticket.issue = 1 , issue_ticket.date_of_issue = CURRENT_TIMESTAMP
									WHERE ticketnumber = $ticket_number";
				$set_used = mysqli_query($con,$set_used_query);
				//give username and password if it does						
?>
				<html>
				<body> 
					<input id = "username" name = "username" value = "<?php echo "$ticket_number";
					// while($row = mysqli_fetch_array($username)) { echo $row['ticketnumber'];}
					?>"><br>
				</body>
				</html>
<?php
					}
			
			
				}
			}
//tell the user to confirm mpesa receipt if it doesn't
?>