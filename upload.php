<?php
    session_start();
    if($_SESSION['name'] !== 'admin') {        
        header("Location: index.html");
    }
    else {
        echo "Welcome Admin.";
    }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Upload</title>
  <link rel = "icon" href="assets/ADHYAYAN.png" type = "image/x-icon">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="static/signup.css">
  <link
			href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300&display=swap"
			rel="stylesheet"
		/>
</head>
<?php
include'databaseconnection.php';

if (isset($_POST['submit']))//User na submit kiya ya nhi iska liya ya hai
{
  $std = $_POST['std'];
  $board = $_POST['board'];
  $sub = $_POST['sub'];  
  $target_dir = "upload/".$board."/".$std."/";
  $file = $target_dir .basename($_FILES['myfile']['name']);

  // destination of the file on the server    
  // get the file extension
  $extension = pathinfo($file, PATHINFO_EXTENSION);

  // the physical file on a temporary uploads directory on the server
  $file_temName = $_FILES['myfile']['tmp_name'];
  $size = $_FILES['myfile']['size'];
  $size /= 1000;

  if (!in_array($extension, ['zip', 'pdf', 'docx','jpg','jpeg','png'])) {
      echo "You file extension must be .zip, .pdf or .docx";
  } elseif ($size > 128000 ){ // file shouldn't be larger than 128mb
      echo "File too large!";
  } else {        
      // move the uploaded (temporary) file to the specified destination
      if (move_uploaded_file($_FILES['myfile']['tmp_name'], $file)) {          
          $sql = "INSERT INTO book (std,board,sub, file_name, size, download) VALUES ('".$std."','".$board."','".$sub."','".$_FILES['myfile']['name']."', ".$size.", 0)";
          if (mysqli_query($con, $sql)) {
              echo "File uploaded successfully.";
          }
      } else {
          echo "Failed to upload file.";
      }
  }
}
?>
<body>
  
<div class="container" style="max-width: 50%; font-family: 'Cormorant Garamond', serif;">
  <p>Click on the "Choose File" button to upload a file:</p>
  <h2 align="center" style="color: white; margin-top:20px;">Upload Books</h2>
  <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="std"><b>Standard:</b></label>
      <input type="int" class="form-control" placeholder="Enter standard" name="std" required>
    </div>
    <div class="form-group">
      <label for="board"><b>Board:</b></label>
      <select name="board">
        <option selected hidden value="">Select Board</option>
        <option value="cbse">CBSE</option>
        <option value="ssc">SSC</option>
      </select>
    </div>
    <div class="form-group">
      <label for="sub"><b>Subject:</b></label>
      <input type="text" class="form-control" placeholder="Enter subject" name="sub" required>
    </div>
    <input type="file" name="myfile" id="myfile">
    <input type="submit" class="btn btn-primary" name="submit">
  </form>
</div>
</body>
</html>