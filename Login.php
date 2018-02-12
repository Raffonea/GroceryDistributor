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
		<div class="Login" align="center">
		<h2 align="center"> Please Enter Username and Password </h2>
		<form align = "center" action="login.php" method="post"> 
			<input type="text" name="username"  placeholder="Username" required/>
			<input type="password" name="password"  placeholder="Password" required/>
			<input type="submit" name="login" value="Login"/>
		</form>
		
		<?php
			if(isset($_POST['login'])){
				$Username = $_POST['username'];
				$Password =$_POST['password'];
				$Pass = NULL;
			
			$mysqli = new MySQLi("localhost", "root", "", "northwind");
			$query = $mysqli->query("SELECT * FROM customers WHERE Username = '$Username'");
			if($query->num_rows > 0){
			while($rows = $query->fetch_assoc()){
					$Pass = $rows['Password'];
					$id = $rows['CustomerID'];
				}
				if($Pass == $Password){
				echo "Login Successful";
		
				setcookie("User", $Username, time() + (86400 * 30), "/");
				setcookie("ID", $id, time() + (86400 * 30), "/");
			}
			else{echo "Incorrect Password";}
			}
			else{echo "Invalid Username";}
			
			
			}
		?>
		
		</div>
		
		
		<div class="NewCustomer" align="center" >
		<h2 align="center"> New Customer Registration </h2>
		<form align = "center" action="login.php" method="post"> 
			<input type="text" name="username"  placeholder="Username" required/>
				<br />	<br />
			<input type="password" name="password"  placeholder="Password" required/>
				<br />	<br />
			<input type="password" name="confirm"  placeholder="Confirm Password" required/>
				<br />	<br />
			<input type="text" name="CompanyName" placeholder="CompanyName" required/>
				<br />	<br />
			<input type="text" name="ContactName" placeholder="ContactName" />
				<br />	<br />
			 <input type="text" name="ContactTitle" placeholder="ContactTitle"/>
				<br />	<br />
			 <input type="text" name="Address" placeholder="Address"/>
				<br />	<br />
			 <input type="text" name="City" placeholder="City"/>
				<br />	<br />
			<input type="text" name="Region" placeholder="Region"/>
				<br />	<br />
			 <input type="text" name="PostalCode" placeholder="PostalCode"/>
				<br />	<br />
			 <input type="text" name="Country" placeholder="Country"/>
				<br />	<br />
			<input type="text" name="Phone" placeholder="Phone"/>
				<br />	<br />
			<input type="text" name= "Fax" placeholder="Fax"/>
				<br />	<br />
			<input type="submit" name="newCustomer" value="Create Account"/>
		</form>
		
		<?php
			$CompanyName = NULL;
			$ContactName = NULL;
			$ContactTitle = NULL;
			$Address = NULL;
			$City = NULL;
			$Region = NULL;
			$PostalCode = NULL;
			$Country = NULL;	
			$Phone = NULL;	
			$Fax = NULL;
			$Username = NULL;
			$Password = NULL;
			
		if(isset($_POST['newCustomer'])){
			$Username = $_POST['username'];
			$Password =$_POST['password'];
			$confirm = $_POST['confirm'];
			$CompanyName = $_POST['CompanyName'];	
			$ContactName = $_POST['ContactName'];	
			$ContactTitle = $_POST['ContactTitle'];	
			$Address = $_POST['Address'];	
			$City = $_POST['City'];	
			$Region = $_POST['Region'];	
			$PostalCode = $_POST['PostalCode'];	
			$Country = $_POST['Country'];	
			$Phone = $_POST['Phone'];	
			$Fax = $_POST['Fax'];
			
		$mysqli = new MySQLi("localhost", "root", "", "northwind");
		$query = $mysqli->query("SELECT Username FROM customers WHERE Username = '$Username'");
		
		if (($query->num_rows == 0) && ($Password == $confirm)){
			$result = $mysqli->query("INSERT INTO customers(Username, Password, CompanyName, ContactName, ContactTitle, Address, City, Region, PostalCode, Country, Phone, Fax)
							VALUES ('$Username', '$Password', '$CompanyName', '$ContactName', '$ContactTitle', '$Address', '$City', '$Region', '$PostalCode', '$Country', '$Phone', '$Fax')") or die (mysql_error());
					if ($result){echo "You Have Successfully Registered as '$Username'";}
					else {echo "Failed to create account'$Username' '$Password' '$Username'";}
				
			}
		else if ($query->num_rows > 0){echo "Username is taken";}
		else {echo "Passwords do not match";}
		mysqli_close($mysqli);
		}
		?>
		</div>
		
		
			

		

	
		
	<div id="sidemenu">
	<ul>
		<li><a href="Index.php" Link 1 </a>Home</li>
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
