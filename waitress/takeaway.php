<?php
session_start();
if(isset($_SESSION["user_name"])){
	$user_name = $_SESSION["user_name"];
	
	require_once("template/._header.php");
	
?>
    <div id="header" align="center">
        <strong style="color:#fff; font-size:36px;">Waiteress (Take Away)</strong><br />
		<strong>Waitress: <?= $user_name ?></strong>
    </div>
    
    
	<div style="width:100%" align="center">
    <strong>Take Away Orders</strong>

    <?php
		if(!isset($_GET["customer"])){
	?>
	<form action="ta_summary.php" method="GET">
    	<input type="text" name="customer" placeholder="Customer name" size="40%" style="font-size:20px;">
        <input type="submit" name="submit" value="Submit" style="background:#090; color:#FFF; padding:5px; font-size:20px;" />
    </form>
    <?php
		}else{
			$customer = $_GET["customer"];
	?>
    
    
    
	<?php
		}

	?>
    
	</div>

<?php

require_once("template/._footer.php");
}else{
	header("Location: ../index.php");
}
?>