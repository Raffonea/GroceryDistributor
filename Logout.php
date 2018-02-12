<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="style.css?version1">

<body>
	
	<h1 align="center">  Customer Dashboard </h1>
	<h2 align="center"> You have Successfully been Logged out </h2>
	
	<?php
		setcookie("User", "", time() - 3600);
		setcookie("ID", "", time() - 3600);
	?>

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
