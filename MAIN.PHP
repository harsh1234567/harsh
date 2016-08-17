<!DOCTYPE html>
<html>
<body>
 <?php
include "RefreshVoucher.php";
include "FunTallyRequest.php";
include "FunXmlTOmysql.php";
include "conn.php";
//include "DeleteVoucher.php";
//DeleteVoucher();
echo RefreshVoucher();
$company=trim("Dreamcann Foods Pvt.Ltd.(Amex 5)");
echo $company;
//Dreamcann Foods Pvt.Ltd.(Saket City Hospital)
	 $requestXML=tallyrequest($company,	1496,1600);
		  echo $masterid1=FunXmlTOmysql($requestXML,$company);
		  echo RefreshVoucher();
?>
</body>
</html>
