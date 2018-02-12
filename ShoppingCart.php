<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="style.css?version1">

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
			echo "<br/>Your ID: " . $myID;
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
		<h2 align="center"> Your Shopping Cart </h2>
		
	<div class="ShoppingCart" align = "center">
		
		<?php
		echo "<h4><br/>Your Recently Placed Order:</h4>";
		$output = NULL;
			if(isset($_POST['order'])){
				$Purchased = $_POST['item'];
				$Quantity = $_POST['quantity'];
				
				$mysqli = new MySQLi("localhost", "root", "", "northwind");
					$resultSet = $mysqli->query("SELECT * FROM products WHERE ProductName = '$Purchased'");
					if($resultSet->num_rows > 0){
						while($rows = $resultSet->fetch_assoc()){
							$ProductName = $rows['ProductName'];
							$ProductID	= $rows['ProductID'];
							$UnitPrice = $rows['UnitPrice'];
							$TotalPrice =  $Quantity*($rows['UnitPrice']);
							$TimeStamp = time();
							echo $TimeStamp;
							$result = $mysqli->query("INSERT INTO orderdetails(ProductID, UnitPrice, Quantity, CustomerID, TimeOrdered)
													VALUES ('$ProductID', '$UnitPrice', '$Quantity', '$myID', '$TimeStamp')");
							$query = $mysqli->query("SELECT * FROM orderdetails WHERE CustomerID = '$myID' AND Completed = 'No'");
							if($query->num_rows > 0){
								while($rows = $query->fetch_assoc()){
													
									$OrderID = $rows['OrderID'];
									$ProductID = $rows['ProductID'];
									$UnitPrice = $rows['UnitPrice'];
									$Quantity = $rows['Quantity'];
									$CustomerID = $rows['CustomerID'];
									$TotalPrice = $UnitPrice * $Quantity;
									$output .= "Product: $ProductName<br />
												Quantity: $Quantity<br/>
												Total Price: $TotalPrice<br/>" .
												//Also output a form to complete the order
												"<form align = 'center' action='CompleteOrder.php' method='get'> 
													<input type='hidden' name='CustomerID' value = '$CustomerID'/>
													<input type='hidden' name='OrderID' value = '$OrderID'/>
													<input type='hidden' name='ProductID' value = '$ProductID'/>
													<input type='hidden' name='UnitPrice' value = '$UnitPrice'/>
													<input type='hidden' name='Quantity' value = '$Quantity'/>
													<input type='hidden' name='TotalPrice' value = '$TotalPrice'/>
													<input type='submit'/>
												</form>";
								}
							}
						}
					}
					else {echo "No results found for '$Purchased'";}
					
			}
			else {echo "No Orders to Display";}
			
			
		?>
		<?php echo "$output<br/><br/>"; ?>
		
		<?php
			echo "<h4>Your previous orders pending completion:</h4>";
			$output = NULL;
			
			$mysqli = new MySQLi("localhost", "root", "", "northwind");
				$query = $mysqli->query("SELECT * FROM orderdetails WHERE CustomerID = '$myID' AND Completed = 'No'");
				if($query->num_rows > 0){
					while($rows = $query->fetch_assoc()){
						
						$OrderID = $rows['OrderID'];
						$ProductID = $rows['ProductID'];
						$UnitPrice = $rows['UnitPrice'];
						$Quantity = $rows['Quantity'];
						$CustomerID = $rows['CustomerID'];
						$TotalPrice = $UnitPrice * $Quantity;
						$output .= "Customer ID: $CustomerID<br />
									Order ID: $OrderID<br />
									Product ID: $ProductID<br />
									Unit Price: $UnitPrice<br />
									Quantity: $Quantity<br />
									Total Price: $TotalPrice<br />" .
									//Also output a form to complete the order
									"<form align = 'center' action='CompleteOrder.php?CustomerID=$CustomerID' method='get'>
										<input type='hidden' name='CustomerID' value = '$CustomerID'/>
										<input type='hidden' name='OrderID' value = '$OrderID'/>
										<input type='hidden' name='ProductID' value = '$ProductID'/>
										<input type='hidden' name='UnitPrice' value = '$UnitPrice'/>
										<input type='hidden' name='Quantity' value = '$Quantity'/>
										<input type='hidden' name='TotalPrice' value = '$TotalPrice'/>
										<input type='submit'/>
										</form><br/>";
					
					}
				}
				else{
					$output = "No Orders to Display";
				}		
			?>
		<?php echo "$output<br/><br/>"; ?>
		
		
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