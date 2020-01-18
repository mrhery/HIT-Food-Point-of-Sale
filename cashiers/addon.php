<?php
session_start();
if(isset($_SESSION["user_name"])){
require_once("template/._header.php");
require_once("includes/connection.php");

$available = "0";
$reserved = "1";

$qtable_ava = mysqli_query($conn, "SELECT * FROM tables WHERE table_status = '{$available}'");
$rwqt_ava = mysqli_num_rows($qtable_ava);

$qtable_res = mysqli_query($conn, "SELECT * FROM tables WHERE table_status = '{$reserved}'");
$rwqt_res = mysqli_num_rows($qtable_res);
?>
<script>
setTimeout(function(){
   window.location.reload(1);
}, 5000);
</script>
<div align="center">
        <strong style="font-size:25px; padding: 5px;">Add-on's Orders</strong> 
     
            <strong>Reserved:</strong> <?= $rwqt_res ?> &nbsp;  <strong>Available:</strong> <?= $rwqt_ava ?> 
            &nbsp; | &nbsp; 
            <strong>Date:</strong> <?= date("d-M-Y",time() - 54000) ?>  &nbsp; 
            <strong>Time:</strong> <?= date("H:i:s",time() + 54000) ?>
        
            	<hr />
                <br />
				<div id="rb_menu">
					<a href="takeaway.php">Take Away</a>
					<a href="addon.php">Add On</a>
				</div>
			<h3>Add-On Orders</h3>
			<table width="95%" border="0" class="tbl" style="border:#F30 groove; border-top-right-radius:10px; border-top-left-radius:10px;">
        	<tr style="background:#F30;" >
            	<th width="5%">No</th>
                <th width="15%">Name / Table No</th>
                <th width="20%">Item</th>
                <th width="15%">QTY</th>
                <th width="15%">Total</th>
				<th width="15%">Status</th>
				<th width="20%">Action</th>
            </tr>
            <?php
				$order_ad = "ad";
				$qorder = mysqli_query($conn, "SELECT * FROM orders WHERE order_ad = '{$order_ad}' ORDER BY order_id DESC");
				$no = 0 + 1;
				while($rqorder = mysqli_fetch_array($qorder)){
			?>
        	<tr>
            	<td align="center"><?= $no ?></td>
                <td align="center"><?= $rqorder["order_table"] ?></td>
                <td align="center"><?= $rqorder["order_item"] ?></td>
                <td align="center"><?=  $rqorder["order_quantity"] ?></td>
                <td align="right"><?= number_format($rqorder["order_total"], 2) ?></td>
				<td align="center"><?= $rqorder["order_adprint"] ?></td>
				<td align="center">
					<a href="print_ad.php?type_name=<?= $rqorder["order_type"] ?>&addon=<?= $rqorder["order_table"] ?>&order_id=<?= $rqorder["order_id"] ?>">Print</a><br />
					<a href="del_ta.php?order_item=<?= $rqorder["order_item"] ?>&customer=<?= $rqorder["order_table"] ?>">Delete</a>
				
				</td>
            </tr>
            <?php
			$no++;
				}
			?>
        </table>
			
			
			
			
			
			
</div>
<?php
require_once("template/._footer.php");
}else{
	header("Location: ../index.php");
}
?>    