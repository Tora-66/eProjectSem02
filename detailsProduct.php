<!DOCTYPE html>
<?php
#1.Connect DB
include_once'php/DBConnect.php';

#2. take data from database where id
$code = $_GET["id"];
$query = "SELECT * FROM tbproduct WHERE ProductID = '{$code}'";
$rs = mysqli_query($conn, $query);
$data= mysqli_fetch_array($rs);

$queryBrand = "SELECT `BrandID`, `BrandName` FROM tbBrand;";
$rsBrand = mysqli_query($conn, $queryBrand);
$countBrand = mysqli_num_rows($rsBrand);
$brand = array();
for ($i = 0; $i < $countBrand; $i++) {
    $rcBrand = mysqli_fetch_array($rsBrand);
    array_push($brand, $rcBrand);
}

$queryType = "SELECT `TypeID`, `TypeName` FROM tbType;";
$rsType = mysqli_query($conn, $queryType);
$countType = mysqli_num_rows($rsType);
$type = array();
for ($i = 0; $i < $countType; $i++) {
    $rcType = mysqli_fetch_array($rsType);
    array_push($type, $rcType);
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
    <title>Document</title>
</head>
<body>
<caption><h2><?= $data[1]?> Detials</h2></caption>
    <table class="table table-hove table-bordered"" width="50%">
            
        <tr>
            <td rowspan="2"><img src="./<?= $data[4]?>" alt="Image" width="150px" height="100px"></td>
            <td>Brand ID: </td>
            <td><?= $data[0]?> </td>
        </tr>
        <tr>
            <td>name:</td>
            <td><?= $data[1]?></td>
        </tr>
        <tr>
            <td>Thumbnail</td>
            <td>Brand</td>
            <td>Type</td>
        </tr>
        <tr>
            <td><img src="./<?= $data[4]?>" alt="Image" idth="40" height="30"></td>
            <td>
                <?php
                    for ($z = 0; $z < count($brand); $z++) {
                            if ($data[5] == $brand[$z][0]) {
                                echo $brand[$z][1];
                        }
                    }
                ?>
            </td>
            <td>
                <?php
                    for ($z = 0; $z < count($type); $z++) {
                        if ($data[6] == $type[$z][0]) {
                            echo $type[$z][1];
                        }
                    }
                ?>
            </td>
        </tr>

        <tr>
            <td colspan="3">description:</td>
        </tr>
        <tr>
            <td colspan="3" ><?=$data[7]?></td>
        </tr>
        <tr>
            <td align="center" colspan="3">
            <a href="product.php">Back to product list</a>||
            <a href="editProduct.php?id=<?= $data[0]?>">Update</a>
            </td>
        </tr>
    </Table>


</body>
</html>