<?php
require_once("includes/connection.php");
require_once("template/._header_popup.php");

if(isset($_GET["type_name"])){
	$type_name = $_GET["type_name"];
	
	$qtype = mysqli_query($conn, "SELECT * FROM items WHERE item_type = '{$type_name}'");
?>
	<h1><?= $type_name ?></h1>
    
    <table class="tbl" width="100%" style="border:#F30 groove; border-top-right-radius:10px; border-top-left-radius:10px;">
    	<tr style="background:#F30;">
        	<th width="10%">No</th>
            <th width="20%">Item</th>
			<th width="20%">Category</th>
            <th width="10%">Price</th>
            <th width="20%">Date</th>
            <th width="10%">User</th>
            <th width="10%">Action</th>
        </tr>
    <?php
		$no = 0 + 1;
		while($rqtype = mysqli_fetch_array($qtype)){
			$price = $rqtype["item_price"];
			if(empty($price) || $price == 0){
				$item_price = "0";
			}else{
				$item_price = $rqtype["item_price"];
			}
	?>
		<tr>
        	<td align="center"><?= $no ?></td>
            <td align="center"><?= $rqtype["item_name"] ?></td>
			<td align="center"><?= $rqtype["item_category"] ?></td>
            <td align="right"><?= number_format($item_price, 2) ?></td>
            <td align="center"><?= $rqtype["item_date"] ?></td>
            <td align="center"><?= $rqtype["item_user"] ?></td>
            <td align="center"><div id="delete_button"><a href="del_item.php?item_id=<?= $rqtype["item_id"] ?>&type=<?= $type_name ?>"><strong>Delete</strong></a><br />
            <a href="edit_item.php?item_id=<?= $rqtype["item_id"] ?>&type=<?= $type_name ?>"><strong>Edit</strong></a>
            </div></td>
        </tr>
    <?php
		$no++;
		}
	?>
	</table>


<?php
}
?>