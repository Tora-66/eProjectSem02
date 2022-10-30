<?php
include_once 'DBConnect.php';
$query = "select * from tbbrand";
$rs    = mysqli_query($conn, $query);
$count = mysqli_num_rows($rs);

include 'htmlHead.php';
include 'sidebar.php';
?>

<section style="margin-top: 8rem;">
<div class="container">
    <h2>Brand List</h2>
    <div class="container m-0 my-3 p-0">
        <button class="btn btn-outline-dark"><a href="addBrand.php" class="text-decoration-none text-warning">Add New</a></button>
    </div>
    <table class="table table-hove table-bordered">
        <tr>
            <th>Brand ID</th>
            <th>Name</th>
            <th>Logo</th>
            <th colspan="2">Function</th>
        </tr>
        <?php
        if ($count == 0) :
            echo 'Record not found!';
        else :
            while ($data = mysqli_fetch_array($rs)) :

        ?>
                <tr>
                    <td><?= $data[0] ?></td>
                    <td><?= $data[1] ?></td>
                    <td style="text-align:center"><img src="<?= $data[2] ?>" alt="Image" width="40" height="30"></td>
                    <td><a href="editBrand.php?code=<?= $data[0] ?>">Update</a></td>
                    <td><a href="detailsBrand.php?code=<?= $field[0] ?>">Details</a></td>
                </tr>
        <?php
            endwhile;
        endif;
        ?>
    </table>

</div>
</section>
<?php
include 'htmlBody.php';
mysqli_close($conn);
?>