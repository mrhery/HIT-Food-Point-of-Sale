<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
require_once("includes/connection.php");

if(isset($_GET["order_id"])){
	$order_id = $_GET["order_id"];
	
	$qorder = mysqli_query($conn, "SELECT * FROM orders WHERE order_id = '{$order_id}'");
	$rorder = mysqli_fetch_array($qorder);
	$order_price = $rorder["order_price"];
	$order_total = $rorder["order_total"];
	$order_quantity = $rorder["order_quantity"];
	
	$new_order_total = $order_price + $order_total;
	$new_order_quantity = $order_quantity + 1;
	$uorder = mysqli_query($conn, "UPDATE orders SET order_total = '{$new_order_total}', order_quantity = '{$new_order_quantity}' WHERE order_id = '{$order_id}'");
	$back = $_SERVER['HTTP_REFERER'];
	if($uorder == TRUE){
		header("Location: $back");
	}
}
}else{
header("Location: ../index.php");
}
?>