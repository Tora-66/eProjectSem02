<?php
//Ket noi du lieu
include_once 'php/DBConnect.php';
session_start();

$pageTitle = "News Details";
//Detials 
$id = $_GET["id"];
$query = "SELECT * FROM tbnews WHERE NewsID = '{$id}'";
$rs = mysqli_query($conn, $query);
$news = mysqli_fetch_array($rs);


include 'php/htmlHead.php';
include 'php/sidebar.php';
?>
<section class="container section-margin">
    <form method="post" enctype="multipart/form-data">
        <table class="table">
            <tr>
                <td>Title:</td>
                <td><input name="txtTitle" value="<?= $news[1] ?>" readonly></td>
            </tr>

            <tr>
                <td>Content:</td>
                <td><input name="txtContent" value="<?= $news[2] ?>" readonly></td>
            </tr>

            <tr>
                <td>Image</td>
                <td style="text-align:center"><img src="<?= $news[3] ?>" alt="Image" width="50" height="50" readonly></td>
            </tr>

            <tr>
                <td>Date Time:</td>
                <td><input type="text" name="" value="<?= $news[4] ?>" readonly></td>
            </tr>

            <tr>
                <td></td>
                <td><a href="ViewsNews.php" class="btn btn-warning">Back</a></td>

            </tr>
        </table>
    </form>
</section>

<?php
include 'php/htmlBody.php';
mysqli_close($conn);
?>