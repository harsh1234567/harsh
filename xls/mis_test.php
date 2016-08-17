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
        $dt->modify('last day of this month') ;
     $tdays= $dt->format('d');
     "</br>.tdays.";
     $tdays;
      $set=mysqli_query($conn,'delete from salesmis');
      $sel="SELECT CNAME, sum(value) AS SALES_MT, ((sum(value))*1.1) AS SALES_MI FROM dailymis where mt='".$pre."' GROUP BY CNAME ";
      $set1=mysqli_query($conn,$sel);
   //   $i=1;
      while($row=mysqli_fetch_array($set1))
      {
         	 $cname = $row['CNAME'];
	         $sales_mt=$row['SALES_MT'];
	         $sales_mi= $row['SALES_MI'];
	   // echo $cname."</br>";

	     $insert_in_sales="insert into salesmis (Location,SALE_LMT,SALE_PROJ) values('".$cname."','".$sales_mt."','".$sales_mi."')";
	     $insert=mysqli_query($conn,$insert_in_sales);

      //"a1"; 
 }


