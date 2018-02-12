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
		<h2 align="center"> Inventory Reporting </h2>
		<div class = "search" align="center">
			<form  action="InventoryReporting.php" method="post">
				<input type="text" name="ProductName"  placeholder="Product.."/>
				<input type="text" name="Category"  placeholder="Category.."/>
				<input type="number" name="UnitsInStock"  placeholder="Units In Stock.."/>
				<input type="number" name="MinPrice"  placeholder="MinPrice.."/>
				<input type="number" name="MaxPrice"  placeholder="MaxPrice.."/>
				<input type="submit" name="report" value="Search"/>
				<br/><br/>
			</form>
		<?php
		$output = NULL;	
		$ProductName = "";
		$Category = "";
		$UnitsInStock = 0;
		$MinPrice = 0;
		$MaxPrice = 999999999999;
		
		if (isset($_POST['report'])){
			if ($_POST['ProductName'] != NULL){
				$ProductName = $_POST['ProductName'];
			}
			if ($_POST['Category'] != NULL){
				$Category = $_POST['Category'];
			}
			if ($_POST['UnitsInStock'] > 0){
				$UnitsInStock = $_POST['UnitsInStock'];
			}
			if ($_POST['MinPrice'] > 0){ 
				$MinPrice = $_POST['MinPrice'];
			}
			if ($_POST['MaxPrice'] < 999999999999){
				$MaxPrice = $_POST['MaxPrice'];
			}
			$mysqli = new MySQLi("localhost", "root", "", "northwind");
			$resultSet = $mysqli->query("SELECT * FROM alphabeticallistofproducts 
				WHERE ProductName LIKE '%$ProductName%'
				AND CategoryName LIKE '%$Category%'
				AND UnitsInStock > '$UnitsInStock'
				AND UnitPrice >= '$MinPrice'
				AND UnitPrice <= '$MaxPrice'
				");
			if($resultSet->num_rows > 0){
				while($rows = $resultSet->fetch_assoc()){
					$ProductID = $rows['ProductID'];
					$ProductName = $rows['ProductName'];
					$Supplier = $rows['Supplier'];
					$CategoryId =$rows['CategoryID'];
					$QuantityPerUnit = $rows['QuantityPerUnit'];
					$UnitPrice = $rows['UnitPrice'];
					$UnitsInStock = $rows['UnitsInStock'];
					$UnitsOnOrder = $rows['UnitsOnOrder'];
					$ReorderLevel = $rows['ReorderLevel'];
					$Discontinued = $rows['Discontinued'];
					$CategoryName = $rows['CategoryName'];
					$output .= "ProductID: $ProductID<br />
								ProductName: $ProductName<br/>
								Supplier: $Supplier<br />
								Category: $CategoryId<br />
								Quantity Per Unit: $QuantityPerUnit<br />
								Unit Price: $UnitPrice<br />
								Units in Stock: $UnitsInStock<br />
								Units on Order: $UnitsOnOrder<br />
								Reorder Level: $ReorderLevel<br />
								Discontinued: $Discontinued<br />
								Category Name: $CategoryName<br />
								<br/>";
				}
			}
			else{
				$output = "No Results";
			}	
			
		}

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
