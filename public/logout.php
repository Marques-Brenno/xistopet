<?php 
session_start();
unset($_SESSION['user']);
unset($_SESSION['CONTROL']);
header("location: index.php");

?>