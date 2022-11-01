<?php
#1. Start session
#2. Kiểm tra session
#3. Kết nối
include_once "php/DBConnect.php";
#4. Thực hiện
if (isset($_POST['search'])) {
    $valueToSearch = $_POST['valueToSearch'];
    $query = "SELECT * FROM tbUser_Account WHERE CONCAT(userid, username, fullname, email, phonenumber) LIKE '%" . $valueToSearch . "%'";
    $search_result = filterTable($query);
    $count = mysqli_num_rows($search_result);
} else {
    $query = "SELECT * FROM tbUser_Account";
    $search_result = filterTable($query);
    $count = mysqli_num_rows($search_result);
}

function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "dbpheidip");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>User List</title>
</head>
<style>
    th {
        text-align: center
    }
</style>

<body>
    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
        <h2>User List</h2>
        <hr>
        <div class="panel-heading">
        </div>
        <form action="" method="post">
            <input type="text" name="valueToSearch" placeholder="Value To Search">
            <input type="submit" name="search" value="Search" class="btn btn-success btn-xs"><br>

            <?php
            if (!$count) {
                echo '<div class = "alert-warning">Records not found!</div>';
            }
            ?>
            <hr>
            <table id="userList" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Delete</th>
                    </tr>
                    <?php
                    while ($field = mysqli_fetch_array($search_result)) :
                    ?>
                        <tr>
                            <td><?= $field[0] ?></td>
                            <td><?= $field[1] ?></td>
                            <td><?= $field[3] ?></td>
                            <td><?= $field[4] ?></td>
                            <td><?= $field[5] ?></td>
                            <td>
                                <?php
                                $query1 = "SELECT * FROM tbDelivery_Address WHERE userid = '$field[0]'";
                                $rs1 = mysqli_query($conn, $query1);
                                while ($field1 = mysqli_fetch_array($rs1)) :
                                ?>
                                    <?= $field1[2] ?> <br>
                                <?php
                                endwhile;
                                ?>
                            </td>
                            <td style="text-align: center">
                                <a href="php/deleteUser.php?code=<?= $field[0]; ?>" onclick="return confirm('Really want to delete <?= $field[1] ?> ???')">Delete</a>
                            </td>
                        </tr>
                    <?php
                    endwhile;
                    ?>
        </form>
        </thead>
        </table>
    </div>
</body>

</html>