<?php
session_start();
if(isset($_SESSION["user_name"])){
	$user = $_SESSION["user_name"];
require_once("includes/connection.php");

if(isset($_GET["table_no"], $_GET["item_id"], $_GET["type_name"])){
		
	$table_no = $_GET["table_no"];
	$item_id = $_GET["item_id"];
	$type_name = $_GET["type_name"];
	
	$qitem = mysqli_query($conn, "SELECT * FROM items WHERE item_id = '{$item_id}'");
	$rqitem = mysqli_fetch_array($qitem);
	$item_name = $rqitem["item_name"];
	$item_quantity = "1";
	
	
	$item_promo = $rqitem["item_promo"];
	
	$qpromo = mysqli_query($conn, "SELECT * FROM promos WHERE promo_name = '{$item_promo}'");
	$npromo = mysqli_num_rows($qpromo);
	
	if($npromo == 0){
		$item_price = $rqitem["item_price"];
	}else{
		$rpromo = mysqli_fetch_array($qpromo);
		
		$promo_trate = $rpromo["promo_trate"];
		$promo_twhen = $rpromo["promo_twhen"];
		$promo_when = $rpromo["promo_when"];
		$promo_rate = $rpromo["promo_rate"];

		if($promo_twhen == "day") {
			if($promo_when == date("D")){
				if($promo_trate == "rate"){
					$item_price = $rqitem["item_price"] - ($promo_rate / 100 * $rqitem["item_price"]);
				}else{
					$item_price = $promo_rate;
				}
			}else{
				$item_price = $rqitem["item_price"];
			}
		}else{
			if($promo_when == date("d-M")){
				if($promo_trate == "rate"){
					$item_price = $rqitem["item_price"] - ($promo_rate / 100 * $rqitem["item_price"]);
				}else{
					$item_price = $promo_rate;
				}
			}else{
				$item_price = $rqitem["item_price"];
			}
		}
	}
	
	
	$qorder = mysqli_query($conn, "SELECT * FROM orders WHERE order_table = '{$table_no}' AND order_item = '{$item_name}'");
	$nqorder = mysqli_num_rows($qorder);
	$rqorder = mysqli_fetch_array($qorder);
	$order_total = $rqorder["order_total"];
	$order_quantity = $rqorder["order_quantity"];
	$new_order_total = $order_total + $item_price;
	$new_order_quantity = $order_quantity + $item_quantity;

	
	if($nqorder == "0"){
		
		$iorder = mysqli_query($conn, "INSERT INTO orders(
			order_table,
			order_item,
			order_price,
			order_type,
			order_quantity,
			order_total,
			order_user
			)
			VALUES(
			'{$table_no}',
			'{$item_name}',
			'{$item_price}',
			'{$type_name}',
			'{$item_quantity}',
			'{$item_price}',
			'{$user}'
			)");


				
				
				if($iorder == TRUE){
					header("Location: added_order.php?table_no=$table_no");
				}else{
					echo "Bill query error";
				}
				
			
	}else{
		
		$uorder = mysqli_query($conn, "UPDATE orders SET order_quantity = '{$new_order_quantity}', order_total = '{$new_order_total}' WHERE order_table = '{$table_no}' AND order_item = '{$item_name}'");

			if($uorder == TRUE){
					header("Location: added_order.php?table_no=$table_no");
				}else{
					echo "Bill query error";
				}
				
		
	}
		
}

}else{
	header("Location: ../index.php");
}
?>