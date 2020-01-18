<?PHP

require_once("includes/conn.php");

if(isset($_GET["table_no"])){
	$table_no = $_GET["table_no"];
	
	$qorder = mysqli_query($conn, "SELECT * FROM orders WHERE order_table = '{$table_no}'");
	$numqorder = mysqli_num_rows($qorder);
	
	if($numqorder == 0)
	{
?>
	<a href="add_order_table.php?table_no=<?= $table_no ?>">Add</a>
<?php
	}
	else
	{
?>
	<table width="80%" border="1" class="tbl">
        	<tr>
            	<th width="5%">No</th>
                <th width="45%">Items</th>
                <th width="10%">Qty</th>
                <th width="10%">Price</th>
                <th width="10%">Total</th>
            </tr>
            <?php
				$no = 0 + 1;
				while($rqorder = mysqli_fetch_array($qorder)){
				
			?>
        	<tr>
            	<td align="center"><?= $no ?></td>
                <td align="center"><?= $rqorder["order_item"] ?></td>
                <td align="center"><?= $rqorder["order_quantity"] ?></td>
                <td align="right"><?= number_format($rqorder["order_price"], 2) ?></td>
                <td align="right"><?= number_format($rqorder["order_total"], 2) ?></td>
            </tr>
            <?php
				$no++;
				}
				
				$qsumorder = mysqli_query($conn, "SELECT SUM(order_total) FROM orders WHERE order_table = '{$table_no}'");
				$rqsumorder = mysqli_fetch_array($qsumorder);
				$order_total = $rqsumorder["SUM(order_total)"];
			?>
            
            <tr>
            	<td align="center"></td>
                <td align="center"><strong>Total</strong></td>
                <td align="center"></td>
                <td align="right"></td>
                <td align="right"><strong><?= number_format($order_total, 2) ?></strong></td>
            </tr>
        </table>
	
    
<?php
	}
}
?>