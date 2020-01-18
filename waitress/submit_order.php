<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
require_once("includes/connection.php");

$bill_waiteress = $user_name;

if(isset($_GET["table_no"])){
	
	$table_no = $_GET["table_no"];
	
	$qsum = mysqli_query($conn, "SELECT SUM(order_total) FROM orders WHERE order_table = '{$table_no}'");
	$rsum = mysqli_fetch_array($qsum);
	$order_total = $rsum["SUM(order_total)"];
	
	$bill = mysqli_query($conn, "SELECT * FROM bills WHERE bill_table = '{$table_no}' ");
	$num_bill = mysqli_num_rows($bill);
	
	if($num_bill == 1){
		
		$ubill = mysqli_query($conn, "UPDATE bills SET bill_total = '{$order_total}' WHERE bill_table = '{$table_no}'");
		if($ubill){
			header("Location: summary.php?table_no=$table_no");
		}else{
			echo "Error updating query.";
		}
		
	}else{
	
	$bill_date = date("d-M-Y", time() - 54000);
	$bill_time = date("H:s:i", time() + 54000);
	$bill_month = date("M", time() - 54000);
	$bill_year = date("Y", time() - 54000);
	
	$qbill = mysqli_query($conn, "SELECT * FROM bills ORDER BY bill_id DESC LIMIT 1");
	$rbill = mysqli_fetch_array($qbill);
	$bill = $rbill["bill_id"];
	$bill_new = $bill + 1;
	$bill_no = "S" . $bill_date . "/" . $bill_new;
	
	$ibill = mysqli_query($conn, "INSERT INTO bills(bill_no, bill_table, bill_date, bill_time, bill_month, bill_year, bill_total, bill_waiteress) VALUES('{$bill_no}', '{$table_no}', '{$bill_date}', '{$bill_time}', '{$bill_month}', '{$bill_year}', '{$order_total}', '{$bill_waiteress}')");
	
		if($ibill == TRUE){
			$full = "1";
			
			$utable = mysqli_query($conn, "UPDATE tables SET table_status = '{$full}' WHERE table_no = '{$table_no}'");
			
			if($utable == TRUE){
				header("Location: summary.php?table_no=$table_no");
			}
			
		}
	}
}
}else{
header("Location: ../index.php");
}
?>