<?php
include_once 'php/DBConnect.php';
session_start();

$pageTitle = "Contact Us";

if (isset($_POST["txtSubmit"])) :
    $name = $_POST["txtName"];
    $email = $_POST["txtEmail"];
    $phone = $_POST["txtPhone"];
    $Content = htmlspecialchars($_POST["txtContent"]);

    $tbguest = "INSERT INTO `tbGuest`(`GuestName`, `email`, `Phone`) VALUES ('{$name}','{$email}', '{$phone}');";
    $rstbguest = mysqli_query($conn, $tbguest);

    $guest = "SELECT GuestID FROM tbguest WHERE `email` = '{$email}'";
    $rsguest = mysqli_query($conn, $guest);
    $rcguest = mysqli_fetch_array($rsguest);

    $tbfeedback = "INSERT INTO tbfeedback(`GuestID` ,`Content`, `Date`) VALUES ('{$rcguest[0]}', '{$Content}',now())";
    $rstbfeedback = mysqli_query($conn, $tbfeedback);

    if (!$rstbguest && !$rstbfeedback) :
        die('nothing to save');
    endif;
    header("location: home.php");
endif;

include 'php/htmlHead.php';
include 'php/navigationBar.php';
?>
<style>
    body {
        background-image: url('img/contact-background.jpg');
    }
</style>
<section class="container my-5">
    <form method="post" enctype="multipart/form-data">
        <h2 class="text-white text-center">Contact Us</h2>
        <table class="table table-hove table-bordered bg-white w-50 mx-auto">
            <tr>
                <td>
                    <div class="form-floating">
                        <input type="text" class="form-control is-invalid" id="floatingInputInvalid" placeholder="Input Name" name="txtName" maxlength="25" required>
                        <label for="floatingInputInvalid">User Name</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-floating">
                        <input type="email" class="form-control is-invalid" id="floatingInputInvalid" placeholder="name@example.com" name="txtEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                        <label for="floatingInputInvalid">Email</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-floating">
                        <input type="tel" class="form-control is-invalid" id="floatingInputInvalid" placeholder="Input Phone" name="txtPhone" pattern="([\+84|84|0]+(3|5|7|8|9|1[2|6|8|9]))+([0-9]{8})\b" required>
                        <label for="floatingInputInvalid">Phone Number</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="txtContent" rows="10" cols="30" style="height: 10rem;"maxlength="1000" required></textarea>
                        <label for="floatingTextarea">Leave your feedback here</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="text-center"> <input type="submit" name="txtSubmit" value="Send" class="btn btn-warning rounded-pill"></td>
            </tr>
        </table>
    </form>
</section>
<?php
mysqli_close($conn);
include 'php/footer.php';
include 'php/htmlBody.php';
?>