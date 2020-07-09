<?php

$server = "localhost";
$user = "root";
$password = "";
$db = "adhyayan";

$con = mysqli_connect($server ,$user ,$password ,$db);

if($con){
    ?>
        <script>
            console.log("Connection Successful");
        </script>
    <?php
}else{
    ?>
        <script>
            console.log("No Connection");
        </script>
    <?php
}

?>