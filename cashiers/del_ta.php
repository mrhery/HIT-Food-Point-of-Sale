<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
	require_once("includes/connection.php");
	
	if(isset($_GET["customer"], $_GET["order_item"])){
		
		$customer = $_GET["customer"];
		$order_item = $_GET["order_item"];
		
		$qorder = mysqli_query($conn, "SELECT * FROM orders WHERE order_table = '{$customer}' AND order_item = '{$order_item}'");
		$norder = mysqli_num_rows($qorder);
		$rorder = mysqli_fetch_array($qorder);
		
		$nquantity = $rorder["order_quantity"];
		if($nquantity > 0){
			
			$order_quantity = $rorder["order_quantity"];
			$order_price = $rorder["order_price"];
			
			$empty = "";
			$dorder = mysqli_query($conn, "UPDATE orders SET order_adprint = '{$empty}', order_ad = '{$empty}' WHERE order_item = '{$order_item}' AND order_table = '{$customer}'");
			
			header("Location: addon.php");
			
		}
		
		
	}
	
	
}else{
	header("Location: ../index.php");
}
?>