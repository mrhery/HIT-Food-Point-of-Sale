<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
require_once("includes/connection.php");
require_once("template/._header.php");
$table_no = $_GET["table_no"];
$type_name = $_GET["type_name"];
?>

	<div id="header" align="center">
    	<h2 style="padding:5px; color: #FFF;">Waiteress</h2>
   </div>

	<div id="nav_bar" align="center">
    	<?php
			
			$qtype = mysqli_query($conn, "SELECT * FROM types");
			
			while($rtypq = mysqli_fetch_array($qtype)){
				
		?>
        <a href="type.php?type_name=<?= $rtypq["type_name"] ?>&table_no=<?= $table_no ?>"><strong><?= $rtypq["type_name"] ?></strong></a>
    	
    	<?php
			}
		?>
        <a href="summary.php?table_no=<?= $table_no ?>"><strong>Summary</strong></a>
    </div><br />
    <hr />
	<div align="centrer">
<?php

	if(isset($_GET["category_name"])){
		
		$category_name = $_GET["category_name"];
		
		
		$qitem = mysqli_query($conn, "SELECT * FROM items WHERE item_category = '{$category_name}'");
			
		while($rqitem = mysqli_fetch_array($qitem)){	
?>
	
	<div id="item_menu" style="margin:15px; width: 75%;" align="center">
		<a href="order.php?item_id=<?= $rqitem["item_id"] ?>&table_no=<?= $table_no ?>&type_name=<?= $type_name ?>">
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
</div>

