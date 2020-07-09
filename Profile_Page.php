<?php

session_start();
if (!isset($_SESSION['name'])){
    header("Location: login.php");
}

?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&display=swap" rel="stylesheet">
    <link href="">
    <title>BOOK</title>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
</head>
<body>
<?php 
    include 'databaseconnection.php';
    $query = "SELECT * FROM book ORDER BY ID DESC";
    $result = mysqli_query($con , $query);
?>
<button class="btn btn-outline-primary my-2 my-sm-0" onclick="document.location.replace('Log_Out.php');" style="float: right;">Log Out</button>
    <h2>Welcome <?php echo$_SESSION['name']; ?></h2>
    <div class="table-responsive">
        <table id='userTable' class="table table-striped table-bordered display responsive">
            <thead>
                <tr>
                    <td class="max-desktop text-center">Standard</td>
                    <td class="max-desktop text-center">Board</td>
                    <td class="max-desktop text-center">Subject</td>
                    <td class="max-desktop text-center">Download</td>
                </tr>
            </thead>
            <?php 
                while ($row = mysqli_fetch_array($result)) {
                    $str = $row['board']."/".$row['std']."/".$row['file_name'];
                    echo'
                    <tr>
                        <td class="max-desktop text-center">'.$row["std"].'</td>
                        <td class="max-desktop text-center">'.$row["board"].'</td>
                        <td class="max-desktop text-center">'.$row["sub"].'</td>
                        <td class="max-desktop text-center"><a href="download.php?file='.$str.'">Download</a></td>
                    </tr>
                    ';
                }
            ?>
        </table>        
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#userTable').DataTable();
    });
    </script>
</body>
</html>
<!--
    git add .
    git commit -m "profile_page updated"
    git push
-->