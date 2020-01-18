<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
require_once("includes/connection.php");
require_once("template/._header.php");
$customer = $_GET["customer"];

?>
	<div id="header" align="center">
    	<h2 style="padding:5px; color: #FFF;">Waiteress (Take Away: <?= $customer ?>)</h2>
   </div>

	<div id="nav_bar" align="center">
    	<?php
			
			$qtype = mysqli_query($conn, "SELECT * FROM types");
			
			while($rtypq = mysqli_fetch_array($qtype)){
				
		?>
        <a href="ta_type.php?type_name=<?= $rtypq["type_name"] ?>&customer=<?= $customer ?>"><strong><?= $rtypq["type_name"] ?></strong></a>
    	
    	<?php
			}
		?>
        <a href="ta_summary.php?customer=<?= $customer ?>"><strong>Summary</strong></a>
    </div><br />
    <hr />
    <!-- Live Search -->
<script>
$(document).ready(function(){
	var req = null;
	$('#keysearch').on('keyup', function(){
		var key = $('#keysearch').val();
		if (key && key.length > 0)
		{
			$('#loading').css('display', 'block');
			if (req)
				req.abort();
			req = $.ajax({
				url : 'ta_search_sum.php?customer=<?= $table_no ?>',
				type : 'POST',
				cache : false,
				data : {
					keysearch : key,
				},
				success : function(data)
				{
					console.log(data)
					if (data)
					{
						$('#loading').css('display', 'none');
						$("#result").html(data).show();
					}
				}
			});
		}
		else
		{
			$('#loading').css('display', 'none');
			$('#result').css('display', 'none');
		}

	});
});
</script>




<div class="container" align="center">
		<div class="row">
			<div class="panel panel-default">
					<div class="form-group">
							<input name="keysearch" autofocus="on" value="" placeholder="Quick Search" id="keysearch" type="text" class="form-control" style="font-size:28px;" />
						<span id="loading">Loading...</span>
					</div>
				<div id="result"></div>
			</div>
		</div>
	</div>





















		<!-- Live search End -->
    <br />
    <div align="center" id="rb_menu">
    <strong style="font-size:18px;">Customer Name: <?= $customer ?></strong><br /><br />
    	<a href="ta_submit_order.php?customer=<?= $customer ?>">Submit Order</a> <a href="ta_cancel_order.php?customer=<?= $customer ?>">Cancel Order</a>
    </div><br />
    <?php
		
		$qbill = mysqli_query($conn, "SELECT * FROM bills WHERE bill_table = '{$customer}'");
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
			$qorder = mysqli_query($conn, "SELECT * FROM orders WHERE order_table = '{$customer}'");
			$no = 0 + 1;
			$sorder = mysqli_query($conn, "SELECT SUM(order_total) FROM orders WHERE order_table = '{$customer}'");
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
            	<a href="ta_del_order.php?order_id=<?= $rorder["order_id"] ?>&customer=<?= $customer ?>" onclick="return confirm('Are you sure?')">		
                	<strong>Delete</strong>
                </a> <br />
                <a href="ta_add_note.php?order_id=<?= $rorder["order_id"] ?>&customer=<?= $customer ?>">
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
}else{
header("Location: ../index.php");
}
?>

