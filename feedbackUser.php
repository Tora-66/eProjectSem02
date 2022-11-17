<?php
include_once 'php/DBConnect.php';
session_start();

$pageTitle = "Contact Us";

$queryId = "SELECT `UserID`  FROM tbUser_Account WHERE UserName = '{$_SESSION["username"]}'";
$rsId = mysqli_query($conn, $queryId);
$rc = mysqli_fetch_array($rsId);
$userID = $rc[0];

//Lay du lieu TbUser_Acount
$tbuser_accont = "SELECT * FROM tbuser_account WHERE UserID ='{$userID}'";
$rs = mysqli_query($conn, $tbuser_accont);
$data = mysqli_fetch_array($rs);

//Lay du lieu tbFeedBack
$tbfeedback = "SELECT * FROM tbfeedback";
$rs2 = mysqli_query($conn, $tbfeedback);
$data2 = mysqli_fetch_array($rs2);

//Sever
if (isset($_POST["txtSubmit"])) :
    $Content = htmlspecialchars($_POST["txtContent"]);

    $query = "INSERT INTO tbfeedback (`UserID` ,`Content`, `Date`) VALUES ('{$userID}','{$Content}',now());";
    $rs3 = mysqli_query($conn, $query);

    if (!$rs2) :
        die('nothing to save');
    endif;
    header("location: home.php");
endif;
include 'php/htmlHead.php';
include 'php/navigationBar.php';

?>
<section class="container section-margin">
    <form method="post" enctype="multipart/form-data">
        <h2>Input FeedBack</h2>
        <table class="table table-hove table-bordered">
            <tr>
                <td>Name:</td>
                <td>
                    <div class="form-floating">
                        <input type="text" class="form-control is-invalid" id="floatingInputInvalid" placeholder="Phone Number" name="txtName" value="<?= $data[1] ?>" readonly>
                        <label for="floatingInputInvalid">User Name</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Phone:</td>
                <td>
                    <div class="form-floating">
                        <input type="tel" class="form-control is-invalid" id="floatingInputInvalid" placeholder="Phone" name="txtPhone" value="<?= $data[5] ?>" readonly>
                        <label for="floatingInputInvalid">Phone Number</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Mail:</td>
                <td>
                    <div class="form-floating">
                        <input type="email" class="form-control is-invalid" id="floatingInputInvalid" placeholder="name@example.com" name="txtEmail" value="<?= $data[4] ?>" readonly>
                        <label for="floatingInputInvalid">Email</label>
                    </div>
                </td>
            </tr>

            <tr>
                <td>FeedBack:</td>
                <td>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="txtContent" rows="10" cols="30" maxlength="1000" required ></textarea>
                        <label for="floatingTextarea">Comments</label>
                    </div>
                </td>
            </tr>

            <tr>
                <td></td>
                <td> <input type="submit" name="txtSubmit" value="Send"></td>
            </tr>

        </table>
    </form>
</section>

<?php
include 'php/footer.php';
include 'php/htmlBody.php';
?>