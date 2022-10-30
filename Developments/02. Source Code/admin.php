<?php
include_once 'DBConnect.php';


include 'htmlHead.php';
include 'sidebar.php';
?>


<?php
include 'htmlBody.php';
mysqli_close($conn);
?>