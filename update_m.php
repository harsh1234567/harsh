<?php
include "RefreshVoucher.php";
include "FunTallyRequest.php";
include "FunXmlTOmysql.php";
include "conn.php";
 extract($_GET);
 if(isset($masterid) && $cname)
 {
 $cname=trim($cname);    
     $requestXML=tallyrequest($cname,$masterid,$masterid+2500);
	 echo $masterid1=FunXmlTOmysql($requestXML,$cname);
	 echo RefreshVoucher();
  //   header('location:MAIN1.php'); 
  echo "<script>	alert('Change is succesfully Done...');
    window.location = 'dcan.php';

</script>";  
//	echo mysqlreprest();

 }
?>