<?php
$remoteURL = "upload/".$_GET['file'];

// Force download
header('Content-Type: application/pdf');
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=".basename($remoteURL));
ob_end_clean();
readfile($remoteURL);
exit;
?>