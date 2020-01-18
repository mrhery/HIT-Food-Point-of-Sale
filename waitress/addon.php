<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
require_once("includes/connection.php");
require_once("template/._header.php");

?>

<div id="header" align="center">
    <strong style="color:#fff; font-size:36px;">Waiteress (Add-On)</strong><br />
		<strong>Waitress: <?= $user_name ?></strong>
</div>

<div style="width:100%" align="center">
    <strong>Add-On Orders</strong>
    <?php
		if(!isset($_GET["addon"])){
	?>
	<form action="ad_summary.php" method="GET">
    	<input type="text" name="addon" placeholder="Please Insert Customer Name or Table no" size="40%" style="font-size:20px;">
        <input type="submit" name="submit" value="Submit" style="background:#090; color:#FFF; padding:5px; font-size:20px;" />
    </form>
	
	<?php
		$qaddon = mysqli_query($conn, "SELECT * FROM bills");
		while($raddon = mysqli_fetch_array($qaddon)){
	?>
	<div id="addon_list" style="">
		<a href="ad_summary.php?addon=<?= $raddon["bill_table"] ?>">
			<div align="center">
				<strong style="font-size:50px; color:#fff;" align="center"><?= $raddon["bill_table"] ?></strong>
			</div>
		</a>
    </div>
	
    <?php
		}
		}else{
			$addon = $_GET["addon"];
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
