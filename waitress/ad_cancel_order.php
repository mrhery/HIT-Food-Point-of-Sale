<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
require_once("includes/connection.php");

if(isset($_GET["addon"])){
	
	$addon = $_GET["addon"];
	$order_ad = "ad";
	
	$dorder = mysqli_query($conn, "DELETE FROM orders WHERE order_table = '{$addon}' AND order_ad = '{$order_ad}'");
	
	if($dbill == TRUE){
		header("Location: ad_summary.php?addon=$addon");
	}else{
		header("Location: ad_summary.php?addon=$addon");
	}
}
}else{
header("Location: ../index.php");
}
?>