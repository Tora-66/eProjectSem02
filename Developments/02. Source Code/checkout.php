<!DOCTYPE html>
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
  return $price * $quantity;
}

if (isset($_POST["btnOrder"])) {
  $address = $_POST["address"];
}

include 'htmlHead.php';
include 'navigationBar.php';
?>

<section style="margin-top: 8rem;">
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
      </tr>
    </thead>
    <?php
    $count = count($_SESSION["prodID"]);
    $subtotal = 0;
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
              <p class="quantity"><?= $quantity; ?></p>
            </div>
          </td>
          <td>$<span class="price"><?= $rcProduct[2]; ?></span></td>
          <td>
            <p class="total">$<?= total((float)$rcProduct[2], (int)$quantity) ?></p>
          </td>
        </tr>
      </tbody>
    <?php
      $subtotal = $subtotal + total((float)$rcProduct[2], (int)$quantity);
    endfor;
    ?>
  </table>
  <form action="" class="form-control">
    <div>
      <div>
        <h5>Subtotal:</h5>
        <p>$<?= $subtotal; ?></p>
      </div>
      <div>
        <h5>Taxes:</h5>
        <p>$<?= $subtotal * 0.1; ?></p>
      </div>
      <div>
        <h5>Total:</h5>
        <p>$<?= $subtotal * 1.1; ?></p>
      </div>
      <div>
        <h5>Payment:</h5>
        <p>Cash</p>
      </div>
      <div>
        <h5>Delivery Address</h5>
        <input type="text" name="address">
      </div>
    </div>
  </form>
  <div class="m-2 me-5 pe-3 text-start">
    <button type="button" class="btn btn-danger" name="addOrder"><a class="text-decoration-none text-white" href="addOrder.php">Submit</a></button>
  </div>
</form>
</section>


<?php mysqli_close($conn); 
include 'htmlBody.php';
?>
