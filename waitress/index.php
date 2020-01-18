<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
	
require_once("template/._header.php");
?>
<style>
body{
	font-family:Verdana, Geneva, sans-serif;
}

div#header{
	background: #F90;
}

div#choose > a{
	float: left;
	margin-top:20px;
	width:100%;
	border-radius:5px;
	height:100px;
	background:green;
	text-decoration:none;
}

div#choose > a:hover{
	float: left; 
	background:#0F0;
}
</style>
<div id="header" align="center">
    <strong style="color:#fff; font-size:36px;">Waiteress</strong><br />
    <strong>Waitress: <?= $user_name ?></strong>
</div>

 <div id="choose" style="">
                <a href="table.php">
                <div align="center">
                <strong style="font-size:17vw; color:#fff;">Dine - In</strong>
                </div></a>
</div>

<div id="choose" style="">
                <a href="takeaway.php">
                <div align="center">
                <strong style="font-size:15vw; color:#fff;">Take Away</strong>
                </div></a>
</div>


<?php
require_once("template/._footer.php");
}else{
header("Location: ../index.php");
}
?>