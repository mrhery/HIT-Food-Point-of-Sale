<?php
session_start();
if(isset($_SESSION["user_name"])){
	require_once("includes/connection.php");

	if(isset( $_GET["table_no"])){
		
		
		$table_no = $_GET["table_no"];
		
		$dorder = mysqli_query($conn, "DELETE FROM orders WHERE order_table = '{$table_no}'");
		
		if($dorder == TRUE){
			
			$zero = "0";
			$dtable = mysqli_query($conn, "UPDATE tables SET table_status = '{$zero}' WHERE table_no = '{$table_no}'");
			
			if($dtable == TRUE){
				
				$dbill = mysqli_query($conn, "DELETE FROM bills WHERE bill_table = '{$table_no}'");
				
				if($dbill == TRUE){
					
					header("Location: table.php?table_no=$table_no");
										
				}else{
					echo "Delete Bill query error.";
				}
				
				
			}else{
				echo "Delete Table query error.";
			}
			
		}else{
				echo "Delete Order query error.";
			}
		
	}
}else{
	header("Location: ../index.php");
}
?>