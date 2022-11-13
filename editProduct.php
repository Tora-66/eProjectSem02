<?php
#1.Connect DB
include_once 'php/DBConnect.php';
session_start();

$pageTitle = "Update Product";

#2. take data from database where id
$code = $_GET["id"];
$query = "SELECT * FROM tbproduct WHERE ProductID = '{$code}';";
$rs = mysqli_query($conn, $query);
$data = mysqli_fetch_array($rs);

$query2 = "SELECT * FROM tbbrand;";
$rs2 = mysqli_query($conn, $query2);
$count2 = mysqli_num_rows($rs2);

$query3 = "SELECT * FROM tbtype;";
$rs3 = mysqli_query($conn, $query3);
$count3 = mysqli_num_rows($rs3);

//Save
if (isset($_POST["btnSave"])) :
    #1.Process Image Value
    $proId = $_POST["txtProId"];
    $name = $_POST["txtName"];
    $price = $_POST["txtPrice"];
    $brandId = $_POST["brand"];
    $typeId = $_POST["type"];
    $desc = $_POST["txtDesc"];

    //thumnail
    if (isset($_FILES['txtThumbnail'])) :
        $folder1 = "img/thumbnail_";
        $fileName1 = $_FILES["txtThumbnail"]["name"];
        $fileTmp1 = $_FILES["txtThumbnail"]["tmp_name"];
        $thumbnail = $folder1 . $fileName1;
        move_uploaded_file($fileTmp1, $thumbnail);
    endif;

    //image
    if (isset($_FILES['txtImage'])) :
        $folder2 = "img/image_";
        $fileName2 = $_FILES["txtImage"]["name"];
        $fileTmp2 = $_FILES["txtImage"]["tmp_name"];
        $image = $folder2 . $fileName2;
        move_uploaded_file($fileTmp2, $image);
    endif;

    //SQL
    if ($thumbnail !== "img/thumbnail_") {
        $query4 = "UPDATE tbproduct SET ProductName ='{$name}',Price ='{$price}',Thumbnail ='{$thumbnail}',`Desc`='{$desc}', `BrandID` = '{$brandId}', `TypeID` = '{$typeId}' WHERE `tbproduct`.`ProductID` = '{$code}' ";
        $rs4 = mysqli_query($conn, $query4);
    } else {
        $query5 = "UPDATE tbproduct SET ProductName ='{$name}',Price ='{$price}',`Desc`='{$desc}', `BrandID` = '{$brandId}', `TypeID` = '{$typeId}' WHERE `tbproduct`.`ProductID` = '{$code}' ";
        $rs5 = mysqli_query($conn, $query5);
    }

    if ($image !== "img/image_") {
        $query6 = "UPDATE tbproduct SET ProductName ='{$name}',Price ='{$price}',`Image`='{$image}',`Desc`='{$desc}', `BrandID` = '{$brandId}', `TypeID` = '{$typeId}' WHERE `tbproduct`.`ProductID` = '{$code}' ";
        $rs6 = mysqli_query($conn, $query6);
    } else {
        $query7 = "UPDATE tbproduct SET ProductName ='{$name}',Price ='{$price}',`Desc`='{$desc}', `BrandID` = '{$brandId}', `TypeID` = '{$typeId}' WHERE `tbproduct`.`ProductID` = '{$code}' ";
        $rs7 = mysqli_query($conn, $query7);
    }



    if (!$rs3) :
        die("Update Fails");
    endif;
    header("location: product.php");
endif;
mysqli_close($conn);

include 'php/htmlHead.php';
include 'php/sidebar.php';
?>
<div class="container">
    <form method="post" enctype="multipart/form-data">
        <caption>
            <h2>Update Product information form</h2>
        </caption>
        <a href="product.php">Back to product list</a>
        <table width="50%" class="table table-borderless">
            <tr>
                <td>Product ID: </td>
                <td><input name="txtProId" value="<?= $data[0] ?>" readonly></td>
            </tr>
            <tr>
                <td>Name: </td>
                <td><input name="txtName" value="<?= $data[1] ?>"></td>
            </tr>
            <tr>
                <td>Price : </td>
                <td>$ <input name="txtPrice" value="<?= $data[2] ?>"></td>
            </tr>
            <tr>
                <td>thumbnail: </td>
                <td><input type="file" name="txtThumbnail" value="<?= $data[3] ?>"></td>
            </tr>
            <tr>
                <td>Image: </td>
                <td><input type="file" name="txtImage" value="<?= $data[4] ?>"></td>
            </tr>
            <tr>
                <td>Brand: </td>
                <td><select name="brand" id="brands">
                        <?php while ($field1 = mysqli_fetch_array($rs2)) :
                            $selected = "";
                            if ($data[5] == $field1[0]) :
                                $selected = 'selected';
                            endif;
                        ?>

                            <option <?= $selected; ?> value="<?= $field1[0] ?>"><?= $field1[1] ?></option>

                        <?php
                        endwhile; ?>
                    </select></td>
            </tr>
            <tr>
                <td>Type: </td>
                <td><select name="type" id="type">
                        <?php while ($field2 = mysqli_fetch_array($rs3)) :
                        $selected = "";
                            if ($data[6] == $field2[0]) :
                                $selected = 'selected';
                            endif;
                        ?>

                            <option <?= $selected; ?> value="<?= $field2[0] ?>"><?= $field2[1] ?></option>

                        <?php
                        endwhile; ?>
                    </select></td>
            </tr>
            <tr>
                <td>description: </td>
                <td><textarea name="txtDesc" id="desc" cols="30" rows="10"><?= $data[7] ?></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="btnSave" value="Save" onclick="return confirm('Are you sure to update <?= $data[1] ?>''Are you sure to update <?= $data[1] ?>')"></td>
            </tr>
        </table>
    </form>
</div>

<?php
include 'php/htmlBody.php';
?>