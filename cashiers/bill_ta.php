<?php
require_once("includes/connection.php");

if(isset($_GET["customer"])){
	$customer = $_GET["customer"];

require_once("template/._header.php");

$qtable = mysqli_query($conn, "SELECT * FROM tables");
$rqtable = mysqli_fetch_array($qtable);
$nqtable = mysqli_num_rows($qtable);
$next = $customer + 1;
if($next > $nqtable){
	$next_table = 1;
}else{
	$next_table = $next;
}
$prev = $customer - 1;
if($prev <= 0){
	$prev_table = $nqtable;
}else{
	$prev_table = $prev;
}



$available = "0";
$reserved = "1";

$qtable_ava = mysqli_query($conn, "SELECT * FROM tables WHERE table_status = '{$available}'");
$rwqt_ava = mysqli_num_rows($qtable_ava);

$qtable_res = mysqli_query($conn, "SELECT * FROM tables WHERE table_status = '{$reserved}'");
$rwqt_res = mysqli_num_rows($qtable_res);


?>
<div align="center" style="height:auto;">
	<strong style="font-size:25px; padding: 5px;">Table No: <?= $customer ?></strong> 
	<strong>Reserved:</strong> <?= $rwqt_res ?> &nbsp;  
    <strong>Available:</strong> <?= $rwqt_ava ?> &nbsp; | &nbsp; 
	<strong>Date:</strong> <?= date("d-M-Y",time() - 54000) ?>  &nbsp; 
            <strong>Time:</strong> <?= date("H:i:s",time() + 54000) ?>
<hr />
<br /> 

	<?php
        $qorder = mysqli_query($conn, "SELECT * FROM orders WHERE order_table = '{$customer}'");
		$rwqorder = mysqli_num_rows($qorder);		
		
		if($rwqorder == "0"){
			$order_total = 0;
    ?>
    <div id="rb_menu">
    	<a href="takeaway.php">&rarr; Back</a>
	</div>
    
    <div align="center" id="rb_menu" style="margin-top:100px;">
    	There is no Order for this Table yet.
        Add Order for this table:<br /><br /><br />
        <a href="add_order.php?customer=<?= $customer ?>">Add Order</a>
    </div>
    <?php 
		}else{
			$qbil_order = mysqli_query($conn, "SELECT * FROM bills WHERE bill_table = '{$customer}' LIMIT 1");
			$rqbill_order = mysqli_fetch_array($qbil_order);
			$nbill = mysqli_num_rows($qbil_order);
			
			
			$qbill = mysqli_query($conn, "SELECT * FROM bills WHERE bill_table = '{$customer}'");
			$rqbill = mysqli_fetch_array($qbill);
			$bill_no = $rqbill["bill_no"];
	?>
	<div id="rb_menu">
    	<a href="takeaway.php">&larr; Back</a>
	</div>
    <br /><br />
    <div id="rb_menu">
    	<a href="paid.php?order_bill=<?= $rqbill_order["bill_no"] ?>&table_no=<?= $customer ?>">Paid</a> 
        <?php
    		$qtype = mysqli_query($conn, "SELECT * FROM types");
			
			while($rqtype = mysqli_fetch_array($qtype)){
		?>
        <button onclick="popitup('print.php?type_name=<?= $rqtype["type_name"] ?>&table_no=<?= $customer ?>&bill_no=<?= $bill_no ?>')">Print to <?= $rqtype["type_name"] ?></button>
		<?php
			}
        ?>
        <button onclick="popitup('print_bill.php?bill_no=<?= $bill_no ?>&table_no=<?= $customer ?>')">Print Bill</button>
	</div>
    
    	<script language="javascript" type="text/javascript">
							<!--
							function popitup(url) {
							newwindow=window.open(url,'name','height=700,width=300');
							if (window.focus) {newwindow.focus()}
							return false;
							}
							
							// -->
                    </script>
    	
    
      <h4>Table's Order - 
      <?php
		if($nbill == 0 || empty($nbill)){
		?>
      <small style="color:red;">This order are not submit yet.</small></h4></h4>  
      
       <?php
	  }else{
		 
	  ?>
        - <small>Receipt Number: <?= $rqbill["bill_no"] ?> | Date: <?= $rqbill["bill_date"] ?> | Time: <?= $rqbill["bill_time"] ?> </small></h4>
        
        <?php
	  }
		?>
             
        <table width="80%" border="0" class="tbl" style="border:#F30 groove; border-top-right-radius:10px; border-top-left-radius:10px;">
        	<tr style="background:#F30;" >
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
				
				$qsumorder = mysqli_query($conn, "SELECT SUM(order_total) FROM orders WHERE order_table = '{$customer}'");
				$rqsumorder = mysqli_fetch_array($qsumorder);
				$order_ttl = $rqsumorder["SUM(order_total)"];
				
				$q = mysqli_query($conn, "SELECT * FROM orders WHERE order_table = '{$customer}'");
				$nq = mysqli_num_rows($q);
				if($nq == 0){
					$order_total = "0";
				}
				else{
					$order_total = $rqsumorder["SUM(order_total)"];
				}
			?>
            
            <tr>
            	<td align="center"></td>
                <td align="center"><strong>Total</strong></td>
                <td align="center"></td>
                <td align="right"></td>
                <td align="right"><strong><?= number_format($order_total, 2) ?></strong></td>
            </tr>
        </table>
        
        
</div>

<br /><br />

<?php
		}
?>
</td>
        
        <td width="35%" valign="top">

            <div id="right_bar">
                <div id="rb_total">
                    <div align="center" id="rbt_rm" style="background:#F30; border-radius:5px; padding:5px;">
                        <strong style="font-size:20px;">Total (RM)</strong>
                    </div>
                    <div id="rbt_valu" style="border:#F60 groove; border-radius:5px; padding:5px;" align="center">
                        <strong style="font-size:36px"><?= number_format($order_total, 2) ?></strong>
                    </div>
                </div>
            
            
         <hr />
         
         <div align="center" id="rb_recent_tables" style="height:250px;">
         	<br />
            <div align="center" id="rbt_rm" style="background:#F30; border-radius:5px; padding:5px;">
            <strong style="font-size:20px;">Recent Dine-in Tables</strong>
            </div>
            <ul style="padding-right:50px;">
            	<?php
				$full = "1";
            	$qtable = mysqli_query($conn, "SELECT * FROM tables WHERE table_status = '{$full}' LIMIT 10");
				$numqtable = mysqli_num_rows($qtable);
				if($numqtable = "0"){
					echo "Sorry, no recent order yet";
				}else{
				while($rqtable = mysqli_fetch_array($qtable)){
            ?>
            	<li><a href="table.php?table_no=<?= $rqtable["table_no"] ?>">Table <?= $rqtable["table_no"] ?></a></li>
			<?php
				}
				}
			?>

            </ul>
         
         
         <hr /></div>
         <table width="100%" height="100" border="0">
         	<tr>
         		<td width="50%" >
                	<div align="center" id="rb_menu">
                    	<a href="addon.php">Addon & Take Away</a><br /><br /><br />
						<a href="index.php">Table Interfaces</a>
                    </div>                
                </td>
                <td>
                	<div align="center" id="rb_menu">
                		<a href="dashboard.php">Dashboard</a><br /><br /><br />
                		<a href="logout.php">Logout</a>
                   	</div>
                </td>
         	</tr>
         </table>
         
         </div>
         </td>
     </tr>
</table>
</body>
</html>

<?php
}else{
	header("Location: index.php");
}
?>    