<?php
    include 'Classes/PHPExcel/IOFactory.php';
	 $objphpexcel=PHPExcel_IOFactory::load('t.xlsx');
	 extract($_POST);
	if(isset($submit))
	{
		 include('mis5.php');
       
		//  echo "<script>window.location.href ='mis.php'</script>";
	}

	if(isset($submit1))
	{
		 include('mis2.php');
       
		//  echo "<script>window.location.href ='mis.php'</script>";
	}
	if(isset($email_s))
 	{//echo "cwergergtr";
       include('send2.php');
	}  
?>