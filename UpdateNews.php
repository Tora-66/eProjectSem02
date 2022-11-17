<?php
include_once 'php/DBConnect.php';
session_start();

$pageTitle = "Update News";

#2. Truy cập dữ liệu v
$id = $_GET["id"];
$sql = "SELECT * FROM `tbnews` WHERE NewsID ='{$id}' ";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($result);

#3. Updata data to database
if (isset($_POST["txtSubmit"])) :
    $title = $_POST["txtTitle"];
    $content = $_POST["txtContent"];

    if (isset($_FILES['txtImage'])) :
        $folder = "img/news_";
        $fileName = $_FILES["txtImage"]["name"];
        $fileTmp = $_FILES["txtImage"]["tmp_name"];
        $path = $folder . $fileName;
        move_uploaded_file($fileTmp, $path);
    endif;

    //Update image
    if ($path !== "img/news_") {
        $query2 = "UPDATE `tbnews` SET `Title`='$title', `Content`='$content', `Image`='$path', `NewsDate` = NOW() WHERE `tbnews`.`NewsID` ='{$id}';";
        $rs = mysqli_query($conn, $query2);
    } else {
        $query3 = "UPDATE `tbnews` SET `Title`='$title', `Content`='$content', `NewsDate` = NOW() WHERE `tbnews`.`NewsID` =' {$id} ';";
        $rs3 = mysqli_query($conn, $query3);
    }

    if (!$result) :
        error_clear_last();
        die("Update Fails");
    endif;
    header("Location: ViewsNews.php");
endif;


include 'php/htmlHead.php';
include 'php/sidebar.php';
?>
<form method="post" enctype="multipart/form-data">
    <table class="table">
        <tr>
            <td>Title:</td>
            <td><input name="txtTitle" value="<?= $data[1] ?>"></td>
        </tr>

        <tr>
            <td>Content:</td>
            <td>
                <div class="form-floating">
                    <!-- <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="txtContent" rows="10" cols="30" ></textarea> -->
                    <input type="text" name="txtContent" value="<?= $data[2]?>" id="floatingTextarea">
                </input>
            </td>
        </tr>

        <tr>
            <td>Image</td>
            <td><input type="file" name="txtImage" value="<?= $data[3] ?>"><img src="<?= $data[3] ?>" alt="Image" width="40" height="30" aria-readonly=""></td>
        </tr>

        <tr>
            <td>Date Time:</td>
            <td><input type="text" name="" value="<?= $data[4]?>" readonly></td>
        </tr>

        <tr>
            <td><a href="ViewsNews.php" class="btn btn-warning">Back</a></td>
            <td><button type="submit" name="txtSubmit" value="save" class="btn btn-success">Update News</button></td>

        </tr>
    </table>
</form>

<?php
    include 'php/htmlBody.php';
        mysqli_close($conn);
?>