<?php
session_start();

if (!isset($_GET["index"])) :
    header("Location: ../cart.php");
endif;

$index = $_GET["index"];

if(($key = array_search($_SESSION["prodID"][$index], $_SESSION["prodID"])) !== false) {
    unset($_SESSION["prodID"][$key]);
    unset($_SESSION["size"][$key]);
    unset($_SESSION["quantity"][$key]);
}

header("Location: ../cart.php");
