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
		<h2 align="center"> Order Completed! </h2>

	<div align = "center" class ="completeOrder">
	
	<?php
		$CustomerID = $_GET['CustomerID'];
		$OrderID = $_GET['OrderID'];
		$ProductID = $_GET['ProductID'];
		$UnitPrice = $_GET['UnitPrice'];
		$Quantity = $_GET['Quantity'];
		$TotalPrice = $_GET['TotalPrice'];
		
		echo "Customer ID: $CustomerID<br />
			Order ID: $OrderID<br />
			Product ID: $ProductID<br />
			Unit Price: $UnitPrice<br />
			Quantity: $Quantity<br />
			Total Price: $TotalPrice<br />";
			
		if(isset($_GET['OrderID'])){	
		$mysqli = new MySQLi("localhost", "root", "", "northwind");	
		$update = $mysqli->query("UPDATE orderdetails SET Completed = 'Yes' WHERE OrderID = '".$OrderID."'");
		}
		else{ echo "ERROR";}
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
