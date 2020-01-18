<?php
session_start();
require_once("includes/connection.php");

$user_name = $_SESSION["user_name"];
$inactive = "0";
$uuser = mysqli_query($conn, "UPDATE users SET user_status = '{$inactive}' WHERE user_name = '{$user_name}'");

if($uuser == TRUE){
	unset($_SESSION['user_name']);
	
	session_destroy();
	header("location: ../index.php");
}else{
	echo "Update user erorr";
}
?>