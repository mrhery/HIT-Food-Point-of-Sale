<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
require_once("includes/connection.php");

$bill_waiteress = $user_name;

if(isset($_GET["addon"])){
	
	$addon = $_GET["addon"];
	
	$qsum = mysqli_query($conn, "SELECT SUM(order_total) FROM orders WHERE order_table = '{$addon}'");
	$rsum = mysqli_fetch_array($qsum);
	$order_total = $rsum["SUM(order_total)"];
	
	$bill = mysqli_query($conn, "SELECT * FROM bills WHERE bill_table = '{$addon}' ");
	$num_bill = mysqli_num_rows($bill);
	
	if($num_bill == 1){
		$bill_time = date("H:s:i", time() + 54000);
		$ubill = mysqli_query($conn, "UPDATE bills SET bill_total = '{$order_total}', bill_time = '{$bill_time}' WHERE bill_table = '{$addon}'");
		if($ubill){
			header("Location: ad_summary.php?addon=$addon");
		}else{
			echo "Error updating query.";
		}
		
	}else{
	
		echo "
		
			<script>
				alert('This order cannot be added! Please cancel this order!');
				window.location.replace('ad_summary.php?addon=$addon');
			
			</script>
		
		";
	
	}
}
}else{
header("Location: ../index.php");
}
?>