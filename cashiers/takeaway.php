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
        <strong style="font-size:25px; padding: 5px;">Take Away Order</strong> 
     
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
			<h3>Take Away Orders</h3>
			<table width="95%" border="0" class="tbl" style="border:#F30 groove; border-top-right-radius:10px; border-top-left-radius:10px;">
        	<tr style="background:#F30;" >
            	<th width="5%">No</th>
                <th width="15%">Customer</th>
                <th width="15%">Total</th>
            </tr>
            <?php
				$order_ad = "ta";
				$order_adprint = "inprint";
				$bill_type = "ta";
				
				$qorder = mysqli_query($conn, "SELECT * FROM bills WHERE bill_type = '{$bill_type}' ORDER BY bill_id DESC");
				$no = 0 + 1;
				while($rqorder = mysqli_fetch_array($qorder)){
			?>
        	<tr>
            	<td align="center"><?= $no ?></td>
                <td align="center"><a href="bill_ta.php?customer=<?= $rqorder["bill_table"] ?>"><?= $rqorder["bill_table"] ?></a></td>
                <td align="right"><?= number_format($rqorder["bill_total"], 2) ?></td>
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