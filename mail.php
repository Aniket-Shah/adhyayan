<?php

session_start();

include 'databaseconnection.php';

if (isset($_GET['token']))
{
    $token = $_GET['token'];

    $udpatequery ="update users set status='active' where token='$token'";

    $query = mysqli_query($con , $udpatequery);

    if ($query) {
        if(isset($_SESSION['msg'])){
            $_SESSION['msg'] = "Account update successfully";
            header('location:login.php');
        }else {
            $_SESSION['msg']="you are logout";
            header("Location:login.php");
        }
    }else{
        $_SESSION['msg'] = "Account not update";
        header('location:signup.php');
    }
}
?>
