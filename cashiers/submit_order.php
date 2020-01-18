<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
	require_once("includes/connection.php");
	if(isset($_GET["table_no"])){
		
		$table_no = $_GET["table_no"];
		$reserve = "1";
		$utable = mysqli_query($conn, "UPDATE tables SET table_status = '{$reserve}' WHERE table_no = '{$table_no}'");
		
		$tbill = mysqli_query($conn, "SELECT * FROM bills WHERE bill_table = '{$table_no}'");
		$ntbill = mysqli_num_rows($tbill);
		
		$qsorder = mysqli_query($conn, "SELECT SUM(order_total) FROM orders WHERE order_table = '{$table_no}'");
		$rsorder = mysqli_fetch_array($qsorder);
		$bill_total = $rsorder["SUM(order_total)"];
		
		if($ntbill == 0 || empty($ntbill)){
		
		$bill_date = date("d-M-Y", time() - 54000);
		$bill_time = date("H:i:s",time() + 54000);	
		$bill_month = date("M", time() - 54000);
		$bill_year = date("Y", time() - 54000);
		$bill_cashier = $user_name;
		
		$qbill = mysqli_query($conn, "SELECT * FROM bills ORDER BY bill_id DESC LIMIT 1");	
		$rqbill = mysqli_fetch_array($qbill);
		$a = $rqbill["bill_id"];
		$b = $a + 1;
		$bill_no = "S" . $bill_date . "/" . $b;
		
		
		$ibill = mysqli_query($conn, "INSERT INTO bills(bill_no, bill_date, bill_time, bill_month, bill_year, bill_total, bill_cashier, bill_table) VALUES('{$bill_no}', '{$bill_date}', '{$bill_time}', '{$bill_month}', '{$bill_year}', '{$bill_total}', '{$bill_cashier}', '{$table_no}') ");
		
			if($ibill == TRUE){
				header("Location: table.php?table_no=$table_no");
			}else{
				echo "Error ibill";
			}
		
		}else{
			
			$ubill = mysqli_query($conn, "UPDATE bills SET bill_total = '{$bill_cashier}' WHERE bill_table = '{$table_no}'");
			
			if($ubill == TRUE){
				header("Location: table.php?table_no=$table_no");
			}else{
				echo "Error ubill";
			}
		
		}
		
		
	}else{
		header("Location: index.php");
	}
	

}else{
	 header("Location: ../index.php");	
}
?>
