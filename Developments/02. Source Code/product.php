<?php
##1. Connect to databse
include_once './DBConnect.php';
$query = "SELECT * FROM tbproduct";
$rs = mysqli_query($conn, $query);
$count = mysqli_num_rows($rs);

$query1 = "SELECT * FROM tbbrand ";
$rs1 = mysqli_query($conn, $query1);
$count1 = mysqli_num_rows($rs1);
$brand = array();
for ($i = 0; $i < $count1; $i++) {
    $rc1 = mysqli_fetch_array($rs1);
    array_push($brand, $rc1);
}

$query2 = "SELECT * FROM tbtype ";
$rs2 = mysqli_query($conn, $query2);
$count2 = mysqli_num_rows($rs2);
$type = array();
for ($i = 0; $i < $count2; $i++) {
    $rc2 = mysqli_fetch_array($rs2);
    array_push($type, $rc2);
}

include 'htmlHead.php';
include 'sidebar.php';

?>

<section class="mx-5" style="margin-top: 8rem;">
    <h2>Product List</h2>
    <div class="container m-0 my-3 p-0">
        <button class="btn btn-outline-dark"><a href="addProduct.php" class="text-decoration-none text-warning">Add New</a></button>
    </div>
    <table class="table table-hove table-bordered">
        <tr>
            <th>Product ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Thumbnail</th>
            <th>Brand</th>
            <th>Type</th>
            <th colspan="2">Function</th>
        </tr>
        <?php
        if ($count == 0) :
            echo '<br>Record not found!';
        else :
            for ($i = 0; $i < $count; $i++) :
                $data1 = mysqli_fetch_array($rs);
        ?>
                <tr>
                    <td><?= $data1[0] ?></td>
                    <td><?= $data1[1] ?></td>
                    <td> $ <?= $data1[2] ?></td>
                    <td style="text-align:center"><img src="<?= $data1[3] ?>" alt="Image" width="40" height="30"></td>
                    <td>
                        <?php
                        for ($z = 0; $z < count($brand); $z++) {
                            if ($data1[5] == $brand[$z][0]) {
                                echo $brand[$z][1];
                            }
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        for ($z = 0; $z < count($type); $z++) {
                            if ($data1[6] == $type[$z][0]) {
                                echo $type[$z][1];
                            }
                        }
                        ?>
                    </td>
                    <td><a href="#?id=<?= $data1[0] ?>">Update</a></td>
                    <td><a href="detailsProduct.php?id=<?= $data1[0] ?>">Details</a></td>
                </tr>
        <?php
            endfor;
        endif;

        ?>
    </table>
</section>
<?php
mysqli_close($conn);
include 'htmlBody.php';
?>