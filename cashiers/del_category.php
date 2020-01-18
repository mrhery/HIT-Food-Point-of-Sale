<?php
session_start();
if(isset($_SESSION["user_name"])){
require_once("includes/connection.php");

if(isset($_GET["category_id"]))
{
	$category_id = $_GET["category_id"];
	
	$qdel = mysqli_query($conn, "DELETE FROM categorys WHERE category_id = '{$category_id}'");
	
	if($qdel == TRUE){
		header("Location: manage_category.php");
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