

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

    <!link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="signin.css" rel="stylesheet">
	<style>tr {
   max-height: 25px !important;
   height: 25px !important;
}.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
padding: 4px;}

	</style>
<body>
 <?php
 
include "RefreshVoucher.php";
include "FunTallyRequest.php";
include "FunXmlTOmysql.php";
include "conn.php";
  //$company =   "Dreamcann Foods Pvt.Ltd.(American Exp.)";
  ?>
 <?php 
echo RefreshVoucher();
	 //$sel ="SELECT CNAME, SUM(VALUE) AS SALE,COUNT(MASTERID) AS TOT_V, MIN(masterid) AS F_MID, Min(VDATE) AS F_VDATE, MAX(VDATE) AS LAST_VDATE, MAX(vouchernumber) AS LAST_VNO, MAX(masterid) AS LAST_MID FROM `dailymis`  where MT >= 'April-2016' GROUP BY cname ORDER BY LAST_VDATE ASC";//where MT >= 'April-2016'
	 $sel="SELECT d.SALE, d.tot_v AS TOT_V, d.F_MID AS F_MID, d.F_VDATE, d.LAST_VDATE, d.LAST_VNO, d.LAST_MID, c.* FROM cafeinfo c LEFT JOIN ( SELECT CNAME, SUM( VALUE ) AS SALE, COUNT(MASTERID) AS TOT_V, MIN(masterid) AS F_MID, MIN(VDATE) AS F_VDATE, MAX(VDATE) AS LAST_VDATE, MAX(vouchernumber) AS LAST_VNO, MAX(masterid) AS LAST_MID FROM `dailymis` WHERE MT >= 'April-2016' GROUP BY cname ORDER BY LAST_VDATE ASC ) d ON c.cname = d.cname WHERE d.tot_v > 0 ORDER BY d.LAST_VDATE";
	 $sell=mysqli_query($conn,$sel);
	 //echo "<div class="container">";
     echo "<table class='table table-hover' style='height:25px;' > 
    <thead>
      <tr>
        <th>SL</th>
        <th>Location</th>
		<th>VALUE</th>
		<th>FVDATE</th>
		<th>FMID</th>
		<th>TPass</th>
		<th>CPerson</th>
		<th>ContNo</th>
		<th>Email</th>
        <th>Tot_Tr</th>
        <th>LVDate</th>
		<th>LVNo</th>
		<th>LMID</th>
		
		<th>Action</th>
      </tr>
    </thead>
    <tbody>";
     echo "<form method='post'>";
	 $i=1;
 	 while($rows=mysqli_fetch_array($sell))
	 {
		 
		 //   str_replace("world","Peter","Hello world!")
		 $loc=str_replace("Dreamcann Foods Pvt.Ltd.("," ",$rows['CNAME']);
		 $loc=str_replace("Dreamcann Foods Pvt. Ltd. ( "," ",$loc);
		 $loc=str_replace(")","",$loc);
	  echo "<tr style='height:25px;'>
        <td style='height:15px;'>".$i++."</td>
        <td style='height:15px;'>".$rows['LOCATION']."<input type='hidden' value='".$rows['CNAME']."' name='cname'/></td>
		<td style='height:15px;'>".$rows['SALE']."</td>
		<td style='height:15px;'>".$rows['F_VDATE']."</td>
		<td style='height:15px;'>".$rows['F_MID']."</td>
		<td style='height:15px;'>".$rows['Password']."</td>
		<td style='height:15px;'>".$rows['ContNo']."</td>
		<td style='height:15px;'>".$rows['CONTPERSON']."</td>
		<td style='height:15px;'>".$rows['Email']."</td>
        <td style='height:15px;'>".$rows['TOT_V']."</td>
        <td style='height:15px;'>".$rows['LAST_VDATE']."</td>
        <td style='height:15px;'>".$rows['LAST_VNO']."</td>
        <td style='height:15px;'>".$rows['LAST_MID']."<input type='hidden' value='".$rows['LAST_MID']."' name='LAST_MID'/></td>
        <td style='height:15px;'><a href='update_m.php?cname=".$rows['CNAME']."&masterid=".$rows['LAST_MID']."' style='height:20px;' class='btn btn-success btn-xs'>submit</a></td>
      
	  </tr>";
    	 
		 
		 
	 }
     echo  "</tbody>
	  </table> ";
	 
  ?>
   

</body>
</html>
 