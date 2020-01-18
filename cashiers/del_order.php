<?php
session_start();
if(isset($_SESSION["user_name"])){
require_once("includes/connection.php");

if(isset($_GET["bill_no"], $_GET["table_no"], $_GET["order_id"])){
	
	$bill_no = $_GET["bill_no"];
	$table_no = $_GET["table_no"];
	$order_id = $_GET["order_id"];
	
	$dorder = mysqli_query($conn, "DELETE FROM orders WHERE order_id = '{$order_id}' AND order_table = '{$table_no}'");
	
	if($dorder == TRUE){
		header("Location: added_order.php?table_no=$table_no&bill_no=$bill_no");
	}else{
		echo "Delete Order Query error.";
	}
	
}
}else{
	header("Location: ../index.php");
}

?>