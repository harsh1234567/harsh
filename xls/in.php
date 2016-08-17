
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

  
 

  <button id='sub' class='btn btn-success'>excel file</button>
  <table class='table table-bordered'><tr><td>harsh</td>
  <td>jain</td></tr></table>
  

		<script>
			$(function() {
			$("#sub").click(function(){
				$(".table-bordered").table2excel({
					
					exclude: ".noExl",
					name: "Excel Document Name",
					filename: "xsl",
					fileext: ".xls",
					exclude_img: true,
					exclude_links: true,
					exclude_inputs: true
				});
				alert("fwef");
			});
			});
		</script>
  </body>

 </html>