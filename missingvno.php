 <?php

function MissingVoucher(){
	include "conn.php";
	 $sel ="SELECT CNAME,MIN(VOUCHERNUMBER) AS STARTNO,MAX(VOUCHERNUMBER) AS LASTNO, COUNT(VOUCHERNUMBER) AS MID FROM  dailymis WHERE VDATE > '2016-03-31' GROUP BY CNAME";
	 $sell=mysqli_query($conn,$sel);
	 $i=1;
	 $var="";
 	 while($rows=mysqli_fetch_array($sell))
	 {
		 $ttrans=  $rows['LASTNO'] -($rows['STARTNO']-1) ;	
		 $totmiss=  $ttrans-$rows['MID'] ;
		 //if $totmiss>0 {
			 
		
		 //$b=str_pad($a,25,'X',STR_PAD_LEFT);
		 //echo str_pad("input", 10, "pp", STR_PAD_BOTH ); // ppinputppp
		$var.=  $i++.".        ";
		$var.=$rows['CNAME'] ."                ,";
		$var.=$rows['STARTNO'] ."              ,";
		$var.=$rows['LASTNO'] ."              ,";
		
		$var.=$rows['MID'] ."              ,";
		 
		$var.=$ttrans ."              ,";
			 
		$var.=$totmiss ."              ,";
		$var.="</br>";
		 }
	 //} 
	return $var;
	
}	 
  ?>