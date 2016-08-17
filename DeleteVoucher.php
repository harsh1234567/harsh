<?php error_reporting(1);
include "conn.php";
ini_set('max_execution_time', 300); 
function DeleteVoucher(){
$sql = "DELETE FROM `voucher` ";
		if (mysqli_query($conn, $sql)) {
         echo "Deleted successfully-DeleteVoucher.php;";
      }
	   
	 
 }
 ?>
 