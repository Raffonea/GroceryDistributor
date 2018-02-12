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
			echo "<br />Your ID: " . $myID;
		}
		else{$myID = NULL;}
		?>
		
		<h1 align="center">  Customer Dashboard </h1>
		<table align="center" width="800" height="10">
			<tr>
				<th><a href="EditProfile.php"> Edit Profile </a> </th>
				<th><a href="ShoppingCart.php"> Shopping Cart </a> </th> 
			</tr>
		</table>
		<h2 align="center"> Select Products to Order </h2>
				
		
		<div class = "Products" align = "center">
		<?php
		$output = NULL;	
		if (isset($_COOKIE['ID'])){
			
		echo "<form align = 'center' action='ShoppingCart.php' method='post'> 
				<input type='text' name='item'  placeholder='item...' required/>
				<input type='number' name='quantity'  placeholder='# of units...' required/>
				<input type='submit' name='order' value='Add to Cart'/>
			</form>";
			$mysqli = new MySQLi("localhost", "root", "", "northwind");
			$resultSet = $mysqli->query("SELECT * FROM productsbycategory");
			if($resultSet->num_rows > 0){
				while($rows = $resultSet->fetch_assoc()){
					$ProductName = $rows['ProductName'];
					$ProductID = $rows['ProductID'];
					$UnitPrice = $rows['UnitPrice'];
					$output .= "Product Name: $ProductName<br />
								Unit Price: $UnitPrice<br/>
								Product ID: $ProductID<br /><br/>
								";
				}
			}
			else{
				$output = "No Results";
			}				
		}
		else{$output = "Please Log in First before using this feature!";}

		?>
		<?php echo $output; ?>
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
		}else {echo "<a href=Login.php> Login/Logout </a> ";} ?></li>
	</ul>
	</div>

</body>
</html>
