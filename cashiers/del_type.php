<?php
session_start();
if(isset($_SESSION["user_name"])){
require_once("includes/connection.php");

if(isset($_GET["type_id"]))
{
	$type_id = $_GET["type_id"];
	
	$qdel = mysqli_query($conn, "DELETE FROM types WHERE type_id = '{$type_id}'");
	
	if($qdel == TRUE){
		header("Location: manage_type.php");
	}else{
		echo "
			<script>
				alert('Sorry, there is an eror in Deleting you Query.')
			</script>
		";
	}

}}else{
	header("Location: ../index.php");
}
?>