<!DOCTYPE html>
<html lang="en">
<?php
//Lay du lieu
include_once 'Connect.php';

//Lay du lieu tu tbFeedBack
$tbfeedback = "SELECT * FROM tbfeedback";
$rsfeedback = mysqli_query($conn, $tbfeedback);
$datafeedback = mysqli_num_rows($rsfeedback);

//Lay du lieu tu tbGuest
$tbuser_account = "SELECT * FROM tbuser_account";
$rsuser = mysqli_query($conn, $tbuser_account);
$datauser = mysqli_num_rows($rsuser);
$user = array();
for ($i = 0; $i < $datauser; $i++) {
    $rcUser = mysqli_fetch_array($rsuser);
    array_push($user, $rcUser);
}

//Lay du lieu tu tbguest
$tbguest = "SELECT * FROM tbguest";
$rsguest = mysqli_query($conn, $tbguest);
$dataguest = mysqli_num_rows($rsguest);
$guest = array();
for ($i = 0; $i < $dataguest; $i++) {
    $rcGuest = mysqli_fetch_array($rsguest);
    array_push($user, $rcGuest);
}




?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Views FeedBack</title>
</head>

<body>
    <div class="container">
        <h2>View FeedBack</h2>
        <table class="table table-hove table-bordered">
            <tr>
                <th>FeedBack Id:</th>
                <th>UserId</th>
                <th>GuestId</th>
                <th>Name:</th>
                <th>PhoneNumber:</th>
                <th>Email:</th>
                <th>Comment:</th>
                <th>Date</th>
            </tr>
            <?php
            for ($i = 0; $i < $datafeedback; $i++) :
                $rcfeedback = mysqli_fetch_array($rsfeedback);
            ?>
                <tr>
                    <td><?= $rcfeedback[0] ?></td>
                    <td><?= $rcfeedback[1] ?></td>
                    <td><?= $rcfeedback[2] ?></td>
                    <td>
                        <?php
                        for ($z = 0; $z < count($user); $z++) {
                            if ($rcfeedback[1] == $user[$z][0]) {
                                echo $user[$z][3];
                            }
                        };

                        for ($z = 0; $z < count($guest); $z++) {
                            if ($rcfeedback[2] == $guest[$z][0]) {
                                echo $guest[$z][1];
                            }
                        };
                        ?>
                    </td>

                    <td>
                        <?php
                        for ($z = 0; $z < count($user); $z++) {
                            if ($rcfeedback[1] == $user[$z][0]) {
                                echo $user[$z][5];
                            }
                        };

                        for ($z = 0; $z < count($guest); $z++) {
                            if ($rcfeedback[2] == $guest[$z][0]) {
                                echo $guest[$z][3];
                            }
                        };
                        ?>
                    </td>
                    
                    <td>
                    <?php
                    for($z = 0; $z < count($user); $z++){
                        if($rcfeedback[1] == $user[$z][0]){
                            echo $user[$z][4];
                        }
                    };

                    for($z = 0; $z < count($guest); $z++){
                        if($rcfeedback[2] == $guest[$z][0]){
                            echo $guestr[$z][2];
                        }
                    };
                    ?>
                    </td>
                    <td><?= $rcfeedback[3]?></td>
                    <td><?= $rcfeedback[4]?></td>
                </tr>
            <?php
            endfor;
            ?>
        </table>
    </div>
</body>

</html>