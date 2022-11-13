<?php
#1. Connect to databse
include_once 'php/DBConnect.php';
session_start();

$pageTitle = "Women";

$rs = "";
if (isset($_GET['id'])) :

    $code = $_GET["id"];
    $query = "SELECT TagName, p.ProductID, ProductName, Price, Thumbnail, TypeName
        FROM tbproduct p
            JOIN tbtag tg ON p.ProductID = tg.ProductID
            JOIN tbtype tp ON p.TypeID = tp.TypeID
        WHERE tp.TypeID = {$code} AND TagName = 'Women';";
    $rs = mysqli_query($conn, $query);
    $count = mysqli_num_rows($rs);
else :
    $query = "SELECT TagName, p.ProductID, ProductName, Price, Thumbnail         
                    FROM tbproduct p
                        JOIN tbtag tg ON p.ProductID = tg.ProductID 
                    WHERE TagName = 'Women';";
    $rs = mysqli_query($conn, $query);
    $count = mysqli_num_rows($rs);

endif;

include 'php/htmlHead.php';
include 'php/navigationBar.php';
?>
<section class="pt-5 text-center">
    <div class="container">

        <div class="row">

            <?php
            if ($count == 0) :
                echo '<br>Record not found!';
            else :
                while ($data1 = mysqli_fetch_array($rs)) :
            ?>

                    <div class="col-3 d-flex justify-content-center mb-4">
                        <div class="card me-2">
                            <img src="<?= $data1[4] ?>" class="card-img-top" alt="...">
                            <div class="card-body text-center d-flex flex-column">
                                <h5 class="card-title"><?= $data1[2] ?></h5>
                                <p class="card-text mb-0 mt-auto">$ <?= $data1[3] ?></p>
                                <a href="productDetails.php?id=<?= $data1[1] ?>" class="btn btn-primary rounded-pill mx-4 mt-auto mb-0">
                                    <i class="bi bi-cart-plus me-2"></i>
                                    Add to Cart
                                </a>
                            </div>
                        </div>
                    </div>

            <?php
                endwhile;
            endif;
            mysqli_close($conn);
            ?>
        </div>
    </div>
</section>

<?php
include 'php/footer.php';
include 'php/htmlBody.php';
?>