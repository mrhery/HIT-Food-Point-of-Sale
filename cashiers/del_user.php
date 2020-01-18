<?php
session_start();
if(isset($_SESSION["user_name"])){
require_once("includes/connection.php");

if(isset($_GET["user_id"], $_GET["user_section"])){
	$user_id = $_GET["user_id"];
	$user_section = $_GET["user_section"];
	
	if($user_section == "waitress"){
		$duser = mysqli_query($conn, "DELETE FROM users WHERE user_id = '{$user_id}'");
		
		if($duser == TRUE){
			header("Location: db_waiteress_info.php");
		}else{
			echo "Delete User query error";
		}
	}elseif($user_section == "cashier"){
		$duser = mysqli_query($conn, "DELETE FROM users WHERE user_id = '{$user_id}'");
		
		if($duser == TRUE){
			header("Location: db_cashier_info.php");
		}else{
			echo "Delete User query error";
		}
	}	
}
}else{
	header("Location: ../index.php");
}
?>