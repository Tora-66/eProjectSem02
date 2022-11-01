<?php
include_once 'DBConnect.php';
if (isset($_POST["btnAdd"])) :
    $code = $_POST["txtBrandId"];
    $name = $_POST["txtName"];
    $desc = $_POST["txtDesc"];
    if (isset($_FILES['txtPath'])) :
        $folder = "img/brand_";
        $fileName = $_FILES["txtPath"]["name"];
        $fileTmp = $_FILES["txtPath"]["tmp_name"];
        $path = $folder . $fileName;
        move_uploaded_file($fileTmp, $path);
    endif;
    $query = "insert into tbbrand values('{$code}','{$name}','{$path}','(desc)')";
    $rs = mysqli_query($conn, $query);
    if (!$rs) :
        die('nothing to save');
    endif;
    header("location:brand.php");
endif;

include 'php/htmlHead.php';
include 'sidebar.php';
?>

<section class="mx-5" style="margin-top: 8rem;">
    <form method="post" enctype="multipart/form-data">
        <caption>
            <h3>Add Brand</h3>
        </caption>
        <table width="50%">
            <tr>
                <td>Brand ID: </td>
                <td><input name="txtBrandId" placeholder="Enter Brand Code"></td>
            </tr>
            <tr>
                <td>Brand Name</td>
                <td><input name="txtName" placeholder="Enter Brand Name"></td>
            </tr>
            <tr>
                <td>Logo: </td>
                <td>
                    <input type="file" name="txtPath">
                </td>
            </tr>
            <tr>
                <td>Brand description: </td>
                <td><textarea name="txtDesc" id="description" cols="30" rows="5"></textarea></td>
            </tr>
            <tr>
                <td>
                    <div class="container m-0 my-3 p-0">
                        <button class="btn btn-dark"><a href="brand.php" class="text-decoration-none text-white">Back</a></button>
                    </div>
                </td>
                <td>
                    <input type="submit" value="Add New" name="btnAdd">
                </td>
            </tr>
        </table>
    </form>
</section>
<?php
include 'php/htmlBody.php';
?>