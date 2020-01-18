 <?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
require_once("includes/connection.php");

$bill_waiteress = $user_name;

if(isset($_GET["customer"])){
	
	$customer = $_GET["customer"];
	
	$qsum = mysqli_query($conn, "SELECT SUM(order_total) FROM orders WHERE order_table = '{$customer}'");
	$rsum = mysqli_fetch_array($qsum);
	$order_total = $rsum["SUM(order_total)"];
	
	$bill = mysqli_query($conn, "SELECT * FROM bills WHERE bill_table = '{$customer}' ");
	$num_bill = mysqli_num_rows($bill);
	
	if($num_bill == 1){
		
		$ubill = mysqli_query($conn, "UPDATE bills SET bill_total = '{$order_total}' WHERE bill_table = '{$customer}'");
		if($ubill){
			header("Location: ta_summary.php?customer=$customer");
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
	$bill_no = "S" . $bill_date . "/" . $customer;
	$bill_type = "ta";
	
	$ibill = mysqli_query($conn, "INSERT INTO bills(bill_no, bill_table, bill_type, bill_date, bill_time, bill_month, bill_year, bill_total, bill_waiteress) VALUES('{$bill_no}', '{$customer}', '{$bill_type}', '{$bill_date}', '{$bill_time}', '{$bill_month}', '{$bill_year}', '{$order_total}', '{$bill_waiteress}')");
	
		if($ibill == TRUE){
			
			header("Location: ta_summary.php?customer=$customer");
		}
	}
}
}else{
header("Location: ../index.php");
}
?>