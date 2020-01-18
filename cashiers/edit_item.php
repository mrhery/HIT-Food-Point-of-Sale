<?php
session_start();
if(isset($_SESSION["user_name"])){
require_once("includes/connection.php");
require_once("template/._header_popup.php");

if(isset($_GET["item_id"])){
	$item_id = $_GET["item_id"];
	$type = $_GET["type"];
	
	$qtype = mysqli_query($conn, "SELECT * FROM items WHERE item_id = '{$item_id}'");
	$rqtype = mysqli_fetch_array($qtype);
	
	if(isset($_POST["update"])){
		$item_name = $_POST["item_name"];
		$item_price = $_POST["item_price"];
		$item_desc = $_POST["item_desc"];
		$item_short = $_POST["item_short"];
		$item_promo = $_POST["item_promo"];
		
		$qupdate = mysqli_query($conn, "UPDATE items SET item_name = '{$item_name}', item_price = '{$item_price}', item_desc = '{$item_desc}', item_short = '{$item_short}', item_promo = '{$item_promo}' WHERE item_id = '{$item_id}'");
		
		if($qupdate == TRUE){
			header("Location: items.php?type_name=$type");
		}else{
			echo "
				<script>
					alert('There is a problem in Inserting your Query.');
					window.location.replace('items.php?type_name=$type');
				</script>
			";	
		}
		
	}
	
?>
	<h1>Edit :<?= $rqtype["item_name"] ?></h1>
	<strong>Item Information</strong>
    
    <table class="tbl" width="100%" style="border:#F30 groove; border-top-right-radius:10px; border-top-left-radius:10px;">
    	<tr style="background:#F30;">
        	<th width="10%">No</th>
            <th width="20%">Item</th>
            <th width="10%">Price</th>
			<th width="20%">Description</th>
			<th width="20%">Short-Word</th>
            <th width="10%">Date</th>
			<th width="10%">Promotion</th>
        </tr>
		<tr>
        <form action="" method="post">
        	<td align="center">1</td>
            <td align="center"><input type="text" value="<?= $rqtype["item_name"] ?>" name="item_name" /></td>
            <td align="right"><input type="text" value="<?= $rqtype["item_price"] ?>" name="item_price" /></td>
			<td align="center"><textarea name="item_desc" cols="15"><?= $rqtype["item_desc"] ?></textarea></td>
			<td align="center"><input type="text" autofocus="on" value="<?= $rqtype["item_short"] ?>" size="10" name="item_short" placeholder="No short" /></td>
            <td align="center"><?= $rqtype["item_date"] ?></td>
            <td align="center">
				<input type="text" name="item_promo" value="<?= $rqtype["item_promo"] ?>" placeholder="Promotion Name" />

			</td>
        </tr>
	</table>
	<br />
    <div align="center">
    	<input type="submit" name="update" value="Update" />
    </div>
    </form>


<?php
}
}else{
	header("Location: ../index.php");
}
?>