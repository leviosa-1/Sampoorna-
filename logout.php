<?php
session_start();
session_unset();
session_destroy();
ob_start();
header("location:Sampoorna.php");
ob_end_flush(); 
include 'Sampoorna.php';
exit();
?>