<?php
session_start();
if(isset($_SESSION["user_name"])){
require_once("includes/connection.php");

if(isset($_GET["item_id"]))
{
	$item_id = $_GET["item_id"];
	$item_type = $_GET["type"];
	
	$qdel = mysqli_query($conn, "DELETE FROM items WHERE item_id = '{$item_id}'");
	
	if($qdel == TRUE){
		header("Location: items.php?type_name=$item_type");
	}else{
		echo "
			<script>
				alert('Sorry, there is an eror in Deleting you Query.')
			</script>
		";
	}
}
}else{
	header("Location: ../index.php");
}
?>