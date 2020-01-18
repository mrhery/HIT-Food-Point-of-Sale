<?php
session_start();
if(isset($_SESSION["user_name"])){
	
	$user_name = $_SESSION["user_name"];
require_once("includes/connection.php");
require_once("template/._header.php");
$table_no = $_GET["table_no"];


if(isset($_POST['keysearch']))
		{
			$search = $_POST["keysearch"];
			$table_no = $_GET["table_no"];
			$data = mysqli_query($conn, "SELECT * FROM items WHERE item_short LIKE '%$search%'");
			
			while($row = mysqli_fetch_array($data))
			{
			?>
			<a href="order.php?item_id=<?= $row["item_id"] ?>&table_no=<?= $table_no ?>&type_name=<?= $row["item_type"] ?>"><div class="show">
				<?= $row["item_name"] ?><br />
					<small>
						RM <?= number_format($row["item_price"], 2) ?> - <?= $row["item_short"] ?>
					</small>
				
			</div></a>
			<?php
			}
		}
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
				url : 'search_sum.php?table_no=<?= $table_no ?>',
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
    <div align="center" id="rb_menu">
    <strong style="font-size:18px;">Table No: <?= $table_no ?></strong><br /><br />
    	<a href="submit_order.php?table_no=<?= $table_no ?>">Submit Order</a> <a href="cancel_order.php?table_no=<?= $table_no ?>">Cancel Order</a>
    </div><br />
    <?php
		
		$qbill = mysqli_query($conn, "SELECT * FROM bills WHERE bill_table = '{$table_no}'");
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
			$qorder = mysqli_query($conn, "SELECT * FROM orders WHERE order_table = '{$table_no}'");
			$no = 0 + 1;
			$sorder = mysqli_query($conn, "SELECT SUM(order_total) FROM orders WHERE order_table = '{$table_no}'");
			$rsorder = mysqli_fetch_array($sorder);
			while($rorder = mysqli_fetch_array($qorder)){
		?>
        <tr>
        	<td align="center"><?= $no ?></td>
            <td align="center"><?= $rorder["order_item"] ?>
			</td>
            
            <td align="center" style="font-size:40px;">
            		<a style="text-decoration:none; color:red;" href="del_order.php?order_id=<?= $rorder["order_id"] ?>&table_no=<?= $table_no ?>"><strong>-</strong></a><br />
					<?= $rorder["order_quantity"] ?> <br />
                    <a href="uorder.php?order_id=<?= $rorder["order_id"] ?>" style="text-decoration:none; color:green;"><strong>+</strong></a>
            </td>
                
            <td align="right"><?= number_format($rorder["order_total"], 2) ?></td>
            <td align="center">
			<div id="sum_but">
            	<a href="del_order.php?order_id=<?= $rorder["order_id"] ?>&table_no=<?= $table_no ?>">		
                	<strong>Delete</strong>
                </a> <br />
                <a href="add_note.php?order_id=<?= $rorder["order_id"] ?>&table_no=<?= $table_no ?>">
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

