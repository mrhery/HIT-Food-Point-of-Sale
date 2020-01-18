<?php
session_start();
if(isset($_SESSION["user_name"])){
require_once("includes/connection.php");

if(isset($_GET["order_bill"], $_GET["table_no"])){
	$today = date("d-M-Y");
	$bill_no = $_GET["order_bill"];
	$table_no = $_GET["table_no"];
	
	
	$qorder = mysqli_query($conn, "SELECT * FROM orders WHERE order_table = '{$table_no}'");
	while($rorder = mysqli_fetch_array($qorder)){
		$order_item = $rorder["order_item"];
		$order_quantity = $rorder["order_quantity"];
		$order_price = $rorder["order_price"];
		$order_total = $rorder["order_total"];
		
		$qana = mysqli_query($conn, "SELECT * FROM anas WHERE ana_item = '{$order_item}' AND ana_date = '{$today}'");
		$nana = mysqli_num_rows($qana);
		
		if($nana == 0){
			$iana = mysqli_query($conn, "INSERT INTO anas(ana_item, ana_qty, ana_price, ana_date) VALUES('{$order_item}', '{$order_quantity}', '{$order_price}', '{$today}')");
		}else{
			$uana = mysqli_query($conn, "UPDATE anas SET ana_qty = ana_qty+$order_quantity WHERE ana_item = '{$order_item}'");
		}
	}
	
	$qbill = mysqli_query($conn, "SELECT * FROM bills WHERE bill_no = '{$bill_no}'");
	$rqbill = mysqli_fetch_array($qbill);
	$paid_no = $rqbill["bill_no"];
	$paid_date = $rqbill["bill_date"];
	$paid_time = $rqbill["bill_time"];
	$paid_month = $rqbill["bill_month"];
	$paid_year = $rqbill["bill_year"];
	$paid_cashier = $_SESSION["user_name"];
	$paid_waiteress = $rqbill["bill_waiteress"];
	$paid_total = $rqbill["bill_total"];
	
	$ipaid = mysqli_query($conn, "INSERT INTO paids( paid_no, paid_date,	paid_time, paid_month, paid_year, paid_total, paid_waiteress, paid_cashier ) VALUES( '{$paid_no}', '{$paid_date}', '{$paid_time}', '{$paid_month}', '{$paid_year}', '{$paid_total}', '{$paid_waiteress}', '{$paid_cashier}' )");
	
	if($ipaid == TRUE){
		
		$dbill = mysqli_query($conn, "DELETE FROM bills WHERE bill_no = '{$bill_no}'");
		
		if($dbill == TRUE){
			$zero = "0";
			$utable = mysqli_query($conn, "UPDATE tables SET table_status = '{$zero}' WHERE table_no = '{$table_no}'");
			
			if($utable == TRUE){
				
				$dorder = mysqli_query($conn, "DELETE FROM orders WHERE order_table = '{$table_no}'");
				
				if($dorder == TRUE){
					header("Location: index.php");
				}else{
					echo "Order query error";
				}
				
			}else{
				echo "Table query error";
			}
			
		}else{
			
			echo "Bill queries Error";
			
		}
		
	}else{
		
		echo "Paid queries error";
		
	}
	
}
}else{
	header("Location: ../index.php");	
}
?>