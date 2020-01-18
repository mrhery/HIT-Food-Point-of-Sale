<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
require_once("includes/connection.php");

if(isset($_GET["customer"], $_GET["item_id"], $_GET["type_name"])){
	$type_name = $_GET["type_name"];
	$customer = $_GET["customer"];
	$item_id = $_GET["item_id"];
	$quantity = "1";
	$order_user = $user_name;
	
	$qitem = mysqli_query($conn, "SELECT * FROM items WHERE item_id = '{$item_id}'");
	$rqitem = mysqli_fetch_array($qitem);
	$item_name = $rqitem["item_name"];
	//$item_price = $rqitem["item_price"];
	
	
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
	
	
	
	$order_ad = "ta";
	$order_adprint = "inprint";
	
	$qorder = mysqli_query($conn, "SELECT * FROM orders WHERE order_item = '{$item_name}' AND order_table = '{$customer}'");
	$sqorder = mysqli_num_rows($qorder);
	$rqorder = mysqli_fetch_array($qorder);
	$order_id = $rqorder["order_id"];
	
	$back = $_SERVER['HTTP_REFERER'];
	if($sqorder == "0" || empty($sqorder)){
		
		$total = $quantity * $item_price;
		$iorder = mysqli_query($conn, "INSERT INTO orders(order_table, order_item, order_price, order_quantity, order_total, order_user, order_type, order_ad, order_adprint) VALUES('{$customer}', '{$item_name}', '{$item_price}', '{$quantity}', '{$total}', '{$order_user}', '{$type_name}', '{$order_ad}', '{$order_adprint}')");
		
		if($iorder == TRUE){
			header("Location: $back");
		}
		
	}else{
		
		$order_quantity = $rqorder["order_quantity"];
		$new_order_quantity = $order_quantity + 1;
		$newtotal = $new_order_quantity * $item_price;
		$uorder = mysqli_query($conn, "UPDATE orders SET order_quantity = '{$new_order_quantity}', order_total = '{$newtotal}' WHERE order_id = '{$order_id}'");
		
		if($uorder == TRUE){
			header("Location: $back");
		}
		
	}
	
}
}else{
header("Location: ../index.php");
}
?>