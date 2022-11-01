<?php
session_start();

$pageTitle = "Profile";
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    session_write_close();
} else {
    session_unset();
    session_write_close();
    $url = "./login.php";
    header("Location: $url");
}
include_once "php/DBConnect.php";
$query = "SELECT * FROM tbUser_Account WHERE username = '$username'";
$rs = mysqli_query($conn, $query);
$count = mysqli_num_rows($rs);
$field = mysqli_fetch_array($rs);
$query1 = "SELECT * FROM tbDelivery_Address WHERE userid = '$field[0]'";
$rs1 = mysqli_query($conn, $query1);

include 'php/htmlHead.php';

?>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<link href="css/userprofile.css" type="text/css" rel="stylesheet" />
<div class="col-lg-10 col-md-10 col-sm-9 col-xs-12 container">
    <div class="notification">
        <?php
        if (isset($_GET["msgSuccess"])) :
            echo '<div class="alert alert-success">Edit successfully</div>';
        endif;
        ?>
    </div>
    <h2>Profile</h2>
    <hr style="height:2px;border-width:0;color:gray;background-color:gray">
    <h3><?= $field[3] ?></h3> <br>
    <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'accountinfo')" id="defaultOpen">Account Information</button>
        <button class="tablinks" onclick="openCity(event, 'purchasehis')">Purchase History</button>
        <button class="tablinks" onclick="openCity(event, 'feedbackhis')">Feedback History</button>
    </div>

    <div id="accountinfo" class="tabcontent">
        <h3>Account Information</h3>
        <table class="table-sm">
            <tr>
                <th>Email</th>
                <td><?= $field[4] ?></td>
            </tr>
            <tr>
                <th>Phone Number&emsp;&emsp;</th>
                <td><?= $field[5] ?></td>
            </tr>
            <tr>
                <th style="vertical-align: top">Address</th>
                <td>
                    <?php
                    while ($field1 = mysqli_fetch_array($rs1)) :
                    ?>
                        <?= $field1[2] ?> <br>
                    <?php
                    endwhile;
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="editprofile.php?code=<?= $field[0] ?>">Edit profile</a>
                </td>
            </tr>
        </table>
    </div>

    <div id="purchasehis" class="tabcontent">
        <h3>Purchase History</h3>
        <?php include 'orderHistory.php'; ?>
    </div>

    <div id="feedbackhis" class="tabcontent">
        <h3>Feedback History</h3>
    </div>
</div>
<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
<?php
include 'php/htmlBody.php';
?>