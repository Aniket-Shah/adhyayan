<?php

session_start();

?>
<!DOCTYPE html>
<html>
<head>
  <title>Log In</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="static/signup.css">
  <link  rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,300,700,800" rel="stylesheet" media="screen">
  <link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
		/>
</head>
<?php

include'databaseconnection.php';

if (isset($_POST['submit']))
{
    $email = $_POST['email'];
    $password = $_POST['pswd'];
    $email_search = "select * from users where email='$email' and status='active'";
    $query = mysqli_query($con,$email_search);    
    $email_count = mysqli_num_rows($query);
    if($email_count){        
        $email_pass = mysqli_fetch_assoc($query);
        $db_pass = $email_pass['password'];
        $pass_decode = password_verify($password, $db_pass);      
        echo "pass decode: ".$pass_decode;
        $_SESSION['name'] = $email_pass['name'];
        if($email_pass['name'] === 'admin') {
          header('Location: upload.php');
        }  
        if($pass_decode){
            echo"Login Successful";
            header('Location: Profile_Page.php');
        }else{
            echo"Password Incorrect";
        }
    }else{
        echo"Invalid Email";
    }
}

?>
<body>
<div>
  <p class="bg-success text-white px-4">
    <?php

      if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
      }else{
        echo $_SESSION['msg'] = "You are again logged Out. Please login again.";
      }
    ?>
  </p>
</div>
<div class="container" style="max-width: 50%;max-height: 50%; font-family: 'Montserrat', sans-serif;">
  <h2 align="center" style="color: white;" class="animate__animated animate__backInDown">Login Account</h2>
  <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="form-group animate__animated animate__backInDown" >
      <label for="email"><b>Email:</b></label>
      <input type="email" class="form-control" placeholder="Enter email" name="email" required>
    </div>
    <div class="form-group animate__animated animate__backInDown">
      <label for="pwd"><b>Password:</b></label>
      <input type="password" class="form-control" placeholder="Enter password" name="pswd" required>
    </div>
    <button type="submit" name="submit" class="btn btn-full animate__animated animate__backInDown" style="border: 1px solid black; color:white;">Login Now</button>
    <p class="text-center animate__animated animate__backInDown"  style="color:white;">Forgot Your Password No Worry?<a href="recover_email.php" style="color: skyblue; text-decoration: none; text-transform: uppercase;"><b>Click here</b></a></p> 
    <p class="text-center animate__animated animate__backInDown"  style="color:white;">Not Have An Account?<a href="signup.php" style="color: skyblue; text-decoration: none; text-transform: uppercase;"><b>Sign Up</b></a></p>
  </form>
</div>
</body>
</html>