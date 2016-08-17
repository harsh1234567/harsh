
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
padding: 4px;}
  </style>
   <script>     function showUser(str)
	  {
		  
		  
		  var monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];

         var d = new Date(str);
         var curr_month=monthNames[d.getMonth()];
		 var temp=d.getMonth();
		 var temp1=d.getMonth();
		 
		 //alert(temp);
         if(temp==0)
		 {
			temp=11;
		 //alert("efe");
		 }
		 else{
	        // alert("efe");		 
			 temp=d.getMonth()-1;
		 }
		// alert(temp);
	//alert(temp);
	

		 var pre_month=monthNames[temp];		
   	   	 
		 var curr_year=d.getFullYear();
		 
         var newDate=d.getDate()-1;  
        if(newDate==0)
		{ if(pre_month=='July' ||pre_month=='september' ||pre_month=='June' ||pre_month=='April'&& pre_month!='February' )
		 {
			 newDate=30;
			 curr_month=monthNames[temp];
		 }
		 else if(pre_month!='February')
		 {
			newDate=31; 
			
			 curr_month=monthNames[temp];
			
			 
		 }else 
		 {
			 if((curr_year % 4==0) && (curr_year % 100!=0) ||(curr_year % 400==0))
			 {
				 newDate=29;
				 
			 }else{
				 
				 newDate=28;
			 }
			 
			 curr_month=monthNames[temp];
		}
		
		 document.getElementById("yester").value = newDate+"-"+curr_month+"-"+curr_year;
    
	 document.getElementById("pre_m").value = pre_month+"-"+curr_year;
    
	 document.getElementById("curr_m").value = monthNames[temp+1]+"-"+curr_year;
		
		}else{
	 document.getElementById("yester").value = newDate+"-"+curr_month+"-"+curr_year;
    
	 document.getElementById("pre_m").value = pre_month+"-"+curr_year;
    
	 document.getElementById("curr_m").value = curr_month+"-"+curr_year;
		 }
//var newDate = (array[2] + "." + array[1] + "." + array[0]);
  
	  }
    </script>
  </head>

  <body>

    <div class="container">
      <div class='panel panel-primary'>
	     <div class='pane panel-heading'><h2>daily mis gernator </h2></div>
	      <div class='panel panel-body'>
      <div class='row'>
      <div class='col-md-2'></div>	  
        <div class='col-md-8'>		
		<div class='row'>
          <form method="POST" action='xls.php' >
		 <div class='col-md-4'>
             	<label> today</label>
				<input type='date'  id='today'  name="today" onchange="showUser(this.value)" class='form-control'/>
		   </div>
            <div class='col-md-4'>
             <label>curr month</label>	
<input type='text' class='form-control'  id='curr_m'  value="" name="curr" readonly="readonly"/>			 
		   </div>			   
 		  </div>
		    <div class='row'>
            <div class='col-md-4'>
             	<label>Yesterday</label>
				<input type='text' class='form-control' id='yester' value="" name="yes"  readonly="readonly"/>
		   </div>
            <div class='col-md-4'>
             	<label>previous month</label><input type='text'  id='pre_m' value="" name="pre" class='form-control' readonly="readonly"/>
				 
		   </div>			   
 		  </div>
		  <br/>
		  <div  style='padding-left:190px;'>
		   <input  name="submit" type="submit" class='btn btn-primary' value='mis 1'/>
		    <input  name="submit1" type="submit" class='btn btn-success' value='mis 2'/>
		  
		  </div>
		  </form>
		 </div>
		</div>
		 </div>
    </div>
 <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  </body>
</html>
