<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
require_once("includes/connection.php");

if(isset($_GET["order_id"], $_GET["table_no"])){
	
	$order_id = $_GET["order_id"];
	$table_no = $_GET["table_no"];
	
	$qorder = mysqli_query($conn, "SELECT * FROM orders WHERE order_id = '{$order_id}'");
	$rorder = mysqli_fetch_array($qorder);
	$order_quantity = $rorder["order_quantity"];
	$order_price = $rorder["order_price"];
	$new_quantity = $order_quantity - "1";
	$new_total = $order_price * $new_quantity;
	
	$back = $_SERVER['HTTP_REFERER'];
	
	if($order_quantity > 1){
	
		$uorder = mysqli_query($conn, "UPDATE orders SET order_quantity = '{$new_quantity}', order_total = '{$new_total}' WHERE order_id = '{$order_id}'");
	
		if($uorder == TRUE){
			header("Location: $back");
		}else{
			echo "Error in updating query.";
		}
		
	}else{
		
		$dorder = mysqli_query($conn, "DELETE FROM orders WHERE order_id = '{$order_id}'");
		
		if($dorder == TRUE){
			header("Location: $back");
		}else{
			echo "Error in deleting query.";
		}
		
	}
}
}else{
header("Location: ../index.php");
}
?>