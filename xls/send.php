<?php
   include('conn.php');
   extract($_POST);
    ini_set('max_execution_time', 150); 

	    $dt = strtotime($yes);
       $yes = date('Y-m-d',$dt);
	   $string = $today;
$timestamp = strtotime($string);
  $day= date("d", $timestamp);
		  "</br>.tdays.";
$dt = new DateTime($today );
$dt->modify('last day of this month');
  $tdays= $dt->format('d');
   "</br>.tdays.";
   $tdays;
 $set=mysqli_query($conn,'delete from salesmis');
 $sel="SELECT CNAME, sum(value) AS SALES_MT, ((sum(value))*1.1) AS SALES_MI FROM `dailymis`  where mt='".$pre."' GROUP BY cname";
 $set=mysqli_query($conn,$sel);
 while($row=mysqli_fetch_array($set))
 {
	 $cname = $row['CNAME'];
	 $sales_mt=$row['SALES_MT'];
	 $sales_mi= $row['SALES_MI'];
	 $insert_in_sales="insert into salesmis (Location,SALE_LMT,SALE_PROJ) value('$cname','$sales_mt','$sales_mi')";
	 $insert=mysqli_query($conn,$insert_in_sales);
      "a1"; 
 }
$sel="SELECT cname, Sum(DailyMis.Value) AS CSale, Sum(DailyMis.qty) AS TProd_T, Count(DailyMis.vouchernumber) AS TBill FROM DailyMis
WHERE mt='$curr' AND vdate<='$today'
GROUP BY cname";
    $sel_t=mysqli_query($conn,$sel);
	while($rowss=mysqli_fetch_array($sel_t))
	{
		 $cname=$rowss['cname'];//."</br>";
		 $sales_c=$rowss['CSale'];//."</br>";
		 $tprod_t=$rowss['TProd_T'];//."<br/>";
	     $tbill=$rowss['TBill'];//."<br/>";
		 $sales_e=round(($sales_c/$day)*$tdays);
		$avg_sale_t=round($sales_c/$tbill,2);
		$avgprodpbill_t=round($tprod_t/$tbill,2);
	$insert_in_sales="insert into salesmis (Location, SALE_TDATE,SALE_E,TBILL_T,AVG_SALE_T,TPROD_T,AVGPRODPBILL_T) value('$cname','$sales_c','$sales_e','$tbill','$avg_sale_t','$tprod_t','$avgprodpbill_t')";
	 $insert=mysqli_query($conn,$insert_in_sales);	
	}
 //================
$sel="SELECT cname, Sum(DailyMis.Value) AS Sale_Y, Sum(DailyMis.qty) AS TProd_Y, Count(DailyMis.vouchernumber) AS TBill_Y FROM DailyMis
WHERE mt='$curr' AND vdate='$yes'
GROUP BY cname";
    $sel_y=mysqli_query($conn,$sel);
	while($rowss=mysqli_fetch_array($sel_y))
	{	
		 $cname=$rowss['cname'];//."</br>";
		 $sales_y=$rowss['Sale_Y'];//."</br>";
		 $tprod_y=$rowss['TProd_Y'];//."<br/>";
	     $tbill_y=$rowss['TBill_Y'];//."<br/>";
		$avg_sale_y=round($sales_y/$tbill_y,2);
		$avgprodpbill_y=round($tprod_y/$tbill_y,2);
	 $insert_in_sales_y="insert into salesmis (LOCATION, SALE_YDAY,	TBILL_Y ,AVG_SALE_Y  , TPROD_Y,AVGPRODPBILL_Y) value('$cname','$sales_y', '$tbill_y','$avg_sale_y','$tprod_y','$avgprodpbill_y')";
	 $insert_y=mysqli_query($conn,$insert_in_sales_y); 
	} 
 //================
 $sel11="SELECT LOCATION, SUM(sale_lmt) AS LMT, SUM(sale_proj) AS PROJ, SUM(sale_e) EXPT, SUM(SALE_TDATE) AS TDATE,SUM(sale_yday) as YDATE, SUM(TBILL_T) as TBILL_T,SUM(TBILL_Y) as TBILL_Y, SUM(AVG_SALE_T) AS AVG_SALE_T, SUM(AGV_SALE_Y) AS AVG_SALE_Y,  SUM(TPROD_T) AS TPROD_T, SUM(TPROD_Y) AS TPROD_Y, SUM(AVGPRODPBILL_T) AS AVGPRODPBILL_T , SUM(AVGPRODPBILL_Y) AS AVGPRODPBILL_Y FROM salesmis GROUP BY location";
 $sel_from_salesmis=mysqli_query($conn,$sel11);
	/* echo "<table class='table table-bordered table-hover' style='height:25px; padding: 4px;' >
    <thead>
      <tr style='height:25px;padding-bottom: 10px;'>
        <th>SI</th>
        <th>LOCATION</th>
		<th>Sale Last Month (".$pre.")</th>
		<th>Projection  (".$curr.")</th>
		<th>Expected  (".$curr.")</th>
		<th>Sale - Cumulative from 1st day of the month to ".$today." (Net of Taxes</th>
		<th>Sale of yesterday ".$yes."</th>
        <th>No. of Invoice issued from ".$curr." to ".$today."</th>
		<th>No. of Invoices issued on</th>
        <th colspan='2'>Average Bill Value</th>
		<th>Total No. of Products sold from 1st day of month to ".$today."</th>
		<th>Total No. of Products sold yesterday ".$yes."</th>
		<th colspan='2'>Average Products Per Bill</th>
	</tr>
	 </thead>
    <tbody>"; */


	
	  

    while($rowsss=mysqli_fetch_array($sel_from_salesmis))
	{
		 
		 $loc=$rowsss['LOCATION'];
		$i=1;
		$loc=str_replace("Dreamcann Foods Pvt. Ltd. (","",$loc);
		 $loc=str_replace(")","",$loc); 	
		$loc=str_replace("Dreamcann Foods Pvt.Ltd.(","",$loc);
        $mysql_query=mysqli_query($conn,"select * from cafeinfo where CNAME='$loc'");
        $row_c=mysqli_fetch_array($mysql_query); 		
	   $msg= "<table><tr style='height:25px;padding: 4px;' >
        <td style='height:15px;'>".$i++."</td>
        <td style='height:15px;'>".$loc."</td>
		<td style='height:15px;'>".$rowsss['LMT']."</td>
        <td style='height:15px;'>".$rowsss['PROJ']."</td>
        <td style='height:15px;'>".$rowsss['EXPT']."</td>
        <td style='height:15px;'>".$rowsss['TDATE']."</td>
        <td style='height:15px;'>".$rowsss['YDATE']."</td>
        <td style='height:15px;'>".$rowsss['TBILL_T']."</td>
		<td style='height:15px;'>".$rowsss['TBILL_Y']."</td>
        <td style='height:15px;'>".$rowsss['AVG_SALE_T']."</td>
	<td style='height:15px;'>".$rowsss['AVG_SALE_Y']."</td>
        <td style='height:15px;'>".$rowsss['TPROD_T']."</td>
	<td style='height:15px;'>".$rowsss['TPROD_Y']."</td>
		<td style='height:15px;'>".$rowsss['AVGPRODPBILL_T']."</td>
	<td style='height:15px;'>".$rowsss['AVGPRODPBILL_Y']."</td>	
	  </tr></table>";
    	//$mail_to=$row_c['Email'];
		$from="ariharsh1994@gmail.com";
		$headers =  'MIME-Version: 1.0' . "\r\n"; 
         $headers .= 'From: Your name <ariharsh1994@gmail.com>' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1+' . "\r\n"; 
      mail($mail_to,"mis detail ",$msg,$header);		
	 }
	 
     echo  "</tbody>
	  </table> ";	
     echo "<script> alert('your mail is sent successfully!!'); window.location.href ='mis.php'</script>";

?>