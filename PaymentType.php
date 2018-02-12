<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="style.css?<?php echo time(); ?>" />

<body>
	<div id="Welcome" align="center">
	<?php	
		if (isset($_COOKIE['User'])){
			$Username = $_COOKIE['User'];
			echo "Welcome " . $Username;
		}
		else{echo "You are currently not logged in!";}
		if (isset($_COOKIE['ID'])){
			$myID = $_COOKIE['ID'];
			echo "<br />Your ID: " . $myID;
		}
		else{$myID = NULL;}
	?>
	</div>
		
		<h1 align="center">  Customer Dashboard </h1>
		<table align="center" width="800" height="10">
			<tr>
				<th><a href="EditProfile.php"> Edit Profile </a> </th>
				<th><a href="ShoppingCart.php"> Shopping Cart </a> </th> 
			</tr>
		</table>
		<h2 align="center"> Edit Your Payment Methods </h2>
	<div class = "search" align="center">
			<form  action="PaymentType.php" method="post">
				<input type="hidden" name="CustomerID" value="$myID" />
				Payment Type ID: <input type="number" name="PaymentTypeID" />	
				Account Number: <input type="number" name="AccountNumber" />
				<input type="submit" name="ChangePayment" value="Submit"/>
			</form>
			
		<h4 align="center"> Below are the currently accepted Payment Methods </h4>
	<?php
	$output = NULL;
		$mysqli = new MySQLi("localhost", "root", "", "northwind");
		$resultSet = $mysqli->query("SELECT * FROM paymenttype");
			if($resultSet->num_rows > 0){
				while($rows = $resultSet->fetch_assoc()){
					$PaymentTypeID = $rows['PaymentTypeID'];
					$Name = $rows['Name'];
					$output .= "PaymentTypeID: $PaymentTypeID<br />
								Name of Payment: $Name<br /><br/>
								";
				}
			}
			else{
				$output = "No Results";
			}

		if(isset($_POST['ChangePayment'])){
			$PaymentTypeID=$_POST['PaymentTypeID'];
			$AccountNumber=$_POST['AccountNumber'];
			$resultSet = $mysqli->query("SELECT * FROM paymentdefault WHERE CustomerID = '".$myID."' ");
			if($resultSet->num_rows > 0){
				$resultSet = $mysqli->query("UPDATE paymentdefault SET PaymentTypeID='".$PaymentTypeID."',
				AccountNumber='".$AccountNumber."'
				WHERE CustomerID = '".$myID."' ");
			}
			else{$resultSet = $mysqli->query("INSERT INTO paymentdefault(CustomerID, PaymentTypeID, accountNumber)
			VALUES ('$myID', '$PaymentTypeID', '$AccountNumber')");}
		}
	echo $output;
	?>
	<h4 align="center"> Your Current Payment Method: </h4>
	<?php
	$resultSet = $mysqli->query("SELECT * FROM paymentdefault WHERE CustomerID = '".$myID."'");
			if($resultSet->num_rows > 0){
				while($rows = $resultSet->fetch_assoc()){
					$PaymentTypeID = $rows['PaymentTypeID'];
					$AccountNumber = $rows['AccountNumber'];
					echo "PaymentTypeID: $PaymentTypeID<br />
								AccountNumber: $AccountNumber<br /><br/>
								";
				}
			}
			else{echo "You have yet to set up a payment method!";}
	
	?>
	</div>
		
<div id="sidemenu">
	<ul>
		<li><a href="Index.php"Link 1 </a>Home</li>
		<li><a href="SearchProducts.php"Link 2 </a>Search Products</li>
		<li><a href="OrderProducts.php"Link 3 </a>Order Products</li>
		<li><a href="PaymentType.php"Link 4 </a>Edit Payment Types</li>
		<li><a href="PendingCompletedOrders.php"Link 5 </a>Pending/Completed Orders</li>
		<li><?php if (isset($_COOKIE['User'])){
			echo "<a href=Logout.php> Login/Logout </a> "; 
		}else {echo "<a href=Login.php> Login/Logout </a> ";} ?> </li>
	</ul>
</div>
	
	
	

</body>
</html>