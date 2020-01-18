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

	if(isset($_GET["type_name"])){
		
		$type_name = $_GET["type_name"];
		
		$qcategory = mysqli_query($conn, "SELECT * FROM categorys WHERE category_type = '{$type_name}'");
			
		while($rqcategory = mysqli_fetch_array($qcategory)){	
?>
	
	<div id="cat_menu" style="float: left; margin:25px;">
	<a href="ad_category.php?category_name=<?= $rqcategory["category_name"] ?>&addon=<?= $addon ?>&type_name=<?= $type_name ?>">
		<strong><?= $rqcategory["category_name"] ?></strong>
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

