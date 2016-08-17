<?php

function RefreshVoucher(){
include "conn.php";
include "DeleteVoucher.php";
ini_set('max_execution_time', 300); 
DeleteVoucher();

//$sql = "DELETE FROM `voucher` WHERE CNAME LIKE `1`';
$sql_sel=mysqli_query($conn,"select MASTERID,CNAME,DATE,sum(ACTUALQTY) as QTY ,sum(AMOUNT) as AMT,VOUCHERTYPENAME,VOUCHERNUMBER from voucher group by MASTERID");
  while($rowss=mysqli_fetch_array($sql_sel))
  {
	  
	  $mas=$rowss['MASTERID'];
	  $cnm= $rowss['CNAME'];
	  
	  $date= $rowss['DATE'];
	  $qty= $rowss['QTY'];
	  $amt= $rowss['AMT'];
	  $vtype= $rowss['VOUCHERTYPENAME'];
	  $vno= $rowss['VOUCHERNUMBER'];
	 //$mt=date($date,"F-Y");
	 $time = strtotime($date);

$mt = date('F-Y',$time);

//echo $newformat;
	 //$mt= $date;//date_format($date,"F-Y")
	 //echo $mt;
	 
	 //echo $date;
	  //echo "<br/>";
	  //$sql_in=mysqli_query($conn,"insert into dailymis values('$vtype','$date','$vno','$qty','$amt','$cnm','$mas','DATE_FORMAT(".$date.",'%m-%Y')')");
	  $sql_in=mysqli_query($conn,"insert into dailymis values('$vtype','$date','$vno','$qty','$amt','$cnm','$mas','$mt')");
 
 }
 
$sql = "DELETE FROM `voucher` ";
		if (mysqli_query($conn, $sql)) {
         echo "Deleted successfullybb..aaa..11.";
      }
	  else {
        echo "Error: aa" . $sql . "<br>" . mysqli_error($conn);
      }	
	 //return $mt;
	 return "done...";
	  
}
// Check connection
?>