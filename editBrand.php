<?php
include_once 'php/DBConnect.php';
session_start();

$pageTitle = "Update Brand";

$code = $_GET["code"];
$query1 = "SELECT * FROM tbbrand WHERE BrandID = '{$code}'";
$rs = mysqli_query($conn, $query1);
$data = mysqli_fetch_array($rs);

#3. Updata data to database
if (isset($_POST["btnSave"])) :
    $name = $_POST["txtName"];
    $desc = $_POST["txtDesc"];
    if (isset($_FILES['txtPath'])) :
        $folder = "img/brand_";
        $fileName = $_FILES["txtPath"]["name"];
        $fileTmp = $_FILES["txtPath"]["tmp_name"];
        $path = $folder . $fileName;
        move_uploaded_file($fileTmp, $path);
    endif;

    if ($path !== "img/brand_") {
        $query2 = "UPDATE tbbrand SET BrandName ='{$name}',Logo ='{$path}',`Desc`='{$desc}' WHERE `tbbrand`.`BrandID` = '{$code}' ";
        $rs = mysqli_query($conn, $query2);
    } else {
        $query3 = "UPDATE tbbrand SET BrandName ='{$name}',`Desc`='{$desc}' WHERE `tbbrand`.`BrandID` = '{$code}' ";
        $rs3 = mysqli_query($conn, $query3);
    }

    if (!$rs) :
        error_clear_last();
        die("Update Fails");
    endif;
    header("Location: brand.php");
endif;
mysqli_close($conn);

include 'php/htmlHead.php';
include 'php/sidebar.php';
?>

<form method="post" enctype="multipart/form-data">
    <caption>
        <h3>Update brand information Form</h3>
    </caption>
    <table width="50%" class="table table-borderless">
        <tr>
            <td>Brand ID: </td>
            <td><input name="txtBrandId" value="<?= $data[0] ?>" readonly></td>
        </tr>
        <tr>
            <td>Brand Name</td>
            <td><input name="txtName" value="<?= $data[1] ?>"></td>
        </tr>
        <tr>
            <td>Logo: </td>
            <td>
                <input type="file" name="txtPath" value="<?= $data[2] ?>">
            </td>
        </tr>
        <tr>
            <td>Brand description: </td>
            <td><textarea name="txtDesc" id="description" cols="30" rows="5"><?= $data[3] ?></textarea></td>
        </tr>
        <tr>
            <td><a href="brand.php">Back to Brand list</a></td>
            <td><input type="submit" name="btnSave" value="Save" onclick="return confirm('Are you sure to update <?= $data[1] ?>')"></td>

        </tr>
    </table>
</form>
<?php
include 'php/htmlBody.php';
?>