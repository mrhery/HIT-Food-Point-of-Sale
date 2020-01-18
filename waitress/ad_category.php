<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
require_once("includes/connection.php");
require_once("template/._header.php");
$addon = $_GET["addon"];
?>

	<div id="header" align="center">
    	<h2 style="padding:5px; color: #FFF;">Waiteress (Add-on to: <?= $addon ?>)</h2>
   </div>
	<div id="nav_bar" align="center">
    	<?php
			
			$qtype = mysqli_query($conn, "SELECT * FROM types");
			
			while($rtypq = mysqli_fetch_array($qtype)){
				
		?>
        <a href="ad_type.php?type_name=<?= $rtypq["type_name"] ?>&addon=<?= $addon ?>"><strong><?= $rtypq["type_name"] ?></strong></a>
    	
    	<?php
			}
		?>
        <a href="ad_summary.php?addon=<?= $addon ?>"><strong>Summary</strong></a>
    </div><br />
    <hr />
<?php

	if(isset($_GET["category_name"])){
		
		$category_name = $_GET["category_name"];
		$type_name = $_GET["type_name"];
		$qitem = mysqli_query($conn, "SELECT * FROM items WHERE item_category = '{$category_name}'");
			
		while($rqitem = mysqli_fetch_array($qitem)){	
?>
	
	<div id="item_menu" style="margin:15px; width: 75%;">
		<a href="ad_order.php?item_id=<?= $rqitem["item_id"] ?>&addon=<?= $addon ?>&type_name=<?= $type_name ?>">
        	<div align="center">
            	
                <br />
                
				<?= $rqitem["item_name"] ?> - (<?= $rqitem["item_price"] ?>)<br />
				*<?= $rqitem["item_desc"] ?>
           	</div>
       </a>
	</div>

<?php
		}
	}
require_once("template/._footer.php");
}else{
header("Location: ../index.php");
}
?>

