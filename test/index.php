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
    <<title>Signin Template for Bootstrap</title>
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>
  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
padding: 4px;}
  </style>
  </head>

  <body>
<div class='row'>
<div class='col-md-2'>
</div>
<div class='col-md-4'>

  <div id='msg'>ge rgtr</div>
  <fieldset class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id ='email' placeholder="Enter email">
    <small class="text-muted">We'll never share your email with anyone else.</small>
  </fieldset>
  <fieldset class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id='password' placeholder="Password">
  </fieldset>
  <fieldset class="form-group" >
    <label for="exampleSelect1">stream</label>
    <select class="form-control"  id='strm'>
      <option value=' btech'>B-TECH</option>
      <option value='mtech'>M-TECH</option>
      <option value='mca'>MCA</option>
    </select>
  </fieldset>
  
  <fieldset class="form-group">
    <label for="exampleTextarea"> address</label>
    <textarea class="form-control" id='addr' rows="3"></textarea>
  </fieldset>
  
  <button class="btn btn-primary" id='submit'>Submit</button>

</div>
</div><script src="js/jquery-1.11.1.min.js">
		</script>
        <script>
		   $(document).ready(function(){
			    //$("#msg").hide();
             $("#submit").click(function(){
                     //alert("cerwe");       
			    var email=$("#email").val();
                 var pass=$("#password").val();
			    var strm=$("#strm").val();
				var addr=$("#addr").val();
				  
				 var msg1='email='+email+'&pass='+pass+'&strm='+strm+'&addr='+addr;
              alert(msg1);
			$.ajax({
    type: "GET",
   url: "welcome.php",
   data: msg1,
   cache: false,
  success: function(data){
	//  $('#msg').show();
     $("#msg").text(data);
  }
});     
    
			 });
}); 
		</script>
   </body>
</html>
