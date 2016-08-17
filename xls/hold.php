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
		
		<th>Sale of yesterday ".$yes."</th>
	</tr>";
	echo "<tr style='height:25px;padding: 2px;'>
        <td style='height:15px;'></td>
        <td style='height:15px;'></td>
		<td style='height:15px;'></td>
        <td style='height:15px;'></td>
       
        <td style='height:15px;'>Say by ".$day." day</td>
      </tr>";
	echo "<tr style='height:25px;padding: 4px;'>
        <td style='height:15px;'></td>
        <td style='height:15px;'>A</td>
		<td style='height:15px;'>B</td>
        <td style='height:15px;'>C</td>
        <td style='height:15px;'>E</td>
        \</tr> </thead>
    <tbody>";


	
	$i=1;
	$lmt=0;
	$proj=0;
	$tdate=0;

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
	  
		 //get the excel data
//           echo $loc;

            foreach($objphpexcel->getWorksheetIterator() as $w)
 {
	 $hig_row=$w->getHighestRow();
	 for($rows=2;$rows<=$hig_row;$rows++)
	 {
		 //$html.="<tr>";
		 //$name=$w->getCellByColumnAndRow(0,$rows)->getValue();
		  $location_check=$w->getCellByColumnAndRow(1,$rows)->getValue();
		  echo $location_check;
		  //echo $target;
	      $target=$w->getCellByColumnAndRow(2,$rows)->getValue();
		  echo $target; 
	     $a=0;
	     //  echo $target;
	    for($i=0;$i<count($array);$i++)
        {  
            
         //    $pro;
        
          //  echo $array[$i];
            		 
          if(trim($location_check)==trim($array[$i]))
		  {   
		  	 $a=1;
             $target=$w->getCellByColumnAndRow(2,$rows)->getValue();
		    $pro=$target;   
		    echo $target;
        //     $a=0;
	        //echo $target;


		     echo "<tr style='height:25px;padding: 4px;' >
              <td style='height:15px;'>".$i1++."</td>
              <td style='height:15px;'>".$location_check."</td>
		     <td style='height:15px;'>".$rowsss['LMT']."</td>
            <td style='height:15px;'>".$pro."</td>
           <td style='height:15px;'>".$rowsss['TDATE']."</td>
           </tr>";
    	   $lmt+=$rowsss['LMT'];
		   $proj+=$pro;
		   $tdate+=$rowsss['TDATE'];
		 $pro=0;
	    }
         
		}
		if($a==1)
		{
			break;
//			$pro=0;
		}


		//  echo $pro;
		// $html.='<td>'.$name.'</td>';
		 //$html.='<td>'.$email.'</td>';
		 
		
		 //$html.="</tr>";
	}
	$pro=0;
	 
 } 
		// echo $pro;
		 // end of excel data
		 
	}		 
	 
	 echo "<tr style='height:25px;padding: 4px;'>
        <td style='height:15px;'></td>
        <td style='height:15px;'>Total</td>
		<td style='height:15px;'>".$lmt."</td>
        <td style='height:15px;'>".$proj."</td>
 
        <td style='height:15px;'>".$tdate."</td></tr>";

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