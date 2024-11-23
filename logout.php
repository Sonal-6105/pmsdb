<?php
	session_name('pmsdb');
	session_start();
	session_destroy();
	header("Location:index.php");
	exit;
?>