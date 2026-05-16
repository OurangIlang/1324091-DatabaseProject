<?php
include '../koneksi.php';
 
if (isset($_GET['product_id'])) {
    $product_id=$_GET['product_id'];
}
 
$result = mysqli_query($conn, "DELETE FROM product WHERE product_id='$product_id'");
 
header("Location:productlihat.php");
?>