<?php
session_start();
require_once("includes/connection.php");
if(isset($_POST["user_name"], $_POST["user_password"], $_POST["user_section"])){
	
	$user_name = $_POST["user_name"];
	$user_password = $_POST["user_password"];
	$user_section = $_POST["user_section"];
	
	$quser = mysqli_query($conn, "SELECT * FROM users WHERE user_name = '{$user_name}' AND user_password = '{$user_password}' AND user_section = '{$user_section}'");
	
	$numquser = mysqli_num_rows($quser);
	
	if($numquser == 1){
		
		@$_SESSION["user_name"] = $user_name;
		@$_SESSION["user_section"] = $user_section;
		
		$active = "1";
		$uuser = mysqli_query($conn, "UPDATE users SET user_status = '{$active}' WHERE user_name = '{$user_name}'");
		
		if($uuser == TRUE){
		
			if($_SESSION["user_section"] == "cashier"){
				header("Location: cashiers/");
			}elseif($_SESSION["user_section"] == "waitress"){
				header("Location: waitress/");
			}
			
		}else{
			echo "
				<script>
					alert('Sign in error!');
					window.location.replace('index.php');
				</script>
			";
		}
	}else{
		echo "<script>
					alert('Sign in error!');
					window.location.replace('index.php');
				</script>";
	}
}


?>