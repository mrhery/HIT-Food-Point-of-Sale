<?php
require_once("includes/connection.php");

if(isset($_GET["table_id"]))
{
	$table_id = $_GET["table_id"];
	
	$qdel = mysqli_query($conn, "DELETE FROM tables WHERE table_id = '{$table_id}'");
	
	if($qdel == TRUE){
		header("Location: db_table_management.php");
	}else{
		echo "
			<script>
				alert('Sorry, there is an eror in Deleting you Query.')
			</script>
		";
	}
}

?>