<!DOCTYPE html>
<?php
include_once 'DBConnect.php';
if(isset($_POST["btnAdd"])):
    $code = substr(strtoupper($_POST["txtName"]),0,3).date('YmdHis');
    $name = ucwords($_POST["txtName"]);
    $desc = $_POST["txtDesc"];
    if(isset($_FILES['txtPath'])):
        $folder="img/brand_";
        $fileName= $_FILES["txtPath"]["name"];
        $fileTmp= $_FILES["txtPath"]["tmp_name"];
        $path=$folder.$fileName;
        move_uploaded_file($fileTmp, $path);
    endif;
    $query = "INSERT into tbbrand values('{$code}','{$name}','{$path}','{$desc}')";
    $rs =mysqli_query($conn,$query);
    if(!$rs):
        die('nothing to save');
    endif;
    header("location:brand.php");
endif;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/component.css" />
    <title>Add brands</title>
</head>
<body>
    
</body>
</html>

