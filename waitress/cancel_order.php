<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
require_once("includes/connection.php");

if(isset($_GET["table_no"])){
	
	$table_no = $_GET["table_no"];
	
	$dorder = mysqli_query($conn, "DELETE FROM orders WHERE order_table = '{$table_no}'");
	
	$dbill = mysqli_query($conn, "DELETE FROM bills WHERE bill_table = '{$table_no}'");
	
	$zero = "0";
	$utable = mysqli_query($conn, "UPDATE tables SET table_status = '{$zero}' WHERE table_no = '{$table_no}'");
	
	if($utable == TRUE){
		header("Location: summary.php?table_no=$table_no");
	}
}
}else{
header("Location: ../index.php");
}
?>