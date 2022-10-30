<!DOCTYPE html>
<?php
session_start();
include_once 'DBConnect.php';


$showLogin = "";
$hideLogout = "";

if (isset($_SESSION["username"])) {
	$username = $_SESSION["username"];
	if (!isset($_SESSION["prodID"])) {
		$_SESSION["prodID"] = array();
		$_SESSION["size"] = array();
		$_SESSION["quantity"] = array();
	}


	$showLogin = "hidden";
} else {
	session_unset();
	session_write_close();

	$hideLogout = "hidden";
	// $url = "./index.php";
	// header("Location: $url");
}

$queryProduct = "SELECT * FROM `tbProduct`";
$rsProduct = mysqli_query($conn, $queryProduct);
$countProduct = mysqli_num_rows($rsProduct);


?>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Pheidip Shop</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
	<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css" />
	<link rel="stylesheet" href="css/main.css" type="text/css" />
</head>
<body>
	<?php 
	include 'navigationBar.php';
	include 'slider.php';
	?>
	<!-- <div class="container">
		<div class="page-header" <?= $hideLogout; ?>>
			<span class="login-signup"><a href="logout.php">Logout</a></span>
		</div>
		<div class="page-header" <?= $showLogin ?>>
			<span class="login-signup"><a href="login.php">Login</a></span>
		</div>
		<div class="page-header">
			<span class="login-signup"><a href="productDetails">Shop</a></span>
		</div>
		<div class="page-content">Welcome</div>
	</div> -->
	

	<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
	<!-- <script src="js/main.js"></script> -->
	<?php mysqli_close($conn); ?>
</body>

</html>