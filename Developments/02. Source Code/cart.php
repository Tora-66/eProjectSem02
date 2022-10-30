<?php
session_start();
include_once 'DBConnect.php';

if (isset($_SESSION["username"])) {
  $username = $_SESSION["username"];
  session_write_close();
} else {
  session_unset();
  session_write_close();
  $url = "./home.php";
  header("Location: $url");
}

$query = "SELECT * FROM `tbBrand`;";
$rs = mysqli_query($conn, $query);
$count = mysqli_num_rows($rs);

$brand = array();

for ($i = 0; $i < $count; $i++) {
  $rc = mysqli_fetch_array($rs);
  array_push($brand, $rc);
}

function total($price, $quantity)
{
  echo $price * $quantity;
}

include 'htmlHead.php';
include 'navigationBar.php';
?>
<section id="cartView" class="section-padding cart" style="margin-top: 8rem;">
  <form method="post">
    <!-- Form table -->
    <table class="table">
      <thead>
        <tr class="text-center">
          <th scope="col"></th>
          <th scope="col">Product</th>
          <th scope="col">Quantity</th>
          <th scope="col">Price</th>
          <th scope="col">Total</th>
          <th scope="col">Remove</th>
        </tr>
      </thead>
      <?php
      $count = count($_SESSION["prodID"]);
      for ($i = 0; $i < $count; $i++) :
        $prodID = $_SESSION["prodID"][$i];
        $queryProduct = "SELECT * FROM `tbProduct` WHERE ProductID = '{$prodID}'";
        $rsProduct = mysqli_query($conn, $queryProduct);
        $rcProduct = mysqli_fetch_array($rsProduct);

        $size = $_SESSION["size"][$i];
        $quantity = $_SESSION["quantity"][$i];

      ?>
        <tbody>
          <tr class="text-center align-middle">
            <th scope="row"><?= $i + 1; ?></th>
            <td>
              <div class="product-card">
                <img src="<?= $rcProduct[3]; ?>" alt="" class="product-card-item product-card-img">
                <div class="product-card-item">
                  <h5><?= $rcProduct[1]; ?></h5>
                  <p><?php
                      for ($x = 0; $x < count($brand); $x++) {
                        if ($rcProduct[5] == $brand[$x][0]) {
                          echo $brand[$x][1];
                        }
                      }

                      ?></p>
                  <p><?= $size; ?></p>
                </div>
              </div>
            </td>
            <td>
              <div>
                <a href="minus.php?index=<?= $i ?>">-</a>
                <p id="quantity"><?= $quantity; ?></p>
                <a href="add.php?index=<?= $i ?>">+</a>
              </div>
            </td>
            <td>$<span id="price"><?= $rcProduct[2]; ?></span></td>
            <td>
              <p id="total">$<?= total((float)$rcProduct[2], (int)$quantity) ?></p>
            </td>
            <td><a href="remove.php?index=<?= $i ?>">Remove</a></td>
          </tr>
        </tbody>
      <?php
      endfor;
      ?>
    </table>
    <div class="m-2 me-5 pe-3 text-end">
      <button type="button" class="btn btn-danger"><a class="text-decoration-none text-white" href="checkout.php">Checkout</a></button>
    </div>
  </form>
</section>


<?php mysqli_close($conn);
include 'htmlBody.php';
?>