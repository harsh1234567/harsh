<?php
 require 'PHPMailer/PHPMailerAutoload.php';

  //  echo "ecvr"; 
  error_reporting(1);
    include('conn.php');
   extract($_POST);
    ini_set('max_execution_time', 400); 

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
	 $insert_in_sales_y="insert into salesmis (LOCATION, SALE_YDAY,	TBILL_Y,	AVG_SALE_Y,	TPROD_Y,AVGPRODPBILL_Y) value('$cname','$sales_y', '$tbill_y','$avg_sale_y','$tprod_y','$avgprodpbill_y')";
	 $insert_y=mysqli_query($conn,$insert_in_sales_y); 
	} 
 //================
 
 $sel11="SELECT LOCATION, SUM(sale_lmt) AS LMT, SUM(sale_proj) AS PROJ, SUM(sale_e) EXPT, SUM(SALE_TDATE) AS TDATE,SUM(sale_yday) as YDATE, SUM(TBILL_T) as TBILL_T,SUM(TBILL_Y) as TBILL_Y, SUM(AVG_SALE_T) AS AVG_SALE_T, SUM(AVG_SALE_Y) AS AVG_SALE_Y,  SUM(TPROD_T) AS TPROD_T, SUM(TPROD_Y) AS TPROD_Y, SUM(AVGPRODPBILL_T) AS AVGPRODPBILL_T , SUM(AVGPRODPBILL_Y) AS AVGPRODPBILL_Y FROM salesmis GROUP BY location";
 $sel_from_salesmis=mysqli_query($conn,$sel11);
	$msg1= "<table class='table table-bordered table-hover' style='height:25px; padding: 4px;' >
    <tbody>"; 


	
           
        
   $c=1;
   if(mysqli_num_rows($sel_from_salesmis)>0)
   {    //echo "crwerse";
     
         //   echo mysqli_num_rows($sel_from_salesmis);
     //   echo mysqli_num_rows($sel_from_salesmis);
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




               $mysql_query=mysqli_query($conn,"select * from cafeinfo where CNAME='".$rowsss['LOCATION']."'");
               $row_c=mysqli_fetch_array($mysql_query); 	
                 $email_to=$row_c['Email'];
               $msg.= "<tr>
              <td><strong>LOCATION</strong></td>
             <td style='height:15px;'>".$location_check."</td></tr>
            <tr>
           <td><strong>Sale Last Month (".$pre.")</strong></td>
	     	<td style='height:15px;'>".$rowsss['LMT']."</td></tr>
            <tr><td><strong>Projection  (".$curr.")</strong></td>
          <td style='height:15px;'>".$target."</td></tr>
          <tr>
          <td><strong>Expected  (".$curr.")</strong></td>
          <td style='height:15px;'>".$rowsss['EXPT']."</td></tr>
          <tr>
          <td><strong>Sale - Cumulative from 1st day of the month to ".$today." (Net of Taxes)</strong></td>
		
         <td style='height:15px;'>".$rowsss['TDATE']."</td></tr>
          <tr>
          <td><strong>Sale of yesterday ".$yes."</strong></td>
          <td style='height:15px;'>".$rowsss['YDATE']."</td></tr>
         <tr>
             <td><strong>No. of Invoice issued from ".$curr." to ".$today."</strong></td>
         <td style='height:15px;'>".$rowsss['TBILL_T']."</td>
         </tr>
         <tr>
		  	<td><strong>No. of Invoices issued on</strong></td>
          <td style='height:15px;'>".$rowsss['TBILL_Y']."</td></tr>
         
         <tr>
          <td><strong>Average Bill Value</strong></td>

          <td style='height:15px;'>for current date:<br/>".$rowsss['AVG_SALE_T']."</td>
          <br/>
	    <td style='height:15px;'>for yesterday date:<br/>".$rowsss['AVG_SALE_Y']."</td></tr>
        <tr>
       <td>Total No. of Products sold from 1st day of month to ".$today."</td>
		<td style='height:15px;'>".$rowsss['TPROD_T']."</td></tr>
	    <tr>
	   <td><strong>Total No. of Products sold yesterday ".$yes."</strong></td>
		<br/>
	   <td style='height:15px;'>".$rowsss['TPROD_Y']."</td></tr>
		 <tr>
		 <td ><strong>Average Products Per Bill</strong></td>
		 <td style='height:15px;'>for current date:<br/>".$rowsss['AVGPRODPBILL_T']."</td>
		 
	 <td style='height:15px;'>for yesterday date:<br/>".$rowsss['AVGPRODPBILL_Y']."</td>	
	  </tr></table></tbody>
	  </table> ";		
             $mail_to="ariharsh1994@gmail.com";
	         $from="ariharsh1994@gmail.com";
   // $to=$row_c['Email']
    //$to      = 'ariharsh1994@gmail.com';
//	$to="ariharsh1994@gmail.com";
    $subject = 'mis detail';
    $headers = 'From: ariharsh1994@gmail.com' . "\r\n" .
           'Reply-To: ariharsh1994@gmail.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();
   //$add_email="";
      $i=1;
   

$mail = new PHPMailer;

$mail->isSMTP();      
//echo "<br/>";                             // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                            // Enable SMTP authentication
$mail->Username = 'ariharsh1994@gmail.com';   //email        // SMTP username
$mail->Password = 'pythonsep123'; // SMTP password
$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                 // TCP port to connect to

$mail->setFrom('ariharsh1994@gmail.com', '');
$mail->addReplyTo($email_to, 'formation');
$mail->addAddress($email_to);   // Add a recipient
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->isHTML(true);  // Set email format to HTML


$mm=$msg1.$msg;
$mail->Subject = $row_c['LOCATION']."mis dated (".$today.")";
$mail->Body    = $mm;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} 

      //  echo "<script> alert('your mail is sent successfully!!'); window.location.href ='mis.php'</script>";
   $msg="";
        break;
                    }                      

                   }                 
                      
                }
          }

   }
 
} else{
	
        echo "<script> alert('no data found!! pls check for another entry !!'); window.location.href ='mis.php'</script>";
   }        
?>