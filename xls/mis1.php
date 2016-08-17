<?php
 include('conn.php');



 extract($_POST);
 extract($_GET);
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
echo $curr;
echo $yes;
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
      
 }
$sel="SELECT cname, Sum(DailyMis.Value) AS CSale, Sum(DailyMis.qty) AS TProd_T, Count(DailyMis.vouchernumber) AS TBill FROM DailyMis
WHERE mt='$curr' AND vdate<='$today'
GROUP BY cname";

    $sel_t=mysqli_query($conn,$sel);
	$array=array();
	$i2=0;
	while($rowss=mysqli_fetch_array($sel_t))
	{


		 $cname=$rowss['cname'];//."</br>";
		 $loc=$cname;
		 $loc=str_replace("Dreamcann Foods Pvt. Ltd. (","",$loc);
		 $loc=str_replace(")","",$loc); 	
		 $loc=str_replace("Dreamcann Foods Pvt.Ltd.(","",$loc);
         $array[$i2++]=$loc;

		 $sales_c=$rowss['CSale'];//."</br>";
		 $tprod_t=$rowss['TProd_T'];//."<br/>";
	     $tbill=$rowss['TBill'];//."<br/>";
		 $sales_e=round(($sales_c/$day)*$tdays);
		$avg_sale_t=round($sales_c/$tbill,2);
		$avgprodpbill_t=round($tprod_t/$tbill,2);
		echo $sales;
	    echo $tprod_t;
	    echo $tbill;
	    echo $sales_e;
	$insert_in_sales="insert into salesmis (Location, SALE_TDATE,SALE_E,TBILL_T,AVG_SALE_T,TPROD_T,AVGPRODPBILL_T) value('$cname','$sales_c','$sales_e','$tbill','$avg_sale_t','$tprod_t','$avgprodpbill_t')";
	 $insert=mysqli_query($conn,$insert_in_sales);	
	}
 //================
     $sel="SELECT cname, Sum(DailyMis.Value) AS Sale_Y, Sum(DailyMis.qty) AS TProd_Y, Count(DailyMis.vouchernumber) AS TBill_Y FROM DailyMis
    WHERE mt='$curr' AND vdate='$yes'
    GROUP BY cname";
    $sel_y=mysqli_query($conn,$sel);
 
 //================
 $sel11="SELECT LOCATION, SUM(sale_lmt) AS LMT, SUM(sale_proj) AS PROJ, SUM(sale_e) EXPT, SUM(SALE_TDATE) AS TDATE,SUM(sale_yday) as YDATE, SUM(TBILL_T) as TBILL_T,SUM(TBILL_Y) as TBILL_Y, SUM(AVG_SALE_T) AS AVG_SALE_T, SUM(AVG_SALE_Y) AS AVG_SALE_Y,  SUM(TPROD_T) AS TPROD_T, SUM(TPROD_Y) AS TPROD_Y, SUM(AVGPRODPBILL_T) AS AVGPRODPBILL_T , SUM(AVGPRODPBILL_Y) AS AVGPRODPBILL_Y FROM salesmis GROUP BY location";
 $sel_from_salesmis=mysqli_query($conn,$sel11);
?>
<?php

	echo "<table class='table table-bordered table-hover' style='height:25px; padding: 4px;'>
      <thead>
        <tr style='height:25px;padding-bottom: 10px;'>
         <th>SI</th>
         <th>LOCATION</th>
		<th>Sale Last Month (".$pre.")</th>
		<th>Projection  (".$curr.")</th>
		
		<th>Sale - Cumulative from 1st day of the month to ".$today." (Net of Taxes</th>
		  <th>Sale of yesterday ".$yes."</th>
          <th>No. of Invoice issued from ".$curr." to ".$today."</th>
		  <th>No. of Invoices issued on</th>
          <th colspan='2'>Average Bill Value</th>
		  <th>Total No. of Products sold from 1st day of month to ".$today."</th>
		  <th>Total No. of Products sold yesterday ".$yes."</th>
		 <th colspan='2'>Average Products Per Bill</th>
	</tr>";
	echo "<tr style='height:25px;padding: 2px;'>
        <td style='height:15px;'></td>
        <td style='height:15px;'></td>
		<td style='height:15px;'></td>
        <td style='height:15px;'></td>
       
         <td style='height:15px;'>(--Sales Achieved/No. of Days* Days in Month)</td>
        <td style='height:15px;'>Say by ".$day." day</td>
        <td style='height:15px;'></td>
        <td style='height:15px;'></td>
		<td style='height:15px;'>Yesterday</td>
        <td style='height:15px;'>From 1st of ".$curr." to ".$today."</td>
		<td style='height:15px;'>Yesterday</td>
	    <td style='height:15px;'></td>
        <td style='height:15px;'></td>
	<td style='height:15px;'>From 1st of ".$curr." to ".$today."</td>
		<td style='height:15px;'>Yesterday</td>
      </tr>";
	echo "<tr style='height:25px;padding: 4px;'>
        <td style='height:15px;'></td>
        <td style='height:15px;'>A</td>
		<td style='height:15px;'>B</td>
        <td style='height:15px;'>C</td>
         <td style='height:15px;'>D=E/".$day."*".$tdays."</td>
        <td style='height:15px;'>E</td>
        <td style='height:15px;'>F=sale od yesterday</td>
        <td style='height:15px;'>G</td>
		<td style='height:15px;'>H</td>
        <td style='height:15px;'>I=H/G</td>
		<td style='height:15px;'>J=F/H</td>
	    <td style='height:15px;'>K</td>
        <td style='height:15px;'>L</td>
	<td style='height:15px;'>M = K/G</td>
		<td style='height:15px;'>N = L/ H</td>
        \</tr> </thead>
    <tbody>";


	
	$i=1;
	$lmt=0;
	$proj=0;
	$tdate=0;
	$ydate=0;
	$expt=0;
	$tbill=0;
	$tbill_y=0;
	$avg_t=0;
	$avg_y=0;
	$tprod_t=0;
    $tprod_y=0;
    $avgpro_t=0;
	$avgpro_y=0;

//excel file generator

 
 //$html="<table border='1'>";


 //$html.='</table>';
// echo $html;
 //echo $hig_row;
 


//end of excel file generator
	$i1=1;
    while($rowsss=mysqli_fetch_array($sel_from_salesmis))
	{    
		 $loc=$rowsss['LOCATION'];
		  $loc=str_replace("Dreamcann Foods Pvt. Ltd. (","",$loc);
		 $loc=str_replace(")","",$loc); 	
		$loc=str_replace("Dreamcann Foods Pvt.Ltd.(","",$loc);

              foreach($objphpexcel->getWorksheetIterator() as $w)
               {
	             $hig_row=$w->getHighestRow();
	             for($rows=2;$rows<=$hig_row;$rows++)
	             {
		             $location_check=$w->getCellByColumnAndRow(1,$rows)->getValue();
		             $target=$w->getCellByColumnAndRow(2,$rows)->getValue();
                   // $target;
                  for($i=0;$i<=count($array);$i++)
                  {  
                     if(trim($location_check)==trim($loc))
		              {   
                           echo "<tr style='height:25px;padding: 4px;' >
                          <td style='height:15px;'>".$i1++."</td>
                          <td style='height:15px;'>".$location_check."</td>
		                  <td style='height:15px;'>".$rowsss['LMT']."</td>
                          <td style='height:15px;'>".$target."</td>
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
	
                          </tr>";
    	                  $lmt+=$rowsss['LMT'];
		                  $proj+=$target;

		                  $expt+=$rowsss['EXPT'];
		                  $tdate+=$rowsss['TDATE'];
                          $tbill+=$rowsss['TBILL_T'];
                		 $tbill_y+=$rowsss['TBILL_Y']; 
		                 $avg_t+=$rowsss['AVG_SALE_T'];
						 $avg_y+=$rowsss['AVG_SALE_Y'];
		 				 $tprod_t+=$rowsss['TPROD_T'];
		 				 $tprod_y+=$rowsss['TPROD_Y'];
		 			     $avgpro_t+=$rowsss['AVGPRODPBILL_T'];
		 				 $avgpro_y+=$rowsss['AVGPRODPBILL_Y'];
                          break;
                    }                      

                   }                 
                      
	              }
         	}

      }
     $tbill_a=$tbill_y/$i1;
     $avggpro1=$avgpro_y/$i1;
	 $lmt=round($lmt,2);
	 $proj=round($proj,2);
	 $expt=round($expt,2);
	 $tdate=round($tdate,2);
	 $ydate=round($ydate,2);
	 $tbill_r=round($tbill,2);
	 $tbill_a_r=round($tbill_a,2);
	 $avg_t_r=round($avg_t,2);
	 $avggpro1_r=round($avggpro1,2);	 
	 echo "<tr style='height:25px;padding: 4px;'>
        <td style='height:15px;'></td>
        <td style='height:15px;'>Total</td>
		<td style='height:15px;'>".$lmt."</td>
        <td style='height:15px;'>".$proj."</td>
  <td style='height:15px;'>".$expt."</td>
        <td style='height:15px;'>".$tdate."</td>
        <td style='height:15px;'>".$ydate."</td>
        <td style='height:15px;'>".$tbill_r."</td>
		<td style='height:15px;'>".$tbill_a_r."</td>
        <td style='height:15px;'>".$avg_t_r."</td>
		<td style='height:15px;'>".$avg_y/$i1."</td>
	    <td style='height:15px;'>".$tprod_t."</td>
        <td style='height:15px;'>".$tprod_y."</td>
	<td style='height:15px;'>".$avgpro_t/$i1."</td>
		<td style='height:15px;'>".$avggpro1_r."</td>
		</tr>";

     echo  "</tbody>
	  </table> ";	
 

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Signin Template for Bootstrap</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>
  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
padding: 4px;}table>thead:first-child>tr:first-child>th {
    border-top: 10px;
    padding: inherit;
}
table>thead:first-child>tr:first-child>th {
    border-top: 0px;
    padding-bottom: 40px;
text-align: center;}
  .table>thead:first-child>tr:first-child>th {
    border-top: 0;
    font-size: small;
}.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 4px; font-size: small;
}
  </style>
  	<script src="js/jquery.js"></script>
		<script src="jquery.table2excel.min.js"></script>
<body> 
<br/>
 
 <br/>
 <br/>
<!---<button id='sub' class='btn btn-success'>excel file</button>-->

		<script>
			 $(document).ready(function() {
				 //$("#sub").click(function(){
		    		$(".table-bordered").table2excel({
			   		exclude: ".noExl",
					name: "Excel Document Name",
					filename: "MIS12",
					fileext: ".xls",
					exclude_img: true,
					exclude_links: true,
					exclude_inputs: true
					});
				//alert("wefwe");
				  //});
			});
		</script>
  </body>

 </html>