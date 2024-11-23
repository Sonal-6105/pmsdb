<?php
$fileName=$_FILES['upload_document']['name']; // The file name
$fileTmpLoc  = $_FILES['upload_document']['tmp_name'];// File in the PHP tmp folder
$fileType = $_FILES['upload_document']['type']; // The type of file it is
$fileSize = $_FILES['upload_document']['size']; // File size in bytes
$fileErrorMsg = $_FILES['upload_document']['error']; // 0 for false... and 1 for true


?>