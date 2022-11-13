<?php

include_once 'php/DBConnect.php';
session_start();

$pageTitle = "Inventory Management";

$queryInventory = "SELECT * FROM `tbInventory`";
$rsInventory = mysqli_query($conn, $queryInventory);
$countInventory = mysqli_num_rows($rsInventory);

$queryProduct = "SELECT * FROM `tbProduct`";
$rsProduct = mysqli_query($conn, $queryProduct);
$countProduct = mysqli_num_rows($rsProduct);

// ProductID array in Inventory
$proInven = array();
for ($i = 0; $i < $countInventory; $i++) :
  $rcInventory = mysqli_fetch_array($rsInventory);
  array_push($proInven, $rcInventory[1]);
endfor;
array_unique($proInven);

for ($x = 0; $x < $countProduct; $x++) :
  $rcProduct = mysqli_fetch_array(($rsProduct));
  if (!in_array($rcProduct[0], $proInven)) {
    $InvenID = substr($rcProduct[0], 0, 7) . "38";
    $queryInsert = "INSERT INTO `tbInventory`(InventoryID, ProductID, `Size`, Quantity) VALUES
          ('{$InvenID}', '{$rcProduct[0]}', '38', 0);";
    $executeInsert = mysqli_query($conn, $queryInsert);

    $InvenID = $rcProduct[0] . "39";
    $queryInsert = "INSERT INTO `tbInventory`(InventoryID, ProductID, `Size`, Quantity) VALUES
          ('{$InvenID}', '{$rcProduct[0]}', '39', 0);";
    $executeInsert = mysqli_query($conn, $queryInsert);

    $InvenID = $rcProduct[0] . "40";
    $queryInsert = "INSERT INTO `tbInventory`(InventoryID, ProductID, `Size`, Quantity) VALUES
          ('{$InvenID}', '{$rcProduct[0]}', '40', 0);";
    $executeInsert = mysqli_query($conn, $queryInsert);

    $InvenID = $rcProduct[0] . "41";
    $queryInsert = "INSERT INTO `tbInventory`(InventoryID, ProductID, `Size`, Quantity) VALUES
          ('{$InvenID}', '{$rcProduct[0]}', '41', 0);";
    $executeInsert = mysqli_query($conn, $queryInsert);

    $InvenID = $rcProduct[0] . "42";
    $queryInsert = "INSERT INTO `tbInventory`(InventoryID, ProductID, `Size`, Quantity) VALUES
          ('{$InvenID}', '{$rcProduct[0]}', '42', 0);";
    $executeInsert = mysqli_query($conn, $queryInsert);
  }
endfor;

$queryInventory = "SELECT * FROM `tbInventory`";
$rsInventory = mysqli_query($conn, $queryInventory);

include 'php/htmlHead.php';
include 'php/sidebar.php';
?>
<section class="mx-5" style="margin-top: 8rem;">
  <h2>Inventory</h2>
  <table class="table table-hove table-bordered text-center">
    <tr>
      <th>Inventory ID</th>
      <th>Product ID</th>
      <th>Size</th>
      <th>Quantity</th>
      <th colspan="2">Add</th>
    </tr>
    <?php
    while ($rcInventory = mysqli_fetch_array($rsInventory)) :
    ?>
      <tr>
        <td><?= $rcInventory[0]; ?></td>
        <td><?= $rcInventory[1]; ?></td>
        <td><?= $rcInventory[2]; ?></td>
        <td><?= $rcInventory[3]; ?></td>
        <td><a href="addInventory.php?id='<?= $rcInventory[0]; ?>'">Add</a></td>
      </tr>
    <?php
    endwhile;
    ?>
  </table>

</section>
<?php
mysqli_close($conn);
include 'php/htmlBody.php';
?>