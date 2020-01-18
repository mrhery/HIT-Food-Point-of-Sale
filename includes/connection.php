<?php

$conn = mysqli_connect("127.0.0.1", "root", "" , "food");

if($conn == FALSE){
	header("Location: errordb.php");
}

?>