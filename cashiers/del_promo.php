<?php

require_once("includes/connection.php");

if(isset($_GET["promo"])){
	
	$promo_id = $_GET["promo"];
	$dpromo = mysqli_query($conn, "DELETE FROM promos WHERE promo_id = '{$promo_id}'");
	
	if($dpromo == TRUE){
		header("Location: promotion.php");
	}

}

?>