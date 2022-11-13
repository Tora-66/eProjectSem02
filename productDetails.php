<?php
session_start();

//Connect database
include_once 'php/DBConnect.php';
$pageTitle = "Product Details";

$proID = $_GET["id"];

$queryProduct = "SELECT * FROM `tbProduct` WHERE ProductID = '{$proID}'";
$rsProduct = mysqli_query($conn, $queryProduct);
$countProduct = mysqli_num_rows($rsProduct);
$rcProduct = mysqli_fetch_array($rsProduct);

$queryInventory = "SELECT `Quantity` FROM `tbInventory` WHERE ProductID = '{$proID}';";
$rsInventory = mysqli_query($conn, $queryInventory);
$rcInventory = mysqli_fetch_array($rsInventory);
$InQuantity = $rcInventory[0];


if (isset($_POST['btnAdd'])) {
  if (!isset($_SESSION["username"])) {
    header("location: login.php");
  } else {
    $size = $_POST['options'];
    $quantity = $_POST['quantity'];

    array_push($_SESSION["prodID"], $proID);
    array_push($_SESSION["size"], $size);
    array_push($_SESSION["quantity"], $quantity);
  }
}

$query1 = "SELECT * FROM tbbrand ";
$rs1 = mysqli_query($conn, $query1);
$count1 = mysqli_num_rows($rs1);
$brand = array();
for ($i = 0; $i < $count1; $i++) {
  $rc1 = mysqli_fetch_array($rs1);
  array_push($brand, $rc1);
}

include 'php/htmlHead.php';
include 'php/navigationBar.php';
?>

<section id="productDetails" class="section-margin d-flex container-fluid">
  <div class="container">
    <img src="<?= $rcProduct[4] ?>" alt="" width="100%" height="500px">
  </div>
  <div class="container m-auto">
    <form method="post">
      <h3 class="product-name"><?= $rcProduct[1] ?></h3>
      <p class="brand-name">
        <?php
        for ($z = 0; $z < count($brand); $z++) {
          if ($rcProduct[5] == $brand[$z][0]) {
            echo $brand[$z][1];
          }
        }
        ?>
      </p>
      <p class="product-price">$<?= $rcProduct[2] ?></p>
      <div class="size m-0 my-2 p-0">
        <div class="container d-inline m-0 p-0">
          <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" value="38" required />
          <label class="btn btn-secondary" for="option1">38</label>
        </div>
        <div class="container d-inline mx-1 p-0">
          <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off" value="39" />
          <label class="btn btn-secondary" for="option2">39</label>
        </div>
        <div class="container d-inline mx-1 p-0">
          <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off" value="40" />
          <label class="btn btn-secondary" for="option3">40</label>
        </div>
        <div class="container d-inline mx-1 p-0">
          <input type="radio" class="btn-check" name="options" id="option4" autocomplete="off" value="41" />
          <label class="btn btn-secondary" for="option4">41</label>
        </div>
        <div class="container d-inline d-inline mx-1 p-0">
          <input type="radio" class="btn-check" name="options" id="option5" autocomplete="off" value="42" />
          <label class="btn btn-secondary" for="option5">42</label>
        </div>
      </div>
      <div class="container my-2 p-0">
        <input class="m-0" type="number" name="quantity" min="1" step="1" max="<?= $InQuantity; ?>" pattern="[0-9]{1,}" required>
        <label for="quantity"><p class="fw-light fst-italic">(<span class="fw-bold"><?= $InQuantity;?></span> products remaining)</p></label>
      </div>
      <button type="submit" class="btn btn-dark btn-lg rounded-0 card-button" name="btnAdd">
        <i class="bi bi-cart2 me-2"></i> Add to cart
      </button>
      <div class="my-3">
        <p class="fw-bold my-1">Description</p>
        <textarea name="description" id="description" cols="40" rows="4" disabled class="bg-white">
            <?= $rcProduct[7] ?>
          </textarea>
      </div>
    </form>
  </div>
</section>

<?php
mysqli_close($conn);
include 'php/htmlBody.php';
?>