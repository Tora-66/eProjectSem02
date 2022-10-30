<!DOCTYPE html>
<?php 
    include_once 'DBConnect.php';

    $code = $_GET["code"];
    $query1 = "SELECT * FROM tbbrand WHERE BrandID = '{$code}'";
    $rs = mysqli_query($conn, $query1);
    $data= mysqli_fetch_array($rs);

    #3. Updata data to database
    if(isset($_POST["btnSave"])):
        $name = $_POST["txtName"];
        $desc = $_POST["txtDesc"];
        if(isset($_FILES['txtPath'])):
            $folder="img/brand_";
            $fileName= $_FILES["txtPath"]["name"];
            $fileTmp= $_FILES["txtPath"]["tmp_name"];
            $path=$folder.$fileName;
            move_uploaded_file($fileTmp, $path);
        endif;

        $query2="UPDATE tbbrand SET BrandName ='{$name}',Logo ='{$path}',`Desc`='{$desc}' WHERE `tbbrand`.`BrandID` = '{$code}' ";
        $rs=mysqli_query($conn,$query2);
        if(!$rs):
            error_clear_last();
            die("Update Fails");
        endif;
        header("Location: brand.php");
    endif;
    mysqli_close($conn);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Update Brand</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <caption><h3>New brand ìnormation Form</h3></caption>
        <a href="brand.php">Back to brand list</a> 
        <table width="50%">
            <tr>
                <td>Brand ID: </td>
                <td><input name="txtBrandId" value="<?= $data[0]?>" readonly></td>
            </tr>
            <tr>
                <td>Brand Name</td>
                <td><input name="txtName" value="<?= $data[1]?>"></td>
            </tr>
            <tr>
                <td>Logo: </td>
                <td>
                    <input type="file" name="txtPath" value="<?= $data[2]?>">
                </td>
            </tr>
            <tr>
                <td>Brand description: </td>
                <td><textarea name="txtDesc" id="description" cols="30" rows="5"  value="<?= $data[4]?>"></textarea></td>
            </tr>
            <tr>
                <td><a href="brand.php">Back to Brand list</a></td>
                <td><input type="submit" name="btnSave" value="Save"
                onclick="return confirm('Are you sure to update <?= $data[1]?>')"></td>
            
            </tr>
        </table>
    </form>
</body>
</html>