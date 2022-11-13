<!DOCTYPE html>
<?php
include_once 'DBConnect.php';
session_start();

$code = $_GET["code"];
$query = "SELECT * FROM tbbrand where BrandID = '{$code}'";
$rs = mysqli_query($conn, $query);
$field = mysqli_fetch_array($rs);
$count = mysqli_num_rows($rs);
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Brand Details</title>
</head>

<body>
    <caption>
        <h2><?= $field[1] ?> Detials</h2>
    </caption>
    <table class="table table-hove table-bordered"" width=" 50%">

        <tr>
            <td rowspan="2"><img src="./<?= $field[2] ?>" alt="Image" width="100px" height="100px"></td>
            <td>Brand ID: </td>
            <td><?= $field[0] ?> </td>
        </tr>
        <tr>
            <td>name:</td>
            <td><?= $field[1] ?></td>
        </tr>
        <tr>
            <td colspan="3">description:</td>
        </tr>
        <tr>
            <td colspan="3"><?= $field[3] ?></td>
        </tr>
        <tr>
            <td align="center" colspan="3">
                <a href="brand.php">Back to brand list</a> ||
                <a href="editBrand.php?code=<?= $field[0] ?>">Update</a>
            </td>
        </tr>
    </Table>
</body>

</html>