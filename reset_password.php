<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Reset Password</title>
  <link rel = "icon" href="assets/ADHYAYAN.png" type = "image/x-icon">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./static/signup.css">
  <link  rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,300,700,800" rel="stylesheet" media="screen">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>
<body>
<?php
include'databaseconnection.php';

if (isset($_POST['submit']))//User na submit kiya ya nhi iska liya ya hai
{
    if (isset($_GET['token'])){        
                
        $token = $_GET['token'];
        
        $password = mysqli_real_escape_string($con,$_POST['pswd']);
        $cpassword = mysqli_real_escape_string($con,$_POST['cpswd']);

        $pass = password_hash($password , PASSWORD_BCRYPT);
        $cpass = password_hash($cpassword , PASSWORD_BCRYPT);

        if($password === $cpassword){
            $updatequery = " update users set password='$pass', cpassword='$cpass' where token='$token' ";
            $iquery =mysqli_query($con, $updatequery);
            if($iquery)
            {
                $_SESSION['msg'] = 'your password has been update';
                header('location:login.php');
            }else{
                $_SESSION['passmsg'] = 'Your password is not updated';
                header('location:reset_password.php');
            }     
        }else{
            $_SESSION['passmsg'] = "Password is not matching";
        }
    }else{
        echo "No token found";
    }
}
?>
<div class="container" style="max-width: 50%;max-height: 50%;	font-family: 'Montserrat', sans-serif;">
  <h2 align="center" style="color: white;" class="" data-aos="fade-up" data-aos-ease="ease-in-out" class="aos-init aos-animate">Change Your Password</h2>
  <form action="" method="POST">
  <p><?php 
    if(isset($_SESSION['passmsg'])){
        echo $_SESSION['passmsg'];
    }else{
        echo $_SESSION['passmsg']="";
    }
    ?></p>
    <div class="form-group" data-aos="fade-up" data-aos-ease="ease-in-out" class="aos-init aos-animate">
      <label for="pwd"><b>New Password:</b></label>
      <input type="password" class="form-control" placeholder="Enter password" name="pswd" required>
    </div>
    <div class="form-group" data-aos="fade-up" data-aos-ease="ease-in-out" class="aos-init aos-animate">
      <label for="cpwd"><b>Comfirm Password:</b></label>
      <input type="password" class="form-control" placeholder="Enter password" name="cpswd" required>
    </div>
    <button type="submit" name="submit" class="btn btn-full" data-aos="fade-up" data-aos-ease="ease-in-out" class="aos-init aos-animate" style="	border: 1px solid black;color:white;">Update Password</button>
  </form>
</div>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
		<script>
			AOS.init();
		  </script>
</body>
</html>