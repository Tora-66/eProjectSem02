<!DOCTYPE html>
<?php
include_once 'DBConnect.php';

if (!isset($_GET["id"])) {
    header("Location: inventory.php");
}

$id = $_GET["id"];

$queryInventory = "SELECT * FROM `tbInventory` WHERE InventoryID = {$id};";
$rsInventory = mysqli_query($conn, $queryInventory);
$rcInventory = mysqli_fetch_array($rsInventory);

if (isset($_POST["btnAdd"])) {
    $quantity = $_POST["quantity"];

    $queryAdd = "UPDATE `tbInventory` SET `Quantity` = `Quantity` + {$quantity} WHERE InventoryID = {$id};";
    $rsAdd = mysqli_query($conn, $queryAdd);

    header("Location: inventory.php");
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Add Product</title>
</head>

<body>

    <div class="container">
        <form method="post" enctype="multipart/form-data">
            <caption>
                <h2>Add New Product</h2>
            </caption>
            <a href="product.php">Back to product list</a>
            <table width="50%" class="table table-borderless">
                <tr>
                    <td>Inventory ID:</td>
                    <td><input name="txtProId" placeholder="Enter ID: PPxx" value="<?= $rcInventory[0]; ?>" disabled></td>
                </tr>
                <tr>
                    <td>Product ID:</td>
                    <td><input name="txtName" placeholder="Enter Name" value="<?= $rcInventory[1]; ?>" disabled></td>
                </tr>
                <tr>
                    <td>Size:</td>
                    <td><input name="txtPrice" placeholder="Enter price" value="<?= $rcInventory[2]; ?>" disabled></td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td><input type="number" name="quantity"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="btnAdd"></td>
                </tr>
            </table>
        </form>
    </div>

    <?php
    mysqli_close($conn);
    ?>
</body>

</html>