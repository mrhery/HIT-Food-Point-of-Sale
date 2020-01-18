<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
require_once("includes/connection.php");
require_once("template/._header.php");
$addon = $_GET["addon"];

$torder = mysqli_query($conn, "SELECT * FROM bills WHERE bill_table = '{$addon}'");
$rowcount = mysqli_num_rows($torder);

if($rowcount == 0 || empty($rowcount)){
	
	echo "
	
		<script>
			alert('There is no registered Customer or Table!');
			window.location.replace('addon.php');
		</script>
	
	";
	
}else{


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
    <hr /><br />
    <div align="center" id="rb_menu">
    <strong style="font-size:18px;">Add-on Order to: <?= $addon ?></strong><br /><br />
    	<a href="ad_submit_order.php?addon=<?= $addon ?>">Submit Order</a> <a href="ad_cancel_order.php?addon=<?= $addon ?>">Cancel Order</a>
    </div><br />
    <?php
		
		$qbill = mysqli_query($conn, "SELECT * FROM bills WHERE bill_table = '{$addon}'");
		$nbill = mysqli_num_rows($qbill);
		$rbill = mysqli_fetch_array($qbill);
		
		if($nbill == 0){
			
		
	?>
    <div align="center">
    	<strong style="color:red;">This order has not yet submitted.</strong>
	</div>
	<?php }else{ ?>
    <div align="center">
    	<strong style="color:green;">Order Submitted at <?= $rbill["bill_date"] ?> - <?= $rbill["bill_time"] ?> by <?= $rbill["bill_waiteress"] ?></strong>
	</div>
    <?php } ?>
	<table width="100%" border="1">
		<tr>
        	<th width="10%">No</th>
            <th width="35%">Item</th>
            <th width="10%">Qty.</th>
            <th width="20%">Total</th>
            <th width="25%">Action</th>
        </tr>
        
        <?php
			$order_ad = "ad";
			$qorder = mysqli_query($conn, "SELECT * FROM orders WHERE order_table = '{$addon}' AND order_ad = '{$order_ad}'");
			$no = 0 + 1;
			$sorder = mysqli_query($conn, "SELECT SUM(order_total) FROM orders WHERE order_table = '{$addon}' AND order_ad = '{$order_ad}'");
			$rsorder = mysqli_fetch_array($sorder);
			while($rorder = mysqli_fetch_array($qorder)){
		?>
        <tr>
        	<td align="center"><?= $no ?></td>
            <td align="center"><?= $rorder["order_item"] ?></td>
            <td align="center"><?= $rorder["order_quantity"] ?></td>
            <td align="right"><?= number_format($rorder["order_total"], 2) ?></td>
            <td align="center">
				<div id="sum_but">
					<a href="ad_del_order.php?order_id=<?= $rorder["order_id"] ?>&addon=<?= $addon ?>" onclick="return confirm('Are you sure?')">		
						<strong>Delete</strong>
					</a> <br />
					<a href="ad_add_note.php?order_id=<?= $rorder["order_id"] ?>&addon=<?= $addon ?>">
						<strong>Add Notes</strong>
					</a>
				</div>
            </td>
        </tr>
        <?php
			$no++;
			}
		?>
        <tr>
        	<td></td>
            <td align="center"><strong>TOTAL</strong></td>
            <td></td>
            <td align="right"><strong><?= number_format($rsorder["SUM(order_total)"], 2) ?></strong></td>    
        </tr>
	</table>


<?php
require_once("template/._footer.php");	
}	
}else{
header("Location: ../index.php");
}
?>

