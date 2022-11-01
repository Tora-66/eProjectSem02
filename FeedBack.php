<!DOCTYPE html>
<html lang="en">
    <?php
        //Ket noi du lieu
        include_once'Connect.php';

        $userid = 1;
        // $_GET["userId"];
        // if(isset($_GET["userId = 1"])):
        //     header("location:#.php");
        // else:
        //     echo 'Wecomel'.$userid;
        // endif;

        //Lay du lieu TbUser_Acount
        $tbuser_accont = "SELECT * FROM tbuser_account WHERE UserID ='{$userid}'";
        $rs = mysqli_query($conn, $tbuser_accont);
        $data = mysqli_fetch_array($rs);

        //Lay du lieu tbGuest
        $tbguest = "SELECT * FROM tbguest";
        $rs1 = mysqli_query($conn, $tbguest);
        $data2 = mysqli_fetch_array($rs1);

        //Lay du lieu tbFeedBack
        $tbfeedback = "SELECT * FROM tbfeedback";
        $rs2 = mysqli_query($conn, $tbfeedback);
        $data3 = mysqli_fetch_array($rs2);

        //Sever
        if (isset($_POST["txtSubmit"])):
            $name = "txtName";
            $phone = "txtPhone";
            $email = "txtEmail";
            $Content = "txtContent";
            $userid = "txtUserId";
            $guestid = "txtGuestId";

            $query = "INSERT INTO tbfeedback (UserID,GuestID ,Content, Date) VALUE ('{$userid}','{$guestid}', '{$Content}',now())";
            $rs3 =mysqli_query($conn,$query);

            if(!$rs3):
                die('nothing to save');
            endif;
            header("location:#");
        endif;

        //
    ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
    <h2>Input FeedBack</h2>
    <table class="table table-hove table-bordered">
        <tr>
            <td>Name:</td>
            <td>
                <input type="text" name = "txtName" value="<?=$data[0]?>" readonly>
            </td>
        </tr>
        <tr>
            <td>Phone:</td>
            <td>
                <input type="text" name = "txtPhone" value="<?=$data[1]?>" readonly>
            </td>
        </tr>
        <tr>
            <td>Mail:</td>
            <td>
                <input type="text" name = "txtEmail" value="<?=$data[3]?>" readonly>
            </td>
        </tr>

        <tr>
            <td>FeedBack:</td>
            <td>
                <textarea id="subject" name="txtcontent" placeholder="Write something.." style="height:200px"></textarea>
            </td>
        </tr>

        <tr>
            <td></td>
            <td> <input type="submit" name = "txtSubmit" value="Send" ></td>
        </tr>

    </table>
</form>
</body>
</html>