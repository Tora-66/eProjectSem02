<!DOCTYPE html>
<?php
session_start();
include_once 'php/DBConnect.php';

$pageTitle = "Pheidip Shop";


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


include 'php/htmlHead.php';
include 'php/navigationBar.php';
include 'php/slider.php';
?>
<?php mysqli_close($conn);
include 'php/htmlBody.php';
?>