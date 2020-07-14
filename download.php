<?php

session_start();
if (!isset($_SESSION['name'])){
    $_SESSION['msg'] = "To download the books, you need to first sign in. Please sign in or create an account.";
    header("Location: login.php");
}

$remoteURL = "upload/".$_GET['file'];

// Force download
header('Content-Type: application/pdf');
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=".basename($remoteURL));
ob_end_clean();
readfile($remoteURL);
exit;
?>