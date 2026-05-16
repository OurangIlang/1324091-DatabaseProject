<?php
// include database connection file
include '../koneksi.php';
 
// Get id from URL to delete that user
if (isset($_GET['customer_id'])) {
    $customer_id=$_GET['customer_id'];
}
 
// Delete user row from table based on given id
$result = mysqli_query($conn, "DELETE FROM customer WHERE customer_id='$customer_id'");
 
// After delete redirect to Home, so that latest user list will be displayed.
header("Location:customerlihat.php");
?>