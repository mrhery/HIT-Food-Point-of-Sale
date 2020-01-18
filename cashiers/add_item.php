<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
	
require_once("includes/connection.php");

if(isset($_GET["type"]))
{
	$type = $_GET["type"];
	$item_name = $_GET["item_name"];
	$item_category = $_GET["item_category"];
	
	if($item_category == "0"){
		echo "
			<script>
				alert('Please select your Meals Category');
				window.location.replace('db_food_drink_management.php');
			</script>
		";
	}else{
	
	$item_short = $_GET["item_short"];
	$item_date = date("d-M-Y", time() - 54000);
	$item_price = $_GET["item_price"];
	
	$name = $_FILES['item_picture']['name'];
	$temp = $_FILES['item_picture']['tmp_name'];
	
	move_uploaded_file($temp, "uploaded/picture/".$name);
	$item_picture = "uploaded/picture/$name";

	
	$item_user = $user_name;
	
	$qitem = mysqli_query($conn, "INSERT INTO items(item_name, item_category, item_type, item_price, item_picture, item_date, item_short, item_user) VALUES('{$item_name}', '{$item_category}', '{$type}', '{$item_price}', '{$item_picture}', '{$item_date}', '{$item_short}', '{$item_user}')");
	
			if($qitem == TRUE){
				header("Location: db_food_drink_management.php");
			}else{
				echo "
					<script>
						alert('There is an error in Adding your Query.');
						window.location.replace('db_food_drink_managment.php');
					</script>
				";
			}
		
	}
}
}else{
	header("Location: ../index.php");
}
?>