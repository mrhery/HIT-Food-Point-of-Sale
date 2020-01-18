<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
require_once("includes/connection.php");

if(isset($_GET["customer"])){
	
	$customer = $_GET["customer"];
	
	$dorder = mysqli_query($conn, "DELETE FROM orders WHERE order_table = '{$customer}'");
	
	$dbill = mysqli_query($conn, "DELETE FROM bills WHERE bill_table = '{$customer}'");
	
	if($dbill == TRUE){
		header("Location: ta_summary.php?customer=$customer");
	}else{
		header("Location: ta_summary.php?customer=$customer");
	}
}
}else{
header("Location: ../index.php");
}
?>