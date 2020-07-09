<?php
include 'databaseconnection.php'; 

$sql = "Select * from book";

$result = mysqli_query($con, $sql);

while($row = $result->fetch_assoc())
{

$str = $row['board']."/".$row['std']."/".$row['file_name']
?>

<a href="abc.php?file=<?php echo $str ?>" target="_blank"> Download</a>
<?php
}
?>