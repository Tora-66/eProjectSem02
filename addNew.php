<!DOCTYPE html>
<?php
include_once 'php/DBConnect.php';

if (isset($_POST["btnAdd"])) :
    $desc = $_POST["txtDesc"];
    $title = $_POST["txttitle"];
    if (isset($_FILES['txtPath'])) :
        $folder = "img/news_";
        //Kiem tra du lieu xem co hop le hay khong
        $fileName = $_FILES["txtPath"]["name"];
        $fileTmp = $_FILES["txtPath"]["tmp_name"];  //tmp_name: Đường đr0     ẫn của hình
        $path = $folder . $fileName;
        move_uploaded_file($fileTmp, $path);
    endif;
    $query = "INSERT INTO `tbNews`(`Title`, `Content`, `Image`, `NewsDate`) VALUES ('{$title}', \"{$desc}\" ,'{$path}', now());";
    $rs = mysqli_query($conn, $query);
    if (!$rs) :
        die('nothing to save');
    endif;
    header("location:ViewsNews.php");
endif;
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Add brands</title>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <caption>
            <h3>New brand infnormation Form</h3>
        </caption>
        <table width="50%">
            <tr>
                <td>Image: </td>
                <td>
                    <input type="file" name="txtPath">
                </td>
            </tr>
            <tr>
                <td>Title</td>
                <td><input type="text" name="txttitle"></td>
            </tr>
            <tr>
                <td>News: </td>
                <td><textarea name="txtDesc" id="description" cols="30" rows="10"></textarea></td>
            </tr>
            <tr>
                <td><a href="brand.php">Back to Brand list</a></td>
                <td>
                    <input type="submit" value="Add New" name="btnAdd">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>