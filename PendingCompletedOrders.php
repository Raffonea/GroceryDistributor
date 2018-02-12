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
		<h2 align="center"> Welcome to the Customer Dashboard </h2>

	<div id="submittedOrders">
		<h2> Orders on the Way </h2>
		<?php
		$output = NULL;
		
		$mysqli = new MySQLi("localhost", "root", "", "northwind");
			$resultSet = $mysqli->query("SELECT * FROM orderdetails WHERE CustomerID = '$myID' AND Completed = 'Yes' AND Delivered = 'No'");
			if($resultSet->num_rows > 0){
				while($rows = $resultSet->fetch_assoc()){
					
					$OrderID = $rows['OrderID'];
					$ProductID = $rows['ProductID'];
					$UnitPrice = $rows['UnitPrice'];
					$Quantity = $rows['Quantity'];
					$CustomerID = $rows['CustomerID'];
					$TotalPrice = $UnitPrice*$Quantity;
					$TimeOrdered = $rows['TimeOrdered'];
					$output .= "OrderID: $OrderID<br/>
								Customer ID: $CustomerID<br />
								Product ID: $ProductID<br />
								Quantity: $Quantity<br />
								Total Price: $TotalPrice<br />
								TimeOrdered: $TimeOrdered<br /><br/>";
				}
			}
			else{
				$output = "No Results";
			}			
		?>
	<?php echo "$output"; ?>
	</div>
	
	<div id="completedOrders">
		<h2> Recently Delivered Orders </h2>
		<?php
		$output = NULL;
		
		$mysqli = new MySQLi("localhost", "root", "", "northwind");
			$resultSet = $mysqli->query("SELECT * FROM orderdetails WHERE CustomerID = '$myID' AND Completed = 'Yes' AND Delivered = 'Yes'");
			if($resultSet->num_rows > 0){
				while($rows = $resultSet->fetch_assoc()){
					
					$OrderID = $rows['OrderID'];
					$ProductID = $rows['ProductID'];
					$UnitPrice = $rows['UnitPrice'];
					$Quantity = $rows['Quantity'];
					$CustomerID = $rows['CustomerID'];
					$TimeOrdered = $rows['TimeOrdered'];
					$output .= "Customer ID: $CustomerID<br />
								Product ID: $ProductID<br />
								Unit Price: $UnitPrice<br />
								Quantity: $Quantity<br />
								CustomerID: $CustomerID<br />
								TimeOrdered: $TimeOrdered<br /><br/>
								";
					
				}
			}
			else{
				$output = "No Results";
			}			
		?>
	<?php echo "$output" ?>
	
	<?php
		$CurrentTime = time();
		$mysqli = new MySQLi("localhost", "root", "", "northwind");
		//for testing purposes, it it assumed orders are delivered 30 seconds after ordering
		$query = $mysqli->query("UPDATE orderdetails SET Delivered = 'Yes' WHERE (TimeOrdered+30) < '".$CurrentTime."'");
			
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
