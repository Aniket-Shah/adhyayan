<?php

session_start();

?>
<!DOCTYPE html>
<html>
<head>
  <title>Sign Up</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="static/signup.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link  rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,300,700,800" rel="stylesheet" media="screen">
  <link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
		/>
</head>
<?php
include'databaseconnection.php';

if (isset($_POST['submit']))//User na submit kiya ya nhi iska liya ya hai
{
  $name = mysqli_real_escape_string($con,$_POST['user']);
  $email = mysqli_real_escape_string($con,$_POST['email']);
  $phone = mysqli_real_escape_string($con,$_POST['phone']);
  $password = mysqli_real_escape_string($con,$_POST['pswd']);
  $cpassword = mysqli_real_escape_string($con,$_POST['cpswd']);

  $pass = password_hash($password , PASSWORD_BCRYPT);
  $cpass = password_hash($cpassword , PASSWORD_BCRYPT);

  $token = bin2hex(random_bytes(15));

  $emailquery = " select * from users where email='$email'";
  $query = mysqli_query($con , $emailquery);

  $emailcount= mysqli_num_rows($query);

  if($emailcount>0){
    echo "email already exists";
} else{
    if($password === $cpassword){

      $insertquery = "insert into users (name, email, phone, password, cpassword, token, status) 
      values('$name','$email','$phone','$pass','$cpass','$token','inactive')";
      $iquery =mysqli_query($con, $insertquery);
      if($iquery)
      {
        $subject = "Email Activation";
        $body = "Hi, $name. Click here to activate your account http://localhost/project/mail.php?token=$token";
        $sender_email = "From: het.adhyayan@gmail.com";

        if (mail($email, $subject, $body, $sender_email)) {
                $_SESSION['msg']="Check your mail to activate your account $email";
                header("Location:login.php");
        }else{
                  echo "Email sending failed...";
        }
      }else{
        ?>
            <script>
                alert("Password not match");
            </script>
        <?php
      }  
    } else{
        ?>
            <script>
                alert("Password are not matching");
            </script>
      <?php
    }
  }
}
?>
<body>

<div class="container" style="max-width: 50%;	font-family: 'Montserrat', sans-serif;">
  <h2 align="center" style="color: white; margin-top:20px;" class="animate__animated animate__backInDown">Create Account</h2>
  <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="form-group animate__animated animate__backInDown">
      <label for="user"><b>Username:</b></label>
      <input type="text" class="form-control" placeholder="Enter username" name="user" required>
    </div>
    <div class="form-group animate__animated animate__backInDown">
      <label for="email"><b>Email:</b></label>
      <input type="email" class="form-control" placeholder="Enter email" name="email" required>
    </div>
    <div class="form-group animate__animated animate__backInDown">
      <label for="text"><b>Phone Number:</b></label>
      <input type="text" class="form-control" placeholder="Enter phone number" name="phone" required>
    </div>
    <div class="form-group animate__animated animate__backInDown">
      <label for="pwd"><b>Password:</b></label>
      <input type="password" class="form-control" placeholder="Enter password" name="pswd" required>
    </div>
    <div class="form-group animate__animated animate__backInDown">
      <label for="cpwd"><b>Comfirm Password:</b></label>
      <input type="password" class="form-control" placeholder="Enter password" name="cpswd" required>
    </div>
    <button type="submit" name="submit" class="btn btn-full animate__animated animate__backInDown" style="	border: 1px solid black;color:white;">Create Account</button>
  </form>
</div>
</body>
</html>