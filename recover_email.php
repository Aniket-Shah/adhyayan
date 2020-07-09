
<?php

session_start();

?>
<!DOCTYPE html>
<html>
<head>
  <title>Sign Up</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./static/signup.css">
  <link
			href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&display=swap"
			rel="stylesheet"
		/>
</head>
<body>
<?php
include'databaseconnection.php';

if (isset($_POST['submit']))//User na submit kiya ya nhi iska liya ya hai
{
  $email = mysqli_real_escape_string($con,$_POST['email']);
  
  $emailquery = " select * from users where email='$email'";
  $query = mysqli_query($con , $emailquery);

  $emailcount= mysqli_num_rows($query);

  if($emailcount)
    {
        $data =mysqli_fetch_assoc($query);
        $name =$data['name'];
        $token=$data['token'];


        $subject = "Password Reset";
        $body = "Hi, $name. Click here to reset your password http://localhost/project/reset_password.php?token=$token";
        $sender_email = "From: het.adhyayan@gmail.com";

        if (mail($email, $subject, $body, $sender_email)) 
        {
            $_SESSION['msg']="Check your mail to reset your password $email";
            header("Location:login.php");    
        }else{
                echo "Email sending failed...";
            }         
    } else{
        echo "No Email Found";
    }
}
?>
<div class="container" style="max-width: 50%;max-height: 50%;; font-family: 'Cormorant Garamond', serif;">
  <h2 align="center">Recover Your Account</h2>
  <p>Please fill your email properly</p>
  <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="form-group">
      <label for="email"><b>Email:</b></label>
      <input type="email" class="form-control" placeholder="Enter email" name="email" required>
    </div>
    <button type="submit" name="submit" class="btn btn-full" style="	border: 1px solid black;color:white;">Send Mail</button>
  </form>
</div>
</body>
</html>
