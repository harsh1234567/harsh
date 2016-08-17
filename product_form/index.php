<?php session_start();
 require('conn.php');
$mysql=mysqli_query($conn,"select * from cafeinfo ");

//echo mysqli_num_rows($mysql);
?>
<?php
extract($_POST);
if(isset($btn_l))
{
    $user_n=mysqli_real_escape_string($conn,$username);
    $password=mysqli_real_escape_string($conn,$password);
    $location=mysqli_real_escape_string($conn,$location);
   
  
   
    $sel="select * from  login where  user_name='".$user_n."' and password='".$password."'  and location_id='".$location."' ";
    $mysql11= mysqli_query($conn,$sel);
//echo "crt";
   // echo "f45";
  
      //     echo mysqli_num_rows($mysql11);
           if(mysqli_num_rows($mysql11)>0)
           {
          $rowss=mysqli_fetch_array($mysql11);
               $_SESSION['id']=$rowss[0];
               // $_SESSION['location_id']=$rowss[3];
           header('location:home.php');
        //   echo "erct";
        }else{
          $msg= "<font color:'red'>you are the wrong user !</font>";
        }
  
}



?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="css/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Dreamcann</b>OPS</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
  <form method="POST" action="#">
    <p class="login-box-msg">Sign in to Dreamcann </p>
                  
                  <div id="msg11">
                    <?php
                   if(isset($msg) && !empty($msg))
                   {
                     echo $msg;
                   }
            
                      ?>

                  </div>
      <div class="form-group has-feedback">
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon1">user name </span>
        <input type="text" class="form-control" name="username" id="email" placeholder="user name">
        </div>
      </div>
      <div class="form-group has-feedback">
      <div class="input-group">
          <span class="input-group-addon" id="basic-addon1">password </span>
        
        <input type="password" name="password" class="form-control" id="pass" placeholder="Password">
       </div>
      </div>
    
      <div class="form-group has-feedback">
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon1">location name </span>
        
        <select name='location' class='form-control'>


     <?php while($rowss=mysqli_fetch_array($mysql)){

        echo    "<option value=".$rowss['0'].">".$rowss['LOCATION']."</option>";
         


      }?>
        </select>
   </div>
      </div>
    

          <button type="submit" id="btn_l" name="btn_l" class="btn btn-primary btn-block btn-flat">Sign In</button>
        <!-- /.col -->
  
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>

<script>
   $(document).ready(function() {
           $("#msg").hide();
        $("#btn_l").click(function(){
       
               var email=$("#email").val();
               var pass=$("#pass").val();
      
       var  msg1="email="+email+"&pass="+pass;     
            alert(msg1);
            $.ajax({
  type: "POST",
  url: "log.php",
  data: msg1,
  cache: false,
  success: function(data){
    $('#msg').show();
     $("#msg").html(data);
    // alert(data);
  }
});     
       //    alert(email+pass);
         });
    });
</script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
