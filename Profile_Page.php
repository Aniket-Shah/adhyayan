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
    <!--nk rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">-->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="">
    <link  rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,300,700,800" rel="stylesheet" media="screen">
    <link  rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link  rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css">
    <link  rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap.min.css">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
    />
    <title>BOOK</title>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0 0 0 0;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: white;
            border: 0px;
        }
        body {
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            line-height: 1.42857143;
            color: black;
            background-color: lightblue;
        }
    </style>
</head>
<body>
    <div class="container animate__animated animate__backInDown">
<?php 
    include 'databaseconnection.php';
    $query = "SELECT * FROM book ORDER BY ID DESC";
    $result = mysqli_query($con , $query);
?>
<button class="btn btn-danger" onclick="document.location.replace('Log_Out.php');" style="float: right; margin-top: 15px;">Log Out</button>
    <h2>Welcome <?php echo$_SESSION['name']; ?></h2>    
    <div class="table-responsive">
        <table id='userTable' class="table table-striped table-bordered nowrap" style="background-color: white; width:100%;">
            <thead>
                <tr>
                    <td class="max-desktop text-center" >Standard</td>
                    <td class="max-desktop text-center" >Board</td>
                    <td class="max-desktop text-center" >Subject</td>
                    <td class="max-desktop text-center" >Download Link</td>
                </tr>
            </thead>
            <?php 
                while ($row = mysqli_fetch_array($result)) {
                    $str = $row['board']."/".$row['std']."/".$row['file_name'];
                    echo'
                    <tr>
                        <td class="max-desktop text-center" style="border: 0px;">'.$row["std"].'</td>
                        <td class="max-desktop text-center" style="border: 0px; text-transform: uppercase;">'.$row["board"].'</td>
                        <td class="max-desktop text-center" style="border: 0px;">'.$row["sub"].'</td>
                        <td class="max-desktop text-center" style="border: 0px;"><a href="download.php?file='.$str.'">Download</a></td>
                    </tr>
                    ';
                }
            ?>
        </table>
    </div>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap.min.j"></script>
    <script>
        $(document).ready(function() {
            $('#userTable').DataTable( {
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal( {
                            header: function ( row ) {
                                var data = row.data();
                                return 'Details for '+data[0]+' '+data[1];
                            }
                        } ),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                            tableClass: 'table'
                        } )
                    }
                }
            } );
        });
    </script>
</body>
</html>
<!--
    git add .
    git commit -m "profile_page updated"
    git push    
-->