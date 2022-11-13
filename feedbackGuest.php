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

<section class="container section-margin">
    <form method="post" enctype="multipart/form-data">
        <h2>Input FeedBack</h2>
        <table class="table table-hove table-bordered">
            <tr>
                <td>Name:</td>
                <td>
                    <div class="form-floating">
                        <input type="text" class="form-control is-invalid" id="floatingInputInvalid" placeholder="Input Name" name="txtName">
                        <label for="floatingInputInvalid">User Name</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Mail:</td>
                <td>
                    <div class="form-floating">
                        <input type="email" class="form-control is-invalid" id="floatingInputInvalid" placeholder="name@example.com" name="txtEmail">
                        <label for="floatingInputInvalid">Email</label>
                    </div>
                </td>
            </tr>

            <tr>
                <td>Phone:</td>
                <td>
                    <div class="form-floating">
                        <input type="tel" class="form-control is-invalid" id="floatingInputInvalid" placeholder="Input Phone" name="txtPhone">
                        <label for="floatingInputInvalid">Phone Number</label>
                    </div>
                </td>
            </tr>

            <tr>
                <td>FeedBack:</td>
                <td>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="txtContent" rows="10" cols="30"></textarea>
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
mysqli_close($conn);
include 'php/footer.php';
include 'php/htmlBody.php';
?>