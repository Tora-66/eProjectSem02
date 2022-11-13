<?php
session_start();

include_once 'php/DBConnect.php';
$pageTitle = 'Admin';



include 'php/htmlHead.php';
include 'php/sidebar.php';
?>


<?php
include 'php/htmlBody.php';
mysqli_close($conn);
?>